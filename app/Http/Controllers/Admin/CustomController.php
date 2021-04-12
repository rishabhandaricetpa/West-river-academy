<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPayment;
use App\Models\OrderPostage;
use App\Models\ParentProfile;
use App\Models\NotarizationPayment;
use App\Models\Notarization;
use App\Models\OrderPersonalConsultation;
use App\Models\CustomLetterPayment;

use Illuminate\Http\Request;

class CustomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $customPayments = CustomPayment::all();
        return view('admin.payment.customPayments.view');
    }

    //fetch data for custo payment
    public function dataTable()
    {
        return datatables(CustomPayment::with('ParentProfile')->get())->toJson();
    }
    //fetch data for custo payment
    public function getAllParentsPayment($parent_id)
    {
        $customPaymentsData = CustomPayment::where('parent_profile_id', $parent_id)->with('ParentProfile')->get();
        return view('admin.payment.customPayments.view-each', compact('customPaymentsData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    // public function show(cr $cr)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //     $countrydata = Country::find($id);
        //     return view('admin.edit-country', compact('countrydata'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    // public function destroy(cr $cr)
    // {
    //     //
    // }



    /**
     * Order Postage Custom payments Code  to view all the postage made by users
     *
     */
    public function viewPostage()
    {
        return view('admin.payment.orderPostagePayment.postage-payments');
    }
    //fetch data for order postage  payment
    public function orderPostageDataTable()
    {
        return datatables(OrderPostage::with('ParentProfile')->get())->toJson();
    }
    public function editOrderPostage($id)
    {
        $orderPostageData = OrderPostage::whereId($id)->with('ParentProfile')->first();
        return view('admin.payment.orderPostagePayment.edit', compact('orderPostageData'));
    }
    //update order postage data in in backend


    public function upadteOrderPostage(Request $request, $id)
    {
        $orderPostage = OrderPostage::find($id);
        $orderPostage->transcation_id = $request->get('transcation_id');
        $orderPostage->payment_mode = $request->get('payment_mode');
        $orderPostage->amount = $request->get('amount');
        $orderPostage->status = $request->get('paymentStatus');
        $orderPostage->save();
        $notification = [
            'message' => 'Record updated successfully!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
    public function getAllParentsPostage($parent_id)
    {
        $postagePaymentData = OrderPostage::where('parent_profile_id', $parent_id)->with('ParentProfile')->get();
        return view('admin.payment.orderPostagePayment.view-each', compact('postagePaymentData'));
    }

    //apostille and notarization

    public function viewNotarization()
    {
        return view('admin.payment.notarizationPayments.notarization-payments');
    }

    //fetch data for appostile and notarization  payment
    public function orderNotrizationDataTable()
    {
        // dd(NotarizationPayment::with('ParentProfile', 'notarization')->get()->toArray());
        return datatables(NotarizationPayment::with('ParentProfile', 'notarization')->get())->toJson();
    }

    public function editNotarization($id)
    {
        $notarizationData = NotarizationPayment::whereId($id)->with('ParentProfile', 'notarization')->first();
        // $notarizationdetails = Notarization::whereId($id)->with('ParentProfile')->first();
        return view('admin.payment.notarizationPayments.edit', compact('notarizationData'));
    }

    //update order notarization data in in backend
    public function updateNotarization(Request $request, $id)
    {
        $notarization = NotarizationPayment::find($id);
        $notarization->transcation_id = $request->get('transcation_id');
        $notarization->payment_mode = $request->get('payment _mode');
        $notarization->amount = $request->get('amount');
        $notarization->status = $request->get('paymentStatus');
        $notarization->save();
        $notification = [
            'message' => 'Record updated successfully!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function getAllParentsNotarization($parent_id)
    {
        $notarizationPaymentData = NotarizationPayment::where('parent_profile_id', $parent_id)->with('ParentProfile', 'notarization')->get();
        return view('admin.payment.notarizationPayments.view-each', compact('notarizationPaymentData'));
    }

    /**
     * Order Custom letter to view all the cutsom letter purchase made by users
     *
     */
    public function viewCustomletter()
    {
        return view('admin.payment.customLetterPayment.view');
    }
    //fetch data for custom letters  payment

    public function orderCustomletterDataTable()
    {
        return datatables(CustomLetterPayment::with('ParentProfile')->get())->toJson();
    }

    public function editOrderCustomletter($id)
    {
        $customLetter = CustomLetterPayment::whereId($id)->with('ParentProfile')->first();
        return view('admin.payment.customLetterPayment.edit', compact('customLetter'));
    }

    //update custom letters  data in in backend
    public function updateCustomletter(Request $request, $id)
    {
        $customLetter = CustomLetterPayment::find($id);
        $customLetter->transcation_id = $request->get('transcation_id');
        $customLetter->payment_mode = $request->get('payment_mode');
        $customLetter->amount = $request->get('amount');
        $customLetter->status = $request->get('paymentStatus');
        $customLetter->save();
        $notification = [
            'message' => 'Record updated successfully!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }


    //fetch data for custo payment
    public function getAllParentsCustomLetters($parent_id)
    {
        $customLettersPaymentsData = CustomLetterPayment::where('parent_profile_id', $parent_id)->with('ParentProfile')->get();
        return view('admin.payment.customLetterPayment.view-each', compact('customLettersPaymentsData'));
    }



    /**
     *Personal consultation to view all the  purchase made by users
     *
     */
    public function viewOrderConultation()
    {
        return view('admin.payment.orderConsltation.view');
    }
    //fetch data for Personal consultation payment

    public function orderConultationDataTable()
    {
        return datatables(OrderPersonalConsultation::with('parent')->get())->toJson();
    }

    public function editConultation($id)
    {
        $order_conultation = OrderPersonalConsultation::whereId($id)->with('parent')->first();
        // dd($order_conultation);
        return view('admin.payment.orderConsltation.edit', compact('order_conultation'));
    }

    //update Personal consultation data in in backend
    public function updateConultation(Request $request, $id)
    {
        // dd($request);
        $order_conultation = OrderPersonalConsultation::find($id);
        $order_conultation->transcation_id = $request->get('transcation_id');
        $order_conultation->payment_mode = $request->get('payment_mode');
        $order_conultation->amount = $request->get('amount');
        $order_conultation->status = $request->get('paymentStatus');
        $order_conultation->preferred_language = $request->get('preferred_language');
        $order_conultation->sp_call_type = $request->get('sp_call_type');
        $order_conultation->en_call_type = $request->get('en_call_type');
        $order_conultation->consulting_about = $request->get('consulting_about');
        $order_conultation->save();
        $notification = [
            'message' => 'Record updated successfully!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }


    //fetch data for Personal consultation
    public function getAllParentsConultation($parent_id)
    {
        $order_conultationPayments = OrderPersonalConsultation::where('parent_profile_id', $parent_id)->with('parent')->get();
        return view('admin.payment.orderConsltation.view-each', compact('order_conultationPayments'));
    }
}
