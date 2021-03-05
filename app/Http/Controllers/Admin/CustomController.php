<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomPayment;

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
        return view('admin.customPayments.view');
    }

    //fetch data for custo payment
    public function dataTable()
    {
        return datatables(CustomPayment::with('ParentProfile')->get())->toJson();
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
        // try {
        //     $country = Country::find($id);
        //     $country->country   =  $request->get('country');
        //     $country->start_date  =  $request->get('start_date');
        //     $country->end_date    =  $request->get('end_date');
        //     $country->save();
        //     $notification = array(
        //         'message' => 'Record is updated Successfully!',
        //         'alert-type' => 'success'
        //     );
        //     return redirect('admin/countryenrollments')->with($notification);
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     if ($request->expectsJson()) {
        //         return response()->json(['status' => 'error', 'message' => 'Failed to update Country Data']);
        //     }
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    // public function destroy(cr $cr)
    // {
    //     //
    // }
}
