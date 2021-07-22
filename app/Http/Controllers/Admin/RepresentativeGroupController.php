<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FeeStructureType;
use App\Http\Controllers\Controller;
use App\Models\ParentProfile;
use App\Models\RepresentativeAmount;
use App\Models\RepresentativeDocuments;
use App\Models\RepresentativeGroup;
use DB;
use File;
use Illuminate\Http\Request;
use Storage;
use Str;

class RepresentativeGroupController extends Controller
{
    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $rep =  RepresentativeGroup::create([
                'parent_profile_id' => $request->parent_Id,
                'type' => $request->rep_type,
                'country' => $request->rep_country,
                'city' => $request->rep_city,
                'name' => $request->rep_name,
                'email' => $request->rep_email,
            ]);

            $parent = ParentProfile::where('id', $request->parent_Id)->first();

            $parent->representative_group_id = $rep->id;
            $parent->amount = FeeStructureType::RepGroupAmount;
            $parent->rep_status = 'pending';
            $parent->save();

            DB::commit();
            $notification = [
                'message' => 'Representative Updated Successfully!',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            report($e);
            DB::rollback();
            $notification = [
                'message' => 'Can not Update Representative !',
                'alert-type' => 'warning',
            ];

            return redirect()->back()->with($notification);
        }
    }
    public function getRepGroup(Request $request)
    {
        $rep = RepresentativeGroup::where('id', $request->choosed_rep_id)->first();
        $parent = ParentProfile::where('id', $request->parent_Id)->first();

        $parent->representative_group_id = $rep->id;
        $parent->amount = FeeStructureType::RepGroupAmount;
        $parent->rep_status = 'pending';
        $parent->save();

        return response()->json(['status' => 'success', 'data' => $rep]);
    }
    public function repDetails($rep_id, $parent_id)

    {

        $parent_rep_group = ParentProfile::where('id', $parent_id)->select('representative_group_id')->first();
        $rep_id = $parent_rep_group->representative_group_id;
        $rep_group = RepresentativeGroup::where('id',  $rep_id)->first();
        $rep_families =  $rep_group->families()->get();
        $family_count = $rep_families->count();
        $repAmount = FeeStructureType::RepGroupAmount;
        $repGroupAmountDetails = RepresentativeAmount::whereIn('representative_group_id', [$rep_id])->get();
        $repGroupDocuments = RepresentativeDocuments::whereIn('representative_group_id', [$rep_id])->get();
        $valueAmount = 0;
        foreach ($repGroupAmountDetails as $repGroupAmountDetail) {
            $valueAmount = $valueAmount + $repGroupAmountDetail->amount;
        }
        $calculatedAmount = ($family_count * $repAmount) + $valueAmount;

        // rep documents
        return view('admin/familyInformation/rep-detail', compact('rep_group', 'rep_families', 'calculatedAmount', 'rep_id', 'repGroupAmountDetails', 'repGroupDocuments'));
    }
    public function createRepAmount(Request $request)
    {
        RepresentativeAmount::create([
            'representative_group_id' => $request->rep_id,
            'amount' => $request->rep_amount,
            'notes' => $request->rep_message_text,
        ]);
    }
    public function uploadDocuments(Request $request)
    {
        if ($request->file) {
            $extension = $request->file->getClientOriginalExtension();
            $path = Str::random(40) . '.' . $extension;

            Storage::put(RepresentativeDocuments::uploadDir . '/' . $path, File::get($request->file));
            RepresentativeDocuments::create([
                'representative_group_id' => $request->rep_id,
                'original_filename' => $request->file->getClientOriginalName(),
                'filename' => $path,
                'document_type' => $request->rep_doc_note
            ]);
        }
    }
}
