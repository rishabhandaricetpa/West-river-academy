<?php

namespace App\Http\Controllers;
use Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\ParentProfile;
use App\Models\Cart;
use App\Models\Country;
use App\Models\FeesInfo;
use Illuminate\Support\Facades\DB;

class ParentController extends Controller
{
    private $parent_profile_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $Userid = auth()->user()->id;
            $parentProfileData = User::find($Userid)->parentProfile()->first();
            $this->parent_profile_id = $parentProfileData->id;

            return $next($request);
        });
    }
    public function address($id)
    {    
        $user_id = Auth::user()->id;
        $parent = ParentProfile::find($user_id)->first();
        $enroll_fees = Cart::getCartAmount($this->parent_profile_id,true);

        if( is_null($enroll_fees->amount) || empty($enroll_fees->amount) || $enroll_fees->amount == 0){
            $notification = array(
                'message' => 'Cart is Empty! Please add atleast one item.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        $country_list  =  Country::select('country')->get();
        return view('Billing/cart-billing', compact('parent','country_list','enroll_fees'));
    }
    public function mysettings($id)
    {    
        $user_id = Auth::user()->id;
        $parent = ParentProfile::find($user_id)->first();
        return view('myaccount', compact('parent','user_id'));
    }

    public function editmysettings($id)
    {    
        $user_id = Auth::user()->id;
        $parent = ParentProfile::find($user_id)->first();
        return view('edit-account', compact('parent','user_id'));
    }

    public function updatemysettings(Request $request, $id)
    {
        try{
            DB::beginTransaction();
            $user_id = Auth::user()->id;
            $userdata=User::find($user_id)->first();
            $userdata->name         =       $request->get('first_name');
            $userdata->email        =       $request->get('email');
            // $Userdata->email_verified_at='';
            $userdata->save();

            $user=  User::find($id)->parentProfile()->first();
            $parent_id = $user->id;
            $parent = ParentProfile::find($parent_id)->first();
            $parent->p1_first_name   =  $request->get('first_name');
            $parent->p1_last_name    =  $request->get('last_name');
            $parent->p1_email        =  $request->get('email');
            $parent->p1_cell_phone   =  $request->get('phone');
            $parent->save();
         
            DB::commit();

            $notification = array(
                'message' => 'User Record is updated Successfully!',
                'alert-type' => 'success'
            );
         
            return redirect()->back()->with($notification);
            }catch (\Exception $e) {
            DB::rollBack();

            if ($request->expectsJson()) {
                return response()->json(['status' => 'error' ,'message' => 'Failed to update My account']);
            }
        }
    }
    public function updatePassword(Request $request,$id)
    {
    $this->validate($request, [
        'old_password'     => 'required',
        'new_password'     => 'required|min:6',
        'confirm_password' => 'required|same:new_password',
    ]);
    $data = $request->all();
    $user = User::find($id);
    if(! Hash::check($data['old_password'], $user->password)){
        $notification = array(
            'message' => 'Please enter Correct Previous Password!',
            'alert-type' => 'Error'
        );
        return redirect()->back()->with($notification);
    }else{
        $user->password =   Hash::make($data['new_password']);
        $user->save();
        $notification = array(
            'message' => 'Password Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    }
}
