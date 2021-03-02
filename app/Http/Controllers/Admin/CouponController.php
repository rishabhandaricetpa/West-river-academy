<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\User;
use App\Models\ParentProfile;
use Carbon\Carbon;
use DB;
use Exception;
use Auth;

class CouponController extends Controller
{
    public function index()
    {
        return view('admin.coupon.view');
    }

    public function dataTable()
    {
        return datatables(Coupon::all())->toJson();
    }

    public function create()
    {
        $parents = ParentProfile::select('id', 'p1_email')->get()->toArray();
        return view('admin.coupon.create', compact('parents'));
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);
        $parents = ParentProfile::select('id', 'p1_email')->get()->toArray();
        $coupon->coupon_for = explode(',', $coupon->coupon_for);
        $coupon->expire_at = Carbon::parse($coupon->expire_at)->format('Y-m-d');
        return view('admin.coupon.edit', compact('parents', 'coupon'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            if (isset($input['assign'])) {
                $input['coupon_for'] = implode(',', $input['assign']);
            }
            $input['code'] = strtoupper($input['code']);

            $check = Coupon::where('code', $input['code'])->where('status', 'active')->exists();

            if ($check) {
                throw new Exception("Coupon with this code is already Active.", 1);
            }

            $create = Coupon::create($input);
            if (!$create) {
                throw new Exception("Failed to create Coupon", 1);
            }
            DB::commit();
            $notification = array(
                'message' => 'Coupon generated Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.view.coupon')->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'Failed to generate Coupon!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            if (isset($input['assign'])) {
                $input['coupon_for'] = implode(',', $input['assign']);
            }
            $update = Coupon::find($id)->update($input);
            if (!$update) {
                throw new Exception("Failed to update Coupon", 1);
            }
            DB::commit();
            $notification = array(
                'message' => 'Coupon Updated Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.view.coupon')->with($notification);
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'Failed to update Coupon!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function getCode()
    {
        return Coupon::generateCode();
    }

    public function applyCoupon($code)
    {

        Coupon::removeAppliedCoupon();

        $coupon = Coupon::where('code', $code)->where('status', 'active')->first();

        if ($coupon === null) { // if coupon is inactive or doesn't exists
            return $this->invalidCouponResponse();
        }

        if ($coupon->expire_at !== null) { // if coupon is expired
            if (Carbon::parse($coupon->expire_at)->lt(Carbon::now())) {
                return $this->invalidCouponResponse();
            }
        }

        if ($coupon->coupon_for !== null && $coupon->coupon_for !== '') { // if coupon is not assigned
            $Userid = Auth::user()->id;
            $parentProfileData = User::find($Userid)->parentProfile()->first();
            $parent_id = $parentProfileData->id;

            if (!in_array($parent_id, explode(',', $coupon->coupon_for))) {
                return $this->invalidCouponResponse();
            }
        }

        // store coupon details in session
        session(['applied_coupon' => $code]);
        session(['applied_coupon_amount' => $coupon->amount]);

        return response()->json(['status' => 'success', 'amount' => $coupon->amount, 'message' => 'Coupon applied successfully.']);
    }

    private function invalidCouponResponse()
    {
        return response()->json(['status' => 'error', 'message' => 'Coupon is Invalid! Please try again.']);
    }

    public function removeAppliedCoupon()
    {
        Coupon::removeAppliedCoupon();
    }
}
