<?php

namespace App\Http\Controllers;

use App\Helpers\EnrollmentHelper;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Country;
use App\Models\EnrollmentPayment;
use App\Models\EnrollmentPeriods;
use App\Models\FeesInfo;
use App\Models\FeeStructure;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Auth;
use Carbon\Carbon;
use Faker\Calculator\Ean;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    private $parent_profile_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $Userid = Auth::user()->id;
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
        $id = Auth::user()->id;
        $parentProfileData = User::find($id)->parentProfile()->first();
        $country = $parentProfileData->country;
        $countryData = Country::where('country', $country)->first();
        $year = date('Y');
        $year = Carbon::create($year)->format('Y');
        $month_date = Carbon::create($countryData->start_date)->format('m-d');
        $start_date = $year.'-'.$month_date;
        if ($request->expectsJson()) {
            return response()->json($start_date);
        }

        return view('enrollstudent', compact('start_date'));
    }

    public function showstudents()
    {
        $id = Auth::user()->id;
        $parentProfileData = User::find($id)->parentProfile()->first();
        $parentId = $parentProfileData->id;
        $student = StudentProfile::where('parent_profile_id', $parentId)->get();

        return view('SignIn.dashboard', compact('student'));
    }

    public function confirmationpage($id)
    {
        $student = StudentProfile::all();

        return view('viewConfirmation', compact('student', 'id'));
    }

    protected function store(Request $data)
    {
        try {
            DB::beginTransaction();
            $Userid = Auth::user()->id;
            $parentProfileData = User::find($Userid)->parentProfile()->first();
            $id = $parentProfileData->id;

            $student = StudentProfile::create([
                'parent_profile_id' => $id,
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'gender' => $data['gender'],
                'd_o_b' => \Carbon\Carbon::parse($data['dob'])->format('M d Y'),
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

                $student_enrolled = StudentProfile::where('student_profiles.parent_profile_id',$id)
                                                    ->where('student_profiles.id','!=', $student->id)
                                                    ->leftJoin('enrollment_periods','enrollment_periods.student_profile_id','student_profiles.id')
                                                    ->whereDate('enrollment_periods.start_date_of_enrollment','<=',$selectedStartDate)
                                                    ->whereDate('enrollment_periods.end_date_of_enrollment','>=',$selectedEndDate)
                                                    ->exists();

                if (! $student_enrolled) {
                    $student_type = 'first_student';
                } else {
                    $student_type = 'additional_student';
                }

                $enrollPeriod = EnrollmentPeriods::create([
                    'student_profile_id' => $student->id,
                    'start_date_of_enrollment' =>  $selectedStartDate->format('M d Y'),
                    'end_date_of_enrollment' => $selectedEndDate->format('M d Y'),
                    'grade_level' => $period['grade'],
                    'type' => $type,
                ]);

                $fee_type = $student_type.'_'.$type;
                $fee = FeesInfo::select('amount')->where('type', $fee_type)->first();

                $enrollmentPayment = EnrollmentPayment::create([
                    'enrollment_period_id' => $enrollPeriod->id,
                    'status' => 'pending',
                    'amount' => $fee->amount,
                ]);

                $enrollPeriod->enrollment_payment_id = $enrollmentPayment->id;
                $enrollPeriod->save();
            }
            DB::commit();

            if ($data->expectsJson()) {
                return response()->json(['status' => 'success', 'message' => 'Student added successfully', 'data' => $student]);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            if ($data->expectsJson()) {
                return response()->json(['status' => 'error', 'message' => 'Failed to add student']);
            }
        }
    }

    /**
     * review student data on review page.
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
        try {
            DB::beginTransaction();

            $student = StudentProfile::find($id);
            $student->first_name = $request->input('first_name');
            $student->middle_name = $request->input('middle_name');
            $student->last_name = $request->input('last_name');
            $student->email = $request->input('email');
            $student->gender = $request->input('gender');
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
                if (! EnrollmentPayment::where('enrollment_period_id', $period['id'])->where('status', 'paid')->exists()) {
                    $enrollPeriod = EnrollmentPeriods::find($period['id']);
                    $this->updateEnrollPeriod($period, $student, $enrollPeriod);
                }
            });

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json(['status' => 'success', 'message' => 'Student updated successfully']);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->expectsJson()) {
                return response()->json(['status' => 'error', 'message' => 'Failed to update student']);
            }
        }
    }

    public function updateEnrollPeriod($period, $student, $enrollPeriod)
    {
        $selectedStartDate = \Carbon\Carbon::parse($period['selectedStartDate']);
        $selectedEndDate = \Carbon\Carbon::parse($period['selectedEndDate']);
        $type = $selectedStartDate->diffInMonths($selectedEndDate) > 7 ? 'annual' : 'half';

        $student_enrolled = StudentProfile::where('student_profiles.parent_profile_id',$student->parent_profile_id)
                                            ->where('student_profiles.id','!=', $student->id)
                                            ->leftJoin('enrollment_periods','enrollment_periods.student_profile_id','student_profiles.id')
                                            ->whereDate('enrollment_periods.start_date_of_enrollment','<=',$selectedStartDate)
                                            ->whereDate('enrollment_periods.end_date_of_enrollment','>=',$selectedEndDate)
                                            ->exists();

        if (! $student_enrolled) {
            $student_type = 'first_student';
        } else {
            $student_type = 'additional_student';
        }

        $enrollPeriod->fill([
            'student_profile_id' => $student->id,
            'start_date_of_enrollment' =>  $selectedStartDate->format('Y-m-d'),
            'end_date_of_enrollment' => $selectedEndDate->format('Y-m-d'),
            'grade_level' => $period['grade'],
            'type' => $type,
        ]);
        $enrollPeriod->save();

        $EnrollmentPayment = EnrollmentPayment::where('enrollment_period_id', $enrollPeriod->id)->first();

        if (is_null($EnrollmentPayment)) {
            $EnrollmentPayment = new EnrollmentPayment();
        }

        if ($EnrollmentPayment->status == 'paid') {
            return;
        }

        $fee_type = $student_type.'_'.$type;
        $fee = FeesInfo::select('amount')->where('type', $fee_type)->first();

        $EnrollmentPayment->fill([
            'enrollment_period_id' => $enrollPeriod->id,
            'status' => 'pending',
            'amount' => $fee->amount,
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
        $enrollPeriods = EnrollmentPeriods::where('student_profile_id', $id)
                                            ->leftJoin('enrollment_payments', 'enrollment_payments.id', 'enrollment_periods.enrollment_payment_id')
                                            ->select('enrollment_periods.*', 'enrollment_payments.status')
                                            ->orderBy('enrollment_payments.status', 'desc')
                                            ->get();

        return view('edit-enrollstudent', compact('studentData', 'enrollPeriods', 'countryData'));
    }

    public function orderReview($parent_id)
    {
        $address = User::find($parent_id)->parentProfile()->first();
        $enroll_fees = Cart::getCartAmount($this->parent_profile_id, true);
        $coupon_amount = session('applied_coupon_amount',0);
        $final_amount=$coupon_amount > $enroll_fees->amount ? 0 : $enroll_fees->amount - $coupon_amount;

        return view('Billing.order-review', compact('address', 'final_amount', 'parent_id'));
    }
    
    public function paypalorderReview($parent_id){
        $address= User::find($parent_id)->parentProfile()->first();
        $enroll_fees = Cart::getCartAmount($this->parent_profile_id,true);
        $coupon_amount = session('applied_coupon_amount',0);
        $final_amount = $coupon_amount > $enroll_fees->amount ? 0 : $enroll_fees->amount - $coupon_amount;
       
        return view('paywithpaypal',compact('address','final_amount'));
     
     }
     public function stripeorderReview($parent_id){
        $address= User::find($parent_id)->parentProfile()->first();
        $enroll_fees = Cart::getCartAmount($this->parent_profile_id,true);
        $coupon_amount = session('applied_coupon_amount',0);
        $final_amount = $coupon_amount > $enroll_fees->amount ? 0 : $enroll_fees->amount - $coupon_amount;
        
        return view('Billing/creditcard',compact('address','final_amount'));
     
     }
     public function moneyorderReview($parent_id){
        $address= User::find($parent_id)->parentProfile()->first();
        $enroll_fees = Cart::getCartAmount($this->parent_profile_id,true);
        $coupon_amount = session('applied_coupon_amount',0);
        $final_amount = $coupon_amount > $enroll_fees->amount ? 0 : $enroll_fees->amount - $coupon_amount;
        
        return view('Billing.chequereview',compact('address','final_amount','parent_id'));
     
     }
        
    public function moneygramReview($parent_id){
        $address   = User::find($parent_id)->parentProfile()->first();
        $enroll_fees = Cart::getCartAmount($this->parent_profile_id,true);
        $coupon_amount = session('applied_coupon_amount',0);
        $final_amount = $coupon_amount > $enroll_fees->amount ? 0 : $enroll_fees->amount - $coupon_amount;

        return view('Billing.moneygram',compact('address','final_amount','parent_id'));
    }

    public function deleteEnroll(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $periods_id = collect($request->get('periods'))->pluck('id');
            $enrollPeriods = StudentProfile::find($id)->enrollmentPeriods()->get();
            $enrollPeriodId = collect($enrollPeriods)->pluck('id');

            $diff = $enrollPeriodId->diff($periods_id);

            EnrollmentPayment::whereIn('enrollment_period_id', $diff)->delete();
            Cart::whereIn('item_id', $diff)->where('item_type', 'enrollment_period')->delete();

            EnrollmentPeriods::whereIn('id', $diff)->delete();

            DB::commit();
            if ($request->expectsJson()) {
                return response()->json(['status' => 'success', 'message' => 'Successfully removed enroll period']);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->expectsJson()) {
                return response()->json(['status' => 'error', 'message' => 'Failed to remove enroll period']);
            }
        }
    }
}
