<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\ParentProfile;
use Carbon\Carbon;
Use DB;
use Exception;

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
        $parents = ParentProfile::select('id','p1_email')->get()->toArray();
        return view('admin.coupon.create',compact('parents'));
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);
        $parents = ParentProfile::select('id','p1_email')->get()->toArray();
        $coupon->coupon_for = explode(',', $coupon->coupon_for);
        $coupon->expire_at = Carbon::parse($coupon->expire_at)->format('Y-m-d');
        return view('admin.coupon.edit',compact('parents','coupon'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            if(isset($input['assign'])){
                $input['coupon_for'] = implode(',',$input['assign']);
            }
            $input['code'] = strtoupper($input['code']);

            $check = Coupon::where('code',$input['code'])->where('status','active')->exists();

            if($check){
                throw new Exception("Coupon with this code is already Active.", 1);
            }

            $create = Coupon::create($input);
            if(!$create){
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

    public function update(Request $request,$id)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            if(isset($input['assign'])){
                $input['coupon_for'] = implode(',',$input['assign']);
            }
            $update = Coupon::find($id)->update($input);
            if(!$update){
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

    
}
