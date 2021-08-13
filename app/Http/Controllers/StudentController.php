<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Country;
use App\Models\EnrollmentPayment;
use App\Models\EnrollmentPeriods;
use App\Models\FeesInfo;
use App\Models\FeeStructure;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\Transcript;
use App\Models\ConfirmationLetter;
use App\Models\User;
use App\Models\Dashboard;
use App\Models\Notification as Notification;
use App\Models\OrderPersonalConsultation;
use App\Models\UploadDocuments;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        try {
            DB::beginTransaction();
            $id = Auth::user()->id;
            $parentProfileData = User::find($id)->parentProfile()->first();
            $studentCount = StudentProfile::whereIn('parent_profile_id', [$parentProfileData->id])->get()->count();
            $country = $parentProfileData->country;
            $countryData = Country::where('country', $country)->first();
            $country_name = $countryData->country;
            if ($countryData != null) {
                $year = date('Y');
                $newYear = $year + 1;
                $year = Carbon::create($year)->format('Y');
                $month_start_date = Carbon::create($countryData->start_date)->format('m/d');
                $start_date = $year . '/' . $month_start_date;

                $sem = Carbon::parse($start_date);
                $semestermonth = $sem->addMonths(5);

                $year_end_date = Carbon::create($countryData->end_date)->format('m/d');
                $country_end_date = '12/31';
                if ($year_end_date == $country_end_date) {
                    $month_end_date = Carbon::create($countryData->end_date)->format('m/d');
                    $end_date = $year . '/' . $month_end_date;
                } else {
                    $month_end_date = Carbon::create($countryData->end_date)->format('m/d');
                    $end_date = $newYear . '/' . $month_end_date;
                }
                DB::commit();
                if ($request->expectsJson()) {
                    return response()->json($start_date);
                }
                return view('enrollment.enrollstudent', compact('start_date', 'end_date', 'semestermonth', 'studentCount', 'country_name'));
            } else {
                $start_date = Carbon::now()->format('Y/m/d');
                $end_date = Carbon::now()->addYears(1)->format('Y/m/d');
                $sem = Carbon::parse($start_date);
                $semestermonth = $sem->addMonths(5);
                return view('enrollment.enrollstudent', compact('start_date', 'end_date', 'semestermonth', 'studentCount', 'country_name'));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Enrollment Start Date and End Date Missing for your Country Please contact your Admin']);
        }
    }

    public function showstudents()
    {
        $parentId = ParentProfile::getParentId();
        $parentData = ParentProfile::whereId($parentId)->first();
        $student = StudentProfile::where('parent_profile_id', $parentId)->get();

        $student_data = StudentProfile::where('parent_profile_id', $parentId)->with('parentProfile')->first();
        $transcript = Transcript::where('parent_profile_id', $parentId)
            ->whereIn('status', ['approved', 'paid', 'completed', 'canEdit'])
            ->with('student')->get();
        $record_transfer = ParentProfile::find($parentId)->schoolRecord()->get();
        $confirmLetter = StudentProfile::where('student_profiles.parent_profile_id', $parentId)
            ->join('enrollment_periods', 'enrollment_periods.student_profile_id', 'student_profiles.id')
            ->with('enrollmentPeriods', 'confirmletter')->get();
        $personal_consultation = OrderPersonalConsultation::where('status', 'paid')->where('parent_profile_id', $parentId)->with('parent')->get();

        $uploadedDocuments = UploadDocuments::select()
            ->whereIn('parent_profile_id', [$parentId])->where('is_upload_to_student', 1)->get();
        $cartAmount =  Cart::getCartAmount($parentId);
        $amount = 0;
        foreach ($cartAmount as $cart) {
            foreach ($cart['enroll_items'] as $enroll) {
                $amount += $enroll['amount'];
            }
        }

        Notification::updateOrCreate(
            [
                'parent_profile_id' => $parentId,
                'type' => 'PayAmount'
            ],
            [
                'parent_profile_id' => $parentId,
                'content' => 'Pay Amount' . ' : ' . $amount,
                'type' => 'PayAmount',
                'read' => 'false',
            ]
        );


        return view('SignIn.dashboard', compact('student', 'transcript', 'parentId', 'record_transfer', 'student_data', 'confirmLetter', 'personal_consultation', 'uploadedDocuments', 'parentData', 'amount'));
    }

    public function confirmationpage($enrollment_payment_id, $grade_id)
    {
        $enrollments = EnrollmentPeriods::where('enrollment_payment_id', $enrollment_payment_id)->where('grade_level', $grade_id)->first();
        $student_id = $enrollments->student_profile_id;
        $student = StudentProfile::whereId($student_id)->first();
        $id = Auth::user()->id;
        $parentProfileData = User::find($id)->parentProfile()->first();
        $country = $parentProfileData->country;
        $countryData = Country::where('country', $country)->first();
        $confirmation_data = ConfirmationLetter::where('student_profile_id', $student_id)->where('enrollment_period_id', $enrollment_payment_id)->first();
        return view('confirm_letter_select', compact('student', 'student_id', 'grade_id', 'confirmation_data', 'enrollments', 'countryData'));
        // return view('viewConfirmation', compact('student', 'student_id', 'grade_id'));
    }

    public function viewDownload($enrollment_payment_id, $grade_id)
    {
        $enrollments = EnrollmentPeriods::where('enrollment_payment_id', $enrollment_payment_id)->where('grade_level', $grade_id)->first();
        $student_id = $enrollments->student_profile_id;
        $student = StudentProfile::whereId($student_id)->first();
        $confirmation_data = ConfirmationLetter::where('student_profile_id', $student_id)->where('enrollment_period_id', $enrollment_payment_id)->first();
        return view('viewConfirmation', compact('student', 'student_id', 'grade_id'));
    }
    public function saveConfirmationInformation(Request $request, $student_id, $grade_id)
    {
        $confirmation_data = ConfirmationLetter::where('student_profile_id', $student_id)->where('enrollment_period_id', $request->input('enrolment_id'))->first();
        if ($request->input('isDobCity')) {
            $confirmation_data->isDobCity = $request->input('isDobCity');
        } else {
            $confirmation_data->isDobCity = 0;
        }
        if ($request->input('IsMotherName')) {
            $confirmation_data->IsMotherName = $request->input('IsMotherName');
        } else {
            $confirmation_data->IsMotherName = 0;
        }
        if ($request->input('isGrade')) {
            $confirmation_data->isGrade = $request->input('isGrade');
        } else {
            $confirmation_data->isGrade = 0;
        }
        if ($request->input('isStudentId')) {
            $confirmation_data->isStudentId = $request->input('isStudentId');
        } else {
            $confirmation_data->isStudentId = 0;
        }
        $confirmation_data->save();
        $student = StudentProfile::whereId($student_id)->first();
        return view('viewConfirmation', compact('student', 'student_id', 'grade_id'));
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
                'd_o_b' => \Carbon\Carbon::parse($data['dob'])->format('Y/m/d'),
                'email' => $data['email'],
                'cell_phone' => $data['cell_phone'],
                'student_Id' => $data['studentID'],
                'immunized_status' => $data['immunized_status'],
                'student_situation' => $data['student_situation'],
                'mothers_name' => $data['mothersName'],
                'birth_city' => $data['birthCity'],
                'status' => 0,
            ]);
            foreach ($data->get('enrollPeriods', []) as $period) {
                $selectedStartDate = \Carbon\Carbon::parse($period['selectedStartDate']);
                $selectedEndDate = \Carbon\Carbon::parse($period['selectedEndDate']);
                $type = $selectedStartDate->diffInMonths($selectedEndDate) > 7 ? 'annual' : 'half';

                $student_enrolled = StudentProfile::where('student_profiles.parent_profile_id', $id)
                    ->where('student_profiles.id', '!=', $student->id)
                    ->leftJoin('enrollment_periods', 'enrollment_periods.student_profile_id', 'student_profiles.id')
                    ->whereDate('enrollment_periods.start_date_of_enrollment', '<=', $selectedStartDate)
                    ->whereDate('enrollment_periods.end_date_of_enrollment', '>=', $selectedEndDate)
                    ->exists();

                if (!$student_enrolled) {
                    $student_type = 'first_student';
                } else {
                    $student_type = 'additional_student';
                }

                $enrollPeriod = EnrollmentPeriods::create([
                    'student_profile_id' => $student->id,
                    'start_date_of_enrollment' =>  $selectedStartDate->format('Y/m/d'),
                    'end_date_of_enrollment' => $selectedEndDate->format('Y/m/d'),
                    'grade_level' => $period['grade'],
                    'type' => $type,
                ]);

                $fee_type = $student_type . '_' . $type;
                $fee = FeesInfo::getFeeAmount($fee_type);

                $enrollmentPayment = EnrollmentPayment::create([
                    'enrollment_period_id' => $enrollPeriod->id,
                    'status' => 'pending',
                    'amount' => $fee,
                ]);
                $enrollPeriod->enrollment_payment_id = $enrollmentPayment->id;
                $enrollPeriod->save();
                $isconfirmlink = ConfirmationLetter::where('enrollment_period_id', $enrollPeriod->id)->get();
                if (count($isconfirmlink) == 0) {
                    $confirmlink = ConfirmationLetter::create([
                        'parent_profile_id' => $id,
                        'student_profile_id' => $student->id,
                        'pdf_link' => '',
                        'status' => 'pending',
                        'enrollment_period_id' => $enrollPeriod->id
                    ]);
                    $confirmlink->save();
                }
            }
            // Dashboard::create([
            //     'parent_profile_id' =>  $parentProfileData->id,
            //     'amount' => $fee,
            //     'student_profile_id' => $student->id,
            //     'linked_to' => $student->Name,
            //     'related_to' => 'student_record_received',
            //     'created_date' => \Carbon\Carbon::now()->format('M d Y'),
            // ]);
            DB::commit();

            if ($data->expectsJson()) {
                return response()->json(['status' => 'success', 'message' => 'Student added successfully', 'data' => $student]);
            }
        } catch (\Exception $e) {
            report($e);
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
        $parent_id =  ParentProfile::getParentId();
        $students = StudentProfile::where('parent_profile_id', $parent_id)->get();
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
            $student->d_o_b = \Carbon\Carbon::parse($request->input('dob'))->format('Y/m/d');
            $student->cell_phone = $request->input('cell_phone');
            $student->student_Id = $request->input('student_Id');
            $student->immunized_status = $request->input('immunized_status');
            $student->student_situation = $request->input('student_situation');
            $student->mothers_name = $request->input('mothers_name');
            $student->birth_city = $request->input('birth_city');
            $student->save();
            $periods = collect($request->get('periods'));

            $periods->whereNull('id')->each(function ($period) use ($student) {
                $enrollPeriod = new EnrollmentPeriods();
                $this->updateEnrollPeriod($period, $student, $enrollPeriod);
            });
            $periods->whereNotNull('id')->each(function ($period) use ($student) {
                if (!EnrollmentPayment::where('enrollment_period_id', $period['id'])->where('status', 'paid')->exists()) {
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
        $parent_profile = ParentProfile::getParentId();
        $selectedStartDate = \Carbon\Carbon::parse($period['selectedStartDate']);
        $selectedEndDate = \Carbon\Carbon::parse($period['selectedEndDate']);
        $type = $selectedStartDate->diffInMonths($selectedEndDate) > 7 ? 'annual' : 'half';

        $student_enrolled = StudentProfile::where('student_profiles.parent_profile_id', $student->parent_profile_id)
            ->where('student_profiles.id', '!=', $student->id)
            ->leftJoin('enrollment_periods', 'enrollment_periods.student_profile_id', 'student_profiles.id')
            ->whereDate('enrollment_periods.start_date_of_enrollment', '<=', $selectedStartDate)
            ->whereDate('enrollment_periods.end_date_of_enrollment', '>=', $selectedEndDate)
            ->exists();

        if (!$student_enrolled) {
            $student_type = 'first_student';
        } else {
            $student_type = 'additional_student';
        }

        $enrollPeriod->fill([
            'student_profile_id' => $student->id,
            'start_date_of_enrollment' =>  $selectedStartDate->format('Y/m/d'),
            'end_date_of_enrollment' => $selectedEndDate->format('Y/m/d'),
            'grade_level' => $period['grade'],
            'type' => $type,
        ]);
        $enrollPeriod->save();
        //confirmation periods 
        $isconfirmlink = ConfirmationLetter::where('enrollment_period_id', $enrollPeriod->id)->get();
        if (count($isconfirmlink) == 0) {
            $confirmlink = ConfirmationLetter::create([
                'parent_profile_id' => $parent_profile,
                'student_profile_id' => $student->id,
                'pdf_link' => '',
                'status' => 'pending',
                'enrollment_period_id' => $enrollPeriod->id
            ]);
        }
        $EnrollmentPayment = EnrollmentPayment::where('enrollment_period_id', $enrollPeriod->id)->first();

        if (is_null($EnrollmentPayment)) {
            $EnrollmentPayment = new EnrollmentPayment();
        }

        if ($EnrollmentPayment->status == 'paid') {
            return;
        }

        $fee_type = $student_type . '_' . $type;
        $fee = FeesInfo::getFeeAmount($fee_type);

        $EnrollmentPayment->fill([
            'enrollment_period_id' => $enrollPeriod->id,
            'status' => 'pending',
            'amount' => $fee,
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
        $country_name = $countryData->country;
        if ($countryData != null) {
            $start_date = $countryData->start_date;
            $sem = Carbon::parse($start_date);
            $semestermonth = $sem->addMonths(5);
            $countryId = $countryData->id;
            $studentData = StudentProfile::find($id);
            $enrollPeriods = EnrollmentPeriods::where('student_profile_id', $id)
                ->leftJoin('enrollment_payments', 'enrollment_payments.id', 'enrollment_periods.enrollment_payment_id')
                ->select('enrollment_periods.*', 'enrollment_payments.status')
                ->orderBy('enrollment_payments.status', 'desc')
                ->get();
            $birth = Carbon::parse($studentData->d_o_b)->toDateString();
            return view('enrollment.edit-enrollstudent', compact('studentData', 'enrollPeriods', 'countryData', 'semestermonth', 'birth', 'country_name'));
        } else {
            $countryData = Country::where('country', 'other')->first();
            $start_date = $countryData->start_date;
            $sem = Carbon::parse($start_date);
            $semestermonth = $sem->addMonths(5);
            $studentData = StudentProfile::find($id);
            $enrollPeriods = EnrollmentPeriods::where('student_profile_id', $id)
                ->leftJoin('enrollment_payments', 'enrollment_payments.id', 'enrollment_periods.enrollment_payment_id')
                ->select('enrollment_periods.*', 'enrollment_payments.status')
                ->orderBy('enrollment_payments.status', 'desc')
                ->get();

            return view('enrollment.edit-enrollstudent', compact('studentData', 'enrollPeriods', 'countryData', 'semestermonth', 'country_name'));
        }
    }

    private function getFinalAmount()
    {
        $enroll_fees = Cart::getCartAmount($this->parent_profile_id, true);

        if (empty($enroll_fees->amount)) {
            return false;
        }

        $coupon_amount = session('applied_coupon_amount', 0);
        $final_amount = $coupon_amount > $enroll_fees->amount ? 1 : $enroll_fees->amount - $coupon_amount;

        return $final_amount;
    }

    public function orderReview($parent_id)
    {
        $address = User::find($parent_id)->parentProfile()->first();
        $final_amount = $this->getFinalAmount();

        if ($final_amount === false) {
            return view('Billing.invalid');
        }

        return view('Billing.order-review', compact('address', 'final_amount', 'parent_id'));
    }

    public function paypalorderReview($parent_id)
    {
        $address = User::find($parent_id)->parentProfile()->first();
        $final_amount = $this->getFinalAmount();

        if ($final_amount === false) {
            return view('Billing.invalid');
        }

        return view('paywithpaypal', compact('address', 'final_amount'));
    }

    public function stripeorderReview($parent_id)
    {
        $address = User::find($parent_id)->parentProfile()->first();
        $final_amount = $this->getFinalAmount();

        if ($final_amount === false) {
            return view('Billing.invalid');
        }

        return view('Billing/creditcard', compact('address', 'final_amount'));
    }

    public function moneyorderReview($parent_id)
    {
        $address = User::find($parent_id)->parentProfile()->first();
        $final_amount = $this->getFinalAmount();

        if ($final_amount === false) {
            return view('Billing.invalid');
        }

        return view('Billing.chequereview', compact('address', 'final_amount', 'parent_id'));
    }

    public function moneygramReview($parent_id)
    {
        $address = User::find($parent_id)->parentProfile()->first();
        $final_amount = $this->getFinalAmount();

        if ($final_amount === false) {
            return view('Billing.invalid');
        }

        return view('Billing.moneygram', compact('address', 'final_amount', 'parent_id'));
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
