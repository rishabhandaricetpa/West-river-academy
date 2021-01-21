<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\ParentProfile;

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
        
    }

    public function getCode()
    {
        return Coupon::generateCode();
    }

    
}
