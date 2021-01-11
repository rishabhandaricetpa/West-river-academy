<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\User;
use Auth;

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
        try{
            DB::beginTransaction();
            $data = $request->all();

            switch ($data['type']) {
                case 'enrollment_period':
                    for ($i=0; $i < count($data['eps']); $i++) { 
                        $item_id = $data['eps'][$i];
                        if(!Cart::where('item_id',$item_id)->where('item_type','enrollment_period')->exists()){
                            Cart::create([
                                'item_type' => 'enrollment_period',
                                'item_id' => $item_id,
                                'parent_profile_id' => $this->parent_profile_id
                            ]);
                        }
                    }
                    break;
                
                default:
                    break;
            }

            DB::commit();

            $this->index();
            
        }catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }
    }
}
