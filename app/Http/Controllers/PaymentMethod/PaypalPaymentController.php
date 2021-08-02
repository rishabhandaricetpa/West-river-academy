<?php

namespace App\Http\Controllers\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\EnrollmentPayment;
use App\Models\ParentProfile;
use App\Models\TransactionsMethod;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Agreement;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\PayerInfo;
use PayPal\Api\Payment;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Plan;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;

class PaypalPaymentController extends Controller
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

        $enroll_fees = Cart::getCartAmount($this->parent_profile_id, true);
        if (empty($enroll_fees->amount)) {
            return view('Billing.invalid');
        } else {
            $coupon_amount = session('applied_coupon_amount', 0);
            $total = $coupon_amount > $enroll_fees->amount ? 1 : $enroll_fees->amount - $coupon_amount;

            $item_1 = new Item();

            $item_1->setName('Product 1')
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($total);

            $item_list = new ItemList();
            $item_list->setItems([$item_1]);

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
                ->setTransactions([$transaction]);
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

        $coupon_code = session('applied_coupon', null);
        $coupon_amount = session('applied_coupon_amount', 0);
        $enroll_fees = Cart::getCartAmount($this->parent_profile_id, true);
        $cartItems = Cart::where('parent_profile_id', $this->parent_profile_id)->get();
        $items = collect($cartItems)->pluck('item_type')->toArray();
        $item_type = implode(",", $items);
        $student_data = collect($cartItems)->pluck('student_profile_id')->toArray();
        $student_id = implode(",", (array_unique($student_data)));
        $paypal = new TransactionsMethod();
        $paypal->transcation_id = $payment_id;
        $paypal->payment_mode = 'PayPal';
        $paypal->parent_profile_id = Auth::user()->id;
        $paypal->amount = $enroll_fees->amount;
        $paypal->status = 'succeeded';
        $paypal->coupon_code = $coupon_code;
        $paypal->coupon_amount = $coupon_amount;
        $paypal->item_type = $item_type;
        $paypal->student_profile_id = $student_id;
        $paypal->save();

        Cart::emptyCartAfterPayment('PayPal', 'paid', $payment_id);

        if ($result->getState() == 'approved') {
            $notification = [
                'message' => 'Payment has been successfully processed! Add more services',
                'alert-type' => 'success',
            ];

            return Redirect::route('thankyou.paypal')->with($notification);
        }

        \Session::put('error', 'Payment failed !!');

        return Redirect::route('paywithpaypal');
    }
}
