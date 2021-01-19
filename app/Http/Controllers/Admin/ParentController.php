<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\ParentProfile;
use App\Models\User;
use App\Models\StudentProfile;

class ParentController extends Controller
{
  /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       //
    }
 /**
     * Show the Parent dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $data = ParentProfile::all();
        return view('admin.familyInformation.view-parent',compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.familyInformation.edit-parent',compact('parent'));
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
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parent= ParentProfile::find($id);
        return view('admin.familyInformation.edit-parent',compact('parent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $userdata=User::find($id)->first();
        $userdata->name         =       $request->get('p1_first_name');
        $userdata->email        =       $request->get('p1_email');
        $userdata->save();
        $parent = ParentProfile::find($id);
        $parent->p1_first_name   =  $request->get('p1_first_name');
        $parent->p1_middle_name  =  $request->get('p1_middle_name');
        $parent->p1_last_name    =  $request->get('p1_last_name');
        $parent->p1_email        =  $request->get('p1_email');
        $parent->p1_cell_phone   =  $request->get('p1_cell_phone');
        $parent->p1_home_phone   =  $request->get('p1_home_phone');
        $parent->p2_first_name   =  $request->get('p2_first_name');
        $parent->p2_middle_name  =  $request->get('p2_middle_name');
        $parent->p2_email        =  $request->get('p2_email');
        $parent->p2_cell_phone   =  $request->get('p2_cell_phone');
        $parent->p2_home_phone   =  $request->get('p2_home_phone');
        $parent->street_address	=  $request->get('street_address');
        $parent->city	= $request->get('city');
        $parent->state   =  $request->get('state');
        $parent->country   =  $request->get('country');
        $parent->reference	=  $request->get('reference');
        $parent->immunized	= $request->get('immunized');
        $parent->status	= $request->get('status');
        $parent->save();
        $notification = array(
            'message' => 'parent Record is updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect('admin/view')->with($notification);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
     {
         $notification = array(
             'message' => 'parent Record is Deleted Successfully!',
              'alert-type' => 'warning'
        );
         parentProfile::where('id',$id)->delete();
         return redirect()->back()->with($notification);
    } 
}
