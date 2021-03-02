<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BanktransferDetail;
use App\Models\MoneygramDetail;
use App\Models\TransferwiseDetail;
use DB;
use Illuminate\Http\Request;

class PaymentAddressController extends Controller
{
    public function index()
    {
        $tranferwise = DB::table('transfer_wise_deatils')->get();
        $banktransfer = BanktransferDetail::get();
        $moneyGram = DB::table('money_gram_details')->get();

        return view('admin.paymentInformation.edit-bankdetails', compact('tranferwise', 'banktransfer', 'moneyGram'));
    }

    //Bank Transfer Address

    protected function storeBanktransfer(Request $request)
    {
        try {
            DB::beginTransaction();
            $bankTransfer = BanktransferDetail::create([
                'bank_name' => $request['bank_name'],
                'swift_code' => $request['swift_code'],
                'bank_address' => $request['bank_address'],
                'street' => $request['street'],
                'phone_number' => $request['phone_number'],
                'routing_number' => $request['routing_number'],
                'account_name' => $request['account_name'],
                'account_number' => $request['account_number'],
                'status' => 1,
            ]);
            DB::commit();
            $notification = [
                'message' => 'New Address for BankTransfer is Added Successfully!',
                'alert-type' => 'success',
            ];

            return redirect('admin/payment-address')->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            $notification = [
                'message' => 'Missing Information!',
                'alert-type' => 'error',
            ];

            return redirect('admin/payment-address')->with($notification);
        }
    }

    public function edit($id)
    {
        $banktransfer = BanktransferDetail::find($id);

        return view('admin.paymentInformation.edit-banktransfer', compact('banktransfer'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $banktransfer = BanktransferDetail::find($id);
            $banktransfer->bank_name = $request->get('bank_name');
            $banktransfer->swift_code = $request->get('swift_code');
            $banktransfer->bank_address = $request->get('bank_address');
            $banktransfer->street = $request->get('street');
            $banktransfer->phone_number = $request->get('phone_number');
            $banktransfer->routing_number = $request->get('routing_number');
            $banktransfer->account_name = $request->get('account_name');
            $banktransfer->account_number = $request->get('account_number');
            $banktransfer->status = $request->get('status');
            $banktransfer->save();
            DB::commit();
            $notification = [
                'message' => 'Address for Banktransfer is updated Successfully!',
                'alert-type' => 'success',
            ];
            return redirect('admin/payment-address')->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'Failed to update Record!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function destroyBanktransferAddress($id)
    {
        $notification = [
            'message' => 'Record is Deleted Successfully!',
            'alert-type' => 'warning',
        ];
        BanktransferDetail::where('id', $id)->delete();

        return redirect()->back()->with($notification);
    }

    //TransferWise Address

    protected function storeTransferwise(Request $request)
    {
        try {
            DB::beginTransaction();
            $tranferwise = TransferwiseDetail::create([
                'account_holder' => $request['account_holder'],
                'account_number' => $request['account_number'],
                'wire_transfer_number' => $request['wire_transfer_number'],
                'swift_code' => $request['swift_code'],
                'routing_number' => $request['routing_number'],
                'address' => $request['address'],
                'state' => $request['state'],
                'country' => $request['country'],
                'website' => $request['website'],
                'status' => 1,
            ]);
            DB::commit();
            $notification = [
                'message' => 'New Address for TransferWise is Added Successfully!',
                'alert-type' => 'success',
            ];

            return redirect('admin/payment-address')->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            $notification = [
                'message' => 'Missing Information!',
                'alert-type' => 'error',
            ];

            return redirect('admin/payment-address')->with($notification);
        }
    }

    public function editTransferWise($id)
    {
        $tranferWise = TransferwiseDetail::find($id);

        return view('admin.paymentInformation.edit-transferwise', compact('tranferWise'));
    }

    public function updateTransferwise(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $transferwise = TransferwiseDetail::find($id);
            $transferwise->account_holder = $request->get('account_holder');
            $transferwise->account_number = $request->get('account_number');
            $transferwise->wire_transfer_number = $request->get('wire_transfer_number');
            $transferwise->swift_code = $request->get('swift_code');
            $transferwise->routing_number = $request->get('routing_number');
            $transferwise->address = $request->get('address');
            $transferwise->state = $request->get('state');
            $transferwise->country = $request->get('country');
            $transferwise->status = $request->get('status');
            $transferwise->website = $request->get('website');
            $transferwise->save();
            DB::commit();
            $notification = [
                'message' => 'Address for Transfer Wise is updated Successfully!',
                'alert-type' => 'success',
            ];

            return redirect('admin/payment-address')->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'Failed to update Record!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function destroyTransferwiseAddress($id)
    {
        $notification = [
            'message' => 'Record is Deleted Successfully!',
            'alert-type' => 'warning',
        ];
        TransferwiseDetail::where('id', $id)->delete();

        return redirect()->back()->with($notification);
    }

    //MoneyGram Address

    protected function storeMoneygram(Request $request)
    {
        try {
            DB::beginTransaction();
            $moneygram = MoneygramDetail::create([
                'name' => $request['name'],
                'address' => $request['address'],
                'city' => $request['city'],
                'state' => $request['state'],
                'zip' => $request['zip'],
                'money_gram_id' => $request['money_gram_id'],
                'status' => 1,
            ]);
            DB::commit();
            $notification = [
                'message' => 'New Address for MoneyGram is Added Successfully!',
                'alert-type' => 'success',
            ];

            return redirect('admin/payment-address')->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            $notification = [
                'message' => 'Missing Information!',
                'alert-type' => 'error',
            ];

            return redirect('admin/payment-address')->with($notification);
        }
    }

    public function editMoneyGram($id)
    {
        $moneyGram = MoneygramDetail::find($id);

        return view('admin.paymentInformation.edit-moneygram', compact('moneyGram'));
    }

    public function updateMoneytransfer(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $moneygram = MoneygramDetail::find($id);
            $moneygram->name = $request->get('name');
            $moneygram->address = $request->get('address');
            $moneygram->city = $request->get('city');
            $moneygram->state = $request->get('state');
            $moneygram->zip = $request->get('zip');
            $moneygram->money_gram_id = $request->get('money_gram_id');
            $moneygram->status = $request->get('status');
            $moneygram->save();
            DB::commit();
            $notification = [
                'message' => 'Address for MoneyGram is updated Successfully!',
                'alert-type' => 'success',
            ];

            return redirect('admin/payment-address')->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'Failed to update Record!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function destroyMoneyGramAddress($id)
    {
        try {
            DB::beginTransaction();
            $notification = [
                'message' => 'Record is Deleted Successfully!',
                'alert-type' => 'warning',
            ];
            MoneygramDetail::where('id', $id)->delete();
            DB::commit();
            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'Failed to update Record!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
