<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\ParentProfile;
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

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $input['coupon_for'] = implode(',',$input['assign']);
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

    public function getCode()
    {
        return Coupon::generateCode();
    }

    
}
