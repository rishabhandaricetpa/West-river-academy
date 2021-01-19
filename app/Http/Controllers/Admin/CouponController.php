<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Coupon;

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
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        
    }
}
