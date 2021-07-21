<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParentProfile;
use App\Models\RepresentativeGroup;
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
        return view('admin/familyInformation/rep-detail');
    }
}
