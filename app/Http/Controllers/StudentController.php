<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Auth;
use App\Models\ParentProfile;
use App\Models\User;
use App\Models\StudentProfile;
use App\Models\FeeStructure;
use App\Models\Address;
use App\Models\EnrollmentPeriods;
use App\Models\EnrollmentPayment;
use App\Models\FeesInfo;
use App\Models\Cart;
use App\Providers\RouteServiceProvider;
use Faker\Calculator\Ean;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Helpers\EnrollmentHelper;

class StudentController extends Controller
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
    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:strict', 'max:255', 'unique:users'],
            'd_o_b' => ['required'],
        ]);
    }
    public function index(Request $request)
    {
        $id = auth()->user()->id;
        $parentProfileData = User::find($id)->parentProfile()->first();
        $country = $parentProfileData->country;
        $countryData = Country::where('country', $country)->first();
        $countryId = $countryData->id;
        if ($request->expectsJson()) {
            return response()->json($countryData);
        }
        return view('enrollstudent', compact('countryData'));
    }

    protected function store(Request $data)
    {
        try{
            DB::beginTransaction();
            $Userid = auth()->user()->id;
            $parentProfileData = User::find($Userid)->parentProfile()->first();
            $id = $parentProfileData->id;
            
            $student =  StudentProfile::create([
                'parent_profile_id' => $id,
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'd_o_b' => \Carbon\Carbon::parse($data['dob'])->format('Y-m-d'),
                'email' => $data['email'],
                'cell_phone' => $data['cell_phone'],
                'student_Id' => $data['studentID'],
                'immunized_status' => $data['immunized_status'],
                'student_situation' => $data['student_situation'],
                'status' => 0,
            ]);

            foreach ($data->get('enrollPeriods', []) as $period) {
                $selectedStartDate = \Carbon\Carbon::parse($period['selectedStartDate']);
                $selectedEndDate = \Carbon\Carbon::parse($period['selectedEndDate']);
                $type = $selectedStartDate->diffInMonths($selectedEndDate) > 7 ? 'annual' : 'half';

                $enroll_year = $selectedStartDate->year;

                $student_enrolled = StudentProfile::where('student_profiles.parent_profile_id',$id)
                                                    ->where('student_profiles.id','!=', $student->id)
                                                    ->leftJoin('enrollment_periods','enrollment_periods.student_profile_id','student_profiles.id')
                                                    ->whereYear('enrollment_periods.start_date_of_enrollment',$enroll_year)
                                                    ->exists();

                if(!$student_enrolled){
                    $student_type = 'first_student';
                }else{
                    $student_type = 'additional_student';
                }

                $enrollPeriod = EnrollmentPeriods::create([
                    'student_profile_id' => $student->id,
                    'start_date_of_enrollment' =>  $selectedStartDate->format('Y-m-d'),
                    'end_date_of_enrollment' => $selectedEndDate->format('Y-m-d'),
                    'grade_level' => $period['grade'],
                    'type' => $type
                ]);

                $fee_type = $student_type.'_'.$type;
                $fee = FeesInfo::select('amount')->where('type',$fee_type)->first();

                $enrollmentPayment = EnrollmentPayment::create([
                    'enrollment_period_id' => $enrollPeriod->id,
                    'status' => 'pending',
                    'amount' => $fee->amount
                ]);

                $enrollPeriod->enrollment_payment_id = $enrollmentPayment->id;
                $enrollPeriod->save();
            }
            DB::commit();

            if ($data->expectsJson()) {
                return response()->json(['status' => 'success' ,'message' => 'Student added successfully', 'data' => $student]);
            }
        }catch (\Exception $e) {
            DB::rollBack();

            if ($data->expectsJson()) {
                return response()->json(['status' => 'error' ,'message' => 'Failed to add student']);
            }
        }
    }
    /**
     * review student data on review page
     */
    public function reviewStudent()
    {
        $user_id = Auth::user()->id;
        $students = ParentProfile::find($user_id)->studentProfile()->get();

        $fees = ParentProfile::getParentPendingFees($user_id);
        return view('reviewstudent', compact('students', 'fees'));
    }

    public function update(Request $request, $id)
    {
        try{
            DB::beginTransaction();

            $student = StudentProfile::find($id);
            $student->first_name = $request->input('first_name');
            $student->middle_name = $request->input('middle_name');
            $student->last_name = $request->input('last_name');
            $student->email = $request->input('email');
            $student->d_o_b = \Carbon\Carbon::parse($request->input('dob'))->format('Y-m-d');
            $student->cell_phone = $request->input('cell_phone');
            $student->student_Id = $request->input('student_Id');
            $student->immunized_status = $request->input('immunized_status');
            $student->student_situation = $request->input('student_situation');
            $student->save();
            $periods = collect($request->get('periods'));
           
            $periods->whereNull('id')->each(function ($period) use ($student) {
                $enrollPeriod = new EnrollmentPeriods();
                $this->updateEnrollPeriod($period, $student, $enrollPeriod);
            });
            $periods->whereNotNull('id')->each(function ($period) use ($student) {
                if(!EnrollmentPayment::where('enrollment_period_id',$period['id'])->where('status','paid')->exists()){
                    $enrollPeriod = EnrollmentPeriods::find($period['id']);
                    $this->updateEnrollPeriod($period, $student, $enrollPeriod);
                }
            });

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json(['status' => 'success' ,'message' => 'Student updated successfully']);
            }
        }catch (\Exception $e) {
            DB::rollBack();

            if ($request->expectsJson()) {
                return response()->json(['status' => 'error' ,'message' => 'Failed to update student']);
            }
        }
    }

    public function updateEnrollPeriod($period, $student, $enrollPeriod){
        $selectedStartDate = \Carbon\Carbon::parse($period['selectedStartDate']);
        $selectedEndDate = \Carbon\Carbon::parse($period['selectedEndDate']);
        $type = $selectedStartDate->diffInMonths($selectedEndDate) > 7 ? 'annual' : 'half';

        $enroll_year = $selectedStartDate->year;
        
        $student_enrolled = StudentProfile::where('student_profiles.parent_profile_id',$student->parent_profile_id)
                                            ->where('student_profiles.id','!=', $student->id)
                                            ->leftJoin('enrollment_periods','enrollment_periods.student_profile_id','student_profiles.id')
                                            ->whereYear('enrollment_periods.start_date_of_enrollment',$enroll_year)
                                            ->exists();

        if(!$student_enrolled){
            $student_type = 'first_student';
        }else{
            $student_type = 'additional_student';
        }

        $enrollPeriod->fill([
            'student_profile_id' => $student->id,
            'start_date_of_enrollment' =>  $selectedStartDate->format('Y-m-d'),
            'end_date_of_enrollment' => $selectedEndDate->format('Y-m-d'),
            'grade_level' => $period['grade'],
            'type' => $type
        ]);
        $enrollPeriod->save();

        $EnrollmentPayment = EnrollmentPayment::where('enrollment_period_id', $enrollPeriod->id)->first();

        if(is_null($EnrollmentPayment)){
            $EnrollmentPayment = new EnrollmentPayment();
        }

        if($EnrollmentPayment->status == 'paid'){
            return;
        }
        
        $fee_type = $student_type.'_'.$type;
        $fee = FeesInfo::select('amount')->where('type',$fee_type)->first();

        $EnrollmentPayment->fill([
            'enrollment_period_id' => $enrollPeriod->id,
            'status' => 'pending',
            'amount' => $fee->amount
        ]);

        $EnrollmentPayment->save();

        $enrollPeriod->enrollment_payment_id = $EnrollmentPayment->id;
        $enrollPeriod->save();
    }

    public function edit($id)
    {
        $parentProfileData = User::find(auth()->user()->id)->parentProfile()->first();
        $country = $parentProfileData->country;
        $countryData = Country::where('country', $country)->first();
        $countryId = $countryData->id;
        $studentData = StudentProfile::find($id);
        $enrollPeriods =  EnrollmentPeriods::where('student_profile_id',$id) 
                                            ->leftJoin('enrollment_payments','enrollment_payments.id','enrollment_periods.enrollment_payment_id')
                                            ->select('enrollment_periods.*','enrollment_payments.status')
                                            ->orderBy('enrollment_payments.status','desc')
                                            ->get();
        return view('edit-enrollstudent', compact('studentData', 'enrollPeriods', 'countryData'));
    }
  
    public function address($id)
    {    
         $user_id = Auth::user()->id;
         $parent = ParentProfile::find($user_id)->first();
         $enroll_fees = Cart::getCartAmount($this->parent_profile_id,true);
         $country_list  =  Country::select('country')->get();
         return view('Billing/cart-billing', compact('parent','country_list','enroll_fees'));
    }
    /**
     * This function is used to store billing and shipping address
     */
    protected function saveaddress(Request $request)
    {   
        try{
                $address = new Address();
                $billing_data = $request->input('billing_address');
                $shipping_data = $request->input('shipping_address');
                $payment_type = $request->input('paymentMethod');
                $Userid = Auth::user()->id;
                $parentProfileData = User::find($Userid)->parentProfile()->first();
                $id = $parentProfileData->id;
                $billinAddress =  Address::create([
                    'parent_profile_id' => $id,
                    'billing_street_address' => $billing_data['street_address'],
                    'billing_city' => $billing_data['city'],
                    'billing_state' => $billing_data['state'],
                    'billing_zip_code' => $billing_data['zip_code'],
                    'billing_country' => $billing_data['country'],
                    'shipping_street_address' => $shipping_data['street_address'],
                    'shipping_city' => $shipping_data['city'],
                    'shipping_state' => $shipping_data['state'],
                    'shipping_zip_code' => $shipping_data['zip_code'],
                    'shipping_country' => $shipping_data['country'],
                    'email'=> $request['email'],
                ]);
                $parentaddress = ParentProfile::find($Userid)->first();
                $parentaddress->fill([
                    'street_address' => $billing_data['street_address'],
                    'city' => $billing_data['city'],
                    'state' => $billing_data['state'],
                    'zip_code' => $billing_data['zip_code'],
                    'country' => $billing_data['country'],
                ]);
                $parentaddress->save();
                if($payment_type['payment_type']=="Credit Card"){
                    return route('stripe.payment');
                }
                elseif($payment_type['payment_type']=="Pay Pal"){
                    return route('paywithpaypal');
                }
                elseif($payment_type['payment_type']=="Bank Transfer"){
                    return route('order.review');
                }
                elseif($payment_type['payment_type']=="Check or Money Order"){
                    return route('money.order');
                }
            } catch (\Exception $e) {   
                DB::rollBack();
            }
    }
    public function orderReview($parent_id){

       $address= ParentProfile::find($parent_id)->select('street_address','city','state','zip_code','country','p1_first_name','p1_last_name')->first();
       $enroll_fees = Cart::getCartAmount($this->parent_profile_id,true);
       return view('Billing.order-review',compact('address','enroll_fees','parent_id'));
    
    }
    
    public function paypalorderReview($parent_id){
        $address= ParentProfile::find($parent_id)->select('street_address','city','state','zip_code','country','p1_first_name','p1_last_name')->first();
        $enroll_fees = Cart::getCartAmount($this->parent_profile_id,true);
        return view('paywithpaypal',compact('address','enroll_fees'));
     
     }
     public function stripeorderReview($parent_id){
        $address= ParentProfile::find($parent_id)->select('street_address','city','state','zip_code','country','p1_first_name','p1_last_name')->first();
        $enroll_fees = Cart::getCartAmount($this->parent_profile_id,true);
        return view('Billing/creditcard',compact('address','enroll_fees'));
     
     }
     public function moneyorderReview($parent_id){
        $address= ParentProfile::find($parent_id)->select('street_address','city','state','zip_code','country','p1_first_name','p1_last_name')->first();
        $enroll_fees = Cart::getCartAmount($this->parent_profile_id,true);
        return view('Billing.chequereview',compact('address','enroll_fees','parent_id'));
     
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
            $parent1=  User::find($id)->parentProfile()->first();
            $parent_id = $parent1->id;
            $parent = ParentProfile::find(1)->first();
            $parent->p1_first_name   =  $request->get('first_name');
            $parent->p1_last_name    =  $request->get('last_name');
            $parent->p1_email        =  $request->get('email');
            $parent->p1_cell_phone   =  $request->get('phone');
            $parent->save();
            $notification = array(
                'message' => 'parent Record is updated Successfully!',
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
            
    public function delete(Request $request, $id)
    {
        try{
            DB::beginTransaction();
            $periods_id = collect($request->get('periods'))->pluck('id');
            $enrollPeriods =  StudentProfile::find($id)->enrollmentPeriods()->get();
            $enrollPeriodId = collect($enrollPeriods)->pluck('id');

            $diff = $enrollPeriodId->diff($periods_id);

            EnrollmentPeriods::whereIn('id', $diff)->delete();
           
            DB::commit();
           
            if ($request->expectsJson()) {
                return response()->json(['status' => 'success' ,'message' => 'Successfully removed period']);
            }
         }   catch (\Exception $e) {
            DB::rollBack();

            if ($request->expectsJson()) {
                return response()->json(['status' => 'error' ,'message' => 'Failed to update My account']);
            }
        }
    }

}
