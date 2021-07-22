<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParentProfile;
use App\Models\RepresentativeGroup;
use App\Models\Notes;
use DB;
use Illuminate\Http\Request;

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
        dd($request->all());
    }
    public function repDetails($rep_id, $parent_id)
    {
        $parent_detail = ParentProfile::where('id', $parent_id)->first();
        $family_groups = ParentProfile::where('representative_group_id', $rep_id)->get();
        $rep_detail = RepresentativeGroup::where('id', $rep_id)->first();
        $getNotes = Notes::where('parent_profile_id', $parent_id)->get();
        return view('admin/familyInformation/rep-detail', compact('parent_detail', 'rep_detail', 'family_groups', 'getNotes'));
    }


    public function update(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $representative = RepresentativeGroup::find($request->get('edit_rep_id'));
            $representative->parent_profile_id = $request->get('edit_parent_id');
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
            dd($e);
            $notification = [
                'message' => 'Failed to update Record!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
}
