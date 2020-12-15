<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\ParentProfile;
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

    }
      /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function parentData()
    {
        $data = ParentProfile::all();
        return view('admin.familyInformation.view-parent',compact('data'));
    }
}
