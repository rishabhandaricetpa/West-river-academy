<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CustomPayment;
use App\Models\OrderPostage;
use App\Models\ParentProfile;
use App\Models\NotarizationPayment;
use App\Models\Notarization;
use App\Models\OrderPersonalConsultation;
use App\Models\CustomLetterPayment;
use App\Models\Graduation;
use App\Models\TransactionsMethod;
use App\Models\Transcript;
use DB;
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
        //$customPayments = CustomPayment::all();
        return view('admin.payment.customPayments.view');
    }

    //fetch data for custo payment
    public function dataTable()
    {
        return datatables(CustomPayment::with('ParentProfile')->latest()->get())->toJson();
    }
    //fetch data for custo payment
    public function getAllParentsPayment($parent_id)
    {
        $customPaymentsData = CustomPayment::where('parent_profile_id', $parent_id)->with('ParentProfile')->get();
        return view('admin.payment.customPayments.view-each', compact('customPaymentsData'));
    }

    public function viewPostage()
    {
        return view('admin.payment.orderPostagePayment.postage-payments');
    }
    //fetch data for order postage  payment
    public function orderPostageDataTable()
    {
        return datatables(OrderPostage::with('ParentProfile')->latest()->get())->toJson();
    }
    public function editOrderPostage($id)
    {
        $orderPostageData = OrderPostage::whereId($id)->with('ParentProfile')->first();
        $transactionData = TransactionsMethod::where('transcation_id', $orderPostageData->transcation_id)->first();
        return view('admin.payment.orderPostagePayment.edit', compact('orderPostageData', 'transactionData'));
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

        if ($request->get('paymentStatus') == 'paid') {
            TransactionsMethod::where('transcation_id', $orderPostage->transcation_id)->update([
                'status' => 'succeeded'
            ]);
        } else {
            TransactionsMethod::where('transcation_id', $orderPostage->transcation_id)->update([
                'status' => 'pending'
            ]);
        }
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
        return datatables(NotarizationPayment::with('ParentProfile', 'notarization', 'apostille')->latest()->get())->toJson();
    }

    public function editNotarization($id)
    {
        $notarizationData = NotarizationPayment::whereId($id)->with('ParentProfile', 'notarization', 'apostille')->first();
        $transactionData = TransactionsMethod::where('transcation_id', $notarizationData->transcation_id)->first();
        return view('admin.payment.notarizationPayments.edit', compact('notarizationData', 'transactionData'));
    }

    //update order notarization data in in backend
    public function updateNotarization(Request $request, $id)
    {
        try {
            $notarization = NotarizationPayment::find($id);
            if ($notarization) {
                $notarization->transcation_id = $request->get('transcation_id');
                $notarization->payment_mode = $request->get('payment _mode');
                $notarization->amount = $request->get('amount');
                $notarization->status = $request->get('paymentStatus');
                $notarization->save();
                if ($request->get('paymentStatus') == 'paid') {
                    TransactionsMethod::where('transcation_id', $notarization->transcation_id)->update([
                        'status' => 'succeeded'
                    ]);
                } else {
                    TransactionsMethod::where('transcation_id', $notarization->transcation_id)->update([
                        'status' => 'pending'
                    ]);
                }
                $notification = [
                    'message' => 'Record updated successfully!',
                    'alert-type' => 'success',
                ];
                return redirect()->back()->with($notification);
            } else {
                $notification = [
                    'message' => 'Data Mismatch!',
                    'alert-type' => 'error',
                ];
                return redirect()->back()->with($notification);
            }
        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            $notification = [
                'message' => 'Data Mismatch!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function getAllParentsNotarization($parent_id)
    {
        $notarizationPaymentData = NotarizationPayment::whereId($parent_id)->with('ParentProfile', 'notarization')->get();
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
        return datatables(CustomLetterPayment::with('ParentProfile')->latest()->get())->toJson();
    }

    public function editOrderCustomletter($id)
    {
        $customLetter = CustomLetterPayment::whereId($id)->with('ParentProfile')->first();
        $transactionData = TransactionsMethod::where('transcation_id', $customLetter->transcation_id)->first();
        return view('admin.payment.customLetterPayment.edit', compact('customLetter', 'transactionData'));
    }

    //update custom letters  data in in backend
    public function updateCustomletter(Request $request, $id)
    {
        $customLetter = CustomLetterPayment::find($id);
        $customLetter->transcation_id = $request->get('transcation_id');
        $customLetter->payment_mode = $request->get('payment_mode');
        $customLetter->status = $request->get('paymentStatus');
        $customLetter->paying_for = $request->get('paying_for');
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
        return datatables(OrderPersonalConsultation::with('parent')->latest()->get())->toJson();
    }

    public function editConultation($id)
    {
        $order_conultation = OrderPersonalConsultation::whereId($id)->with('parent')->first();
        $transactionData = TransactionsMethod::where('transcation_id', $order_conultation->transcation_id)->first();
        return view('admin.payment.orderConsltation.edit', compact('order_conultation', 'transactionData'));
    }

    //update Personal consultation data in in backend
    public function updateConultation(Request $request, $id)
    {
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
        if ($request->get('paymentStatus') == 'paid') {
            TransactionsMethod::where('transcation_id', $order_conultation->transcation_id)->update([
                'status' => 'succeeded'
            ]);
        } else {
            TransactionsMethod::where('transcation_id', $order_conultation->transcation_id)->update([
                'status' => 'pending'
            ]);
        }

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
    // public function indexCustomPayment()
    // {
    //     return view('payments/custom-payment');
    // }

    public function editCustomPayment($id)
    {
        $customPaymentsData = CustomPayment::whereId($id)->with('ParentProfile')->first();

        // $transactionData = TransactionsMethod::where('transcation_id', $customPaymentsData->transcation_id)->first();
        return view('admin.payment.customPayments.edit', compact('customPaymentsData'));
    }

    //update data from Admin users input in Custom payment table
    public function updateCustomPayments(Request $request, $id)
    {
        $customPayments = CustomPayment::find($id);
        $customPayments->transcation_id = $request->get('transcation_id');
        $customPayments->payment_mode = $request->get('payment_mode');
        $customPayments->amount = $request->get('amount');
        $customPayments->status = $request->get('paymentStatus');
        $customPayments->paying_for = $request->get('paying_for');
        $customPayments->save();
        if ($request->get('paymentStatus') == 'paid') {
            TransactionsMethod::where('transcation_id', $customPayments->transcation_id)->update([
                'status' => 'succeeded'
            ]);
        } else {
            TransactionsMethod::where('transcation_id', $customPayments->transcation_id)->update([
                'status' => 'pending'
            ]);
        }

        $notification = [
            'message' => 'Record updated successfully!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);

        return view('payments/custom-payment');
    }
    public function updateAllPaymentToPaid($type, $parent_id)
    {
        switch ($type) {
            case 'custom_payment':
                CustomPayment::whereIn('parent_profile_id', [$parent_id])->update(['status' => 'paid']);
                TransactionsMethod::whereIn('parent_profile_id', [$parent_id])->where('item_type', 'custom')->update(['status' => 'succeeded']);
                Cart::whereIn('parent_profile_id', [$parent_id])->where('item_type', 'custom')->delete();
                $notification = [
                    'message' => 'All Payments for Custom Payment Updated Successfully ',
                    'alert-type' => 'success',
                ];

                return redirect()->back()->with($notification);
            case 'personal_consultation':
                OrderPersonalConsultation::whereIn('parent_profile_id', [$parent_id])->update(['status' => 'paid']);
                TransactionsMethod::whereIn('parent_profile_id', [$parent_id])->where('item_type', 'order_consultation')->update(['status' => 'succeeded']);
                Cart::whereIn('parent_profile_id', [$parent_id])->where('item_type', 'order_consultation')->delete();
                $notification = [
                    'message' => 'All Payments for Personal Consultation Updated Successfully ',
                    'alert-type' => 'success',
                ];

                return redirect()->back()->with($notification);
            case 'custom_letter':
                CustomLetterPayment::whereIn('parent_profile_id', [$parent_id])->update(['status' => 'paid']);
                TransactionsMethod::whereIn('parent_profile_id', [$parent_id])->where('item_type', 'custom_letter')->update(['status' => 'succeeded']);
                Cart::whereIn('parent_profile_id', [$parent_id])->where('item_type', 'custom_letter')->delete();
                $notification = [
                    'message' => 'All Payments for Custom Letter Updated Successfully ',
                    'alert-type' => 'success',
                ];

                return redirect()->back()->with($notification);
            case 'postage':
                OrderPostage::whereIn('parent_profile_id', [$parent_id])->update(['status' => 'paid']);
                TransactionsMethod::whereIn('parent_profile_id', [$parent_id])->where('item_type', 'postage')->update(['status' => 'succeeded']);
                Cart::whereIn('parent_profile_id', [$parent_id])->where('item_type', 'postage')->delete();
                $notification = [
                    'message' => 'All Payments for Postage Updated Successfully ',
                    'alert-type' => 'success',
                ];

                return redirect()->back()->with($notification);
            case 'notarization':
                NotarizationPayment::whereIn('parent_profile_id', [$parent_id])->update(['status' => 'paid']);
                TransactionsMethod::whereIn('parent_profile_id', [$parent_id])->where('item_type', 'notarization')->update(['status' => 'succeeded']);
                Cart::whereIn('parent_profile_id', [$parent_id])->where('item_type', 'notarization')->delete();

                $notification = [
                    'message' => 'All Payments for Notarization Updated Successfully ',
                    'alert-type' => 'success',
                ];

                return redirect()->back()->with($notification);

            case 'transcript':

                Transcript::whereIn('parent_profile_id', [$parent_id])->update(['status' => 'paid']);
                TransactionsMethod::whereIn('parent_profile_id', [$parent_id])->where('item_type', 'transcript')->update(['status' => 'succeeded']);
                Cart::whereIn('parent_profile_id', [$parent_id])->where('item_type', 'transcript')->delete();
                $notification = [
                    'message' => 'All Payments for Transcript Updated Successfully ',
                    'alert-type' => 'success',
                ];

                return redirect()->back()->with($notification);
        }
    }
}
