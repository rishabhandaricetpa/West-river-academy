<?php

namespace App\Http\Controllers\PaymentMethod;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\Plan;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\PayerInfo;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use App\Models\TransactionsMethod;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Session;
use URL;
use App\Models\User;
use App\Models\Cart;
use App\Models\ParentProfile;


class   PaypalPaymentController extends Controller
{
    private $_api_context;
    private $parent_profile_id;

    public function __construct()
    {
        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
        
    $this->middleware(function ($request, $next) {
        $Userid = Auth::user()->id;
        $parentProfileData = User::find($Userid)->parentProfile()->first();
        $this->parent_profile_id = $parentProfileData->id;
        return $next($request);
        });
    }
    public function payWithPaypal()
    {
        return view('paywithpaypal');
    }
    

    public function postPaymentWithpaypal(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $enroll_fees = Cart::getCartAmount($this->parent_profile_id,true);
        $total=$enroll_fees->amount;
        $item_1 = new Item();

        $item_1->setName('Product 1')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($total);

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($total);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Enter Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status'))
            ->setCancelUrl(URL::route('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->_api_context);
        } catch (Exception $e) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::route('paywithpaypal');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::route('paywithpaypal');
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }

        \Session::put('error', 'Unknown error occurred');
        return Redirect::route('paywithpaypal');
    }
    public function getPaymentStatus(Request $request)
    {   
       
        $payment_id = Session::get('paypal_payment_id');        
        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error', 'Payment failed');
            return Redirect::route('paywithpaypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);

        $jsonResult =json_decode($result,true );
      $amount=  $jsonResult['transactions'][0]['amount']['total'];
        $paypal =new TransactionsMethod();
        $paypal->transcation_id =$payment_id;
        $paypal->payment_mode= 'Pay pal';
        $paypal->parent_profile_id = Auth::user()->id;
        $paypal->amount =$amount;
        $paypal->status="succeeded";
        $paypal->save();
        if ($result->getState() == 'approved') {
            $notification = array(
                'message' => 'Payment has been successfully processed! Add more services',
                'alert-type' => 'success'
            ); 
            return Redirect::route('dashboard')->with($notification);
        }

        \Session::put('error', 'Payment failed !!');
        return Redirect::route('paywithpaypal');
    }
}
