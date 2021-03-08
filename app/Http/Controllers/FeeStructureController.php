<?php

namespace App\Http\Controllers;

use App\Models\FeesInfo;
use App\Models\FeeStructure;
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
