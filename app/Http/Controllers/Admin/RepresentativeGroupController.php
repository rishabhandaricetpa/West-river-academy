<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FeeStructureType;
use App\Http\Controllers\Controller;
use App\Models\ParentProfile;
use App\Models\RepresentativeAmount;
use App\Models\RepresentativeDocuments;
use App\Models\RepresentativeGroup;
use App\Models\Notes;
use DB;
use Exception;
use File;
use Illuminate\Http\Request;
use PDF;
use Storage;
use Str;

class RepresentativeGroupController extends Controller
{
    public function index()
    {
        $all_reps = RepresentativeGroup::all();
        return view('admin/familyInformation/rep-list', compact('all_reps'));
    }
    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $rep =  RepresentativeGroup::create([
                'parent_profile_id' => $request->parent_Id ? $request->parent_Id : null,
                'type' => $request->rep_type,
                'country' => $request->rep_country,
                'city' => $request->rep_city,
                'name' => $request->rep_name,
                'email' => $request->rep_email,
            ]);
            if ($request->parent_Id) {
                $parent = ParentProfile::where('id', $request->parent_Id)->first();

                $parent->representative_group_id = $rep->id;
                $parent->amount = $rep->type == 'Respresentative' ? FeeStructureType::RepGroupAmount : FeeStructureType::InfluncerAmount;
                $parent->rep_status = 'active';
                $parent->save();
            }


            DB::commit();
            $notification = [
                'message' => 'Representative Updated Successfully!',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            dd($e);
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
        $parent->amount = $rep->type == 'Respresentative' ? FeeStructureType::RepGroupAmount : FeeStructureType::InfluncerAmount;
        $parent->rep_status = 'active';
        $parent->save();

        return response()->json(['status' => 'success', 'data' => $rep]);
    }
    public function repDetails($rep_id)
    {
        $rep_group = RepresentativeGroup::where('id',  $rep_id)->first();
        // where rep status is active
        $family_groups = ParentProfile::whereIn('representative_group_id', [$rep_id])->where('rep_status', 'active')->get();
        $repAmount = collect($family_groups)->pluck('amount')->sum();
        $getNotes = Notes::where('representative_group_id', $rep_id)->get();

        $repGroupAmountDetails = RepresentativeAmount::whereIn('representative_group_id', [$rep_id])->get();
        $repGroupDocuments = RepresentativeDocuments::whereIn('representative_group_id', [$rep_id])->get();
        $calculatedAmount =  getRepresentativeAmount($repGroupAmountDetails,  $repAmount);

        // rep documents
        return view('admin/familyInformation/rep-detail', compact('rep_group', 'rep_id', 'calculatedAmount', 'repGroupAmountDetails', 'repGroupDocuments', 'family_groups', 'getNotes'));
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
    public function repReport(Request $request)
    {
        try {


            $from = $request->from;
            $to = $request->to;
            if ($from &&  $to) {
                $rep_families =   ParentProfile::whereIn('representative_group_id', [$request->rep_id])->where('rep_status', 'active')->whereBetween('created_at', [$from, $to])->get();
            } else {
                $rep_families =     ParentProfile::whereIn('representative_group_id', [$request->rep_id])->where('rep_status', 'active')->get();
            }

            $representative = RepresentativeGroup::where('id', $request->rep_id)->first();

            $totalFamilyAmount = collect($rep_families)->pluck('amount')->sum();
            $repGroupAmountDetails = RepresentativeAmount::whereIn('representative_group_id', [$request->rep_id])->get();
            $amountPaid = collect($repGroupAmountDetails)->pluck('amount')->sum();
            $calculatedAmount =  getRepresentativeAmount($repGroupAmountDetails,  $totalFamilyAmount);
            $data = [
                'calculatedAmount' => $calculatedAmount,
                'rep_families' =>   $rep_families,
                'repGroupAmountDetails' => $repGroupAmountDetails,
                'amountPaid' => $amountPaid,
                'representative' => $representative->full_name,
                'totalFamilyAmount' => $totalFamilyAmount
            ];
            $pdf = PDF::loadView('admin.familyInformation.rep-report', $data);
            return $pdf->download('RepReport');
        } catch (Exception $e) {
            dd($e);
        }
    }
    public function delete($rep_amount_id)
    {
        RepresentativeAmount::findOrFail($rep_amount_id)->delete();
        return redirect()->back();
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $representative = RepresentativeGroup::find($request->get('edit_rep_id'));
            $representative->parent_profile_id =   $representative->parent_profile_id;
            $representative->type = $request->get('edit_rep_type');
            $representative->country = $request->get('edit_rep_country');
            $representative->city = $request->get('edit_rep_city');
            $representative->name = $request->get('edit_rep_name');
            $representative->email = $request->get('edit_rep_email');
            $representative->rep_phone = $request->get('edit_rep_phone');
            $representative->rep_skype = $request->get('edit_rep_skype');
            $representative->terms_of_agreement = $request->get('terms_of_org');

            $representative->save();

            DB::commit();
            $notification = [
                'message' => 'Record is updated Successfully!',
                'alert-type' => 'success',
            ];
            return  redirect()->back()->with($notification);
        } catch (\Exception $e) {
            report($e);
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
    public function changeStatusRep($parent_id)
    {
        ParentProfile::findOrFail($parent_id)->update(['rep_status' => 'inactive']);
        $notification = [
            'message' => 'Representative Deattached Successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
    public function deleteRep($rep_id)
    {
        RepresentativeGroup::find($rep_id)->delete();
        $notification = [
            'message' => 'Representative Deleted Successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.replist')->with($notification);
    }
}
