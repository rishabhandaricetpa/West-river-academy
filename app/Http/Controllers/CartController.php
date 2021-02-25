<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\FeesInfo;
use App\Models\Graduation;
use App\Models\GraduationMailingAddress;
use App\Models\GraduationPayment;
use App\Models\TranscriptPayment;
use App\Models\TranscriptK8;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
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

    public function index()
    {
        $enroll_fees = Cart::getCartAmount($this->parent_profile_id);

        return view('cart', compact('enroll_fees'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();

            switch ($data['type']) {
                case 'enrollment_period':
                    for ($i = 0; $i < count($data['eps']); $i++) {
                        $item_id = $data['eps'][$i];
                        if (! Cart::where('item_id', $item_id)->where('item_type', 'enrollment_period')->exists()) {
                            Cart::create([
                                'item_type' => 'enrollment_period',
                                'item_id' => $item_id,
                                'parent_profile_id' => $this->parent_profile_id,
                            ]);
                        }
                    }
                    break;

                case 'graduation':
                    $parent_profile_id = ParentProfile::getParentId();

                    $student = StudentProfile::whereId($data['student_id'])
                                                ->where('parent_profile_id', $parent_profile_id)
                                                ->with('graduation')
                                                ->first();

                    if($student){
                        GraduationMailingAddress::create([
                            'graduation_id' => $student->graduation->id,
                            'name' => $data['name'],
                            'street' => $data['street'],
                            'city' => $data['city'],
                            'country' => $data['country'],
                            'postal_code' => $data['postal_code']
                        ]);
                        
                        if(isset($data['apostille_country']) && !empty($data['apostille_country'])){
                            // change graduation fee amount based on Apostille
                            $amount = FeesInfo::getFeeAmount('apostille') + FeesInfo::getFeeAmount('graduation');
                        }else{
                            $amount = FeesInfo::getFeeAmount('graduation');
                        }

                        Graduation::whereId($student->graduation->id)->update(['apostille_country' => $data['apostille_country']]);
                        GraduationPayment::where('graduation_id', $student->graduation->id)->update(['amount' => $amount]);

                        if (! Cart::where('item_id', $student->graduation->id)->where('item_type', 'graduation')->exists()) {
                            Cart::create([
                                'item_type' => 'graduation',
                                'item_id' => $student->graduation->id,
                                'parent_profile_id' => $parent_profile_id,
                            ]);
                        }
                    }else{
                        return redirect()->back()->with([
                            'message' => 'Invalid data entered!',
                            'alert-type' => 'error',
                        ]);
                    }
                    break;
             case 'transcript':
                        $parent_profile_id = ParentProfile::getParentId();
                        $student = StudentProfile::whereId($data['student_id'])
                                                    ->where('parent_profile_id', $parent_profile_id)
                                                    ->with('transcript')
                                                    ->first();
                        
                        $amount = FeesInfo::getFeeAmount('transcript');
                        if (! Cart::where('item_id', $request->get('transcript_id'))->where('item_type', 'transcript')->exists()) {         
                        Cart::create([
                                    'item_type' => 'transcript',
                                    'item_id' => $request->get('transcript_id'),
                                    'parent_profile_id' => $parent_profile_id,
                                ]);
                        }
                        break;
                default:
                    break;
            }
            DB::commit();
            return redirect('/cart');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();

            return redirect()->back();
        }
    }

    public function delete($id)
    {
        if (Cart::where('id', $id)->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Item removed successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to remove item']);
        }
    }
}
