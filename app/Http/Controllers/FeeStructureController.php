<?php

namespace App\Http\Controllers;

use App\Models\FeesInfo;
use App\Models\FeeStructure;
use App\Models\Country;
use DB;
use Illuminate\Http\Request;

class FeeStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.feeStructure.view');
    }

    public function viewdata()
    {
        $feesData = FeesInfo::all();

        return view('fees.fees-services', compact('feesData'));
    }

    public function viewShippingDataTable()
    {
        return datatables(Country::all())->toJson();
    }


    public function  countryData()
    {
        return view('admin.feeStructure.view_country');
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

    //fetch data for custo payment
    public function dataTable()
    {
        return datatables(FeesInfo::all())->toJson();
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
     * @param  \App\Models\FeeStructure  $feeStructure
     * @return \Illuminate\Http\Response
     */
    public function show(FeeStructure $feeStructure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeeStructure  $feeStructure
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fees = FeesInfo::whereId($id)->first();

        return view('admin.feeStructure.edit', compact('fees'));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeeStructure  $feeStructure
     * @return \Illuminate\Http\Response
     */
    public function countryPostageEdit($id)
    {
        $country_data = Country::whereId($id)->first();

        return view('admin.feeStructure.edit_postage', compact('country_data'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FeeStructure  $feeStructure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $inputs = $request->all();

            $fees = FeesInfo::whereId($request->get('id'));
            $fees->update(['amount' => $inputs['amount']]);
            DB::commit();

            return redirect()->route('admin.fees.services')->with([
                'message' => 'Details updated successfully!',
                'alert-type' => 'success',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Failed to update details!',
                'alert-type' => 'error',
            ]);
        }
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FeeStructure  $feeStructure
     * @return \Illuminate\Http\Response
     */
    public function countryPostageupdate(Request $request)
    {
        try {
            $inputs = $request->all();
            $country_shipping_fee = Country::whereId($request->get('id'));
            $country_shipping_fee->update(['postage_charges' => $inputs['amount']]);

            return redirect()->route('admin.fees.country')->with([
                'message' => 'Details updated successfully!',
                'alert-type' => 'success',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Failed to update details!',
                'alert-type' => 'error',
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeeStructure  $feeStructure
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeeStructure $feeStructure)
    {
        //
    }
}
