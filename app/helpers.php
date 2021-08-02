<?php

use App\Models\FeesInfo;
use App\Models\Country;
use App\Models\Transcript9_12;
use App\Models\AdvancePlacement;
use App\Models\TranscriptCourse9_12;
use App\Models\CollegeCourse;
use App\Models\TranscriptPdf;
use App\Models\StudentProfile;
use App\Models\ConfirmationLetter;
use App\Models\CustomLetterPayment;
use App\Models\CustomPayment;
use App\Models\EnrollmentPayment;
use App\Models\EnrollmentPeriods;
use App\Models\GraduationPayment;
use App\Models\NotarizationPayment;
use App\Models\Notes;
use App\Models\Cart;
use App\Models\OrderPersonalConsultation;
use App\Models\OrderPostage;
use App\Models\ParentProfile;
use App\Models\RecordTransfer;
use App\Models\TransactionsMethod;
use App\Models\Transcript;
use App\Models\TranscriptPayment;
use App\Models\UploadDocuments;
use Illuminate\Support\Carbon;

use function Clue\StreamFilter\fun;

/**
 * Compare given route with current route and return output if they match.
 *
 * @param string|array $pattern
 * @param string $output
 *
 * @return null|string
 */
function active_route($pattern, $output = 'active')
{
    return \Illuminate\Support\Facades\Route::is($pattern) ? $output : null;
}

//used to calculate the k-8 transcript
function getMetrixValues($course, $data, $transcriptData)
{
    try {
        $subjects = $course->toArray();

        if ($transcriptData) :

            $transcriptDetails = $data->transcriptDetails;

            foreach ($transcriptDetails as $key => $value) {
                if ($value['k8transcript_id'] === $data['id'] && $value['subject_id'] === $course['subject_id']) {
                    return $value['score'];
                }
            }
        endif;
    } catch (\Throwable $th) {
        return false;
    }
}

//get fee deatils
function getFeeDetails($type)
{
    try {
        $fees = FeesInfo::whereType($type)->first();
        return ($fees->amount);
    } catch (\Throwable $th) {
        return false;
    }
}

//fetch promoted grads for transcript according to last value
function getPromotedGrades($grades, $last_value = true)
{
    try {
        $gradeDetails = array();

        $orders = array(
            "Ungraded" => 0,
            "Preschool Age 3" => 1,
            "Preschool Age 3" => 2,
            'Kindergarten' => 3,
            '1' => 4,
            '2' => 5,
            '3' => 6,
            '4' => 7,
            '5' => 8,
            '6' => 9,
            '7' => 10,
            '8' => 11,
            '9' => 12,
            '10' => 13,
            '11' => 14,
            '12' => 15,
        );
        $grades = $grades->map(function ($grade) use ($orders) {
            $grade->order = $orders[$grade->grade];
            return $grade;
        });
        $sortedOrder = $grades->sortBy("order")->pluck("grade")->unique()->toArray();
        $length = count($sortedOrder);
        if ($last_value && $length > 1) {
            $sortedOrder[$length - 1] =  " and " . $sortedOrder[$length - 1];
        }

        return implode(", ", $sortedOrder);
    } catch (\Throwable $th) {
        return false;
    }
}

//fetch promoted grads for the transcript
function getPromtedGrade($grades)
{
    try {
        $getArrayOrder = getPromotedGrades($grades, false);

        $eplode = explode(", ", $getArrayOrder);
        $last = end($eplode);
        if ($last == 'Ungraded') {
            return 'Preschool Age 3';
        } elseif ($last == 'Preschool Age 3') {
            return 'Preschool Age 4';
        } elseif ($last == 'Preschool Age 4') {
            return 'Kindergarten';
        } elseif ($last == '12') {
            return 'Graduation';
        } else {
            return $last + 1;
        }
    } catch (\Throwable $th) {
        return false;
    }
}

//Get the custom letter Quantity
function getCustomLetterQuantity($amount)
{
    $customletterfee = FeesInfo::getFeeAmount('custom_letter');
    $quantity = $amount / $customletterfee;
    return $quantity;
}

//get country postage chanrgess
function getCountryAmount($country)
{
    $postage_charges = Country::select('postage_charges')->where('country', $country)->first();
    return $postage_charges;
}

//fetch transcript 9_12 data deatils for transcript print view
function fetchTranscript9_12Details($transcriptData)
{
    $courses = collect([]);
    $courseInProgress = collect([]);
    // for academic years and courses
    $transcriptData->each(function ($transcript_courses) use ($courses, $courseInProgress) {
        $transcript_courses->TranscriptCourse9_12->map(function ($course) use ($transcript_courses, $courses, $courseInProgress) {
            if ($course->score !== 'In Progress') {
                $courses->push(
                    (object)[
                        'id' => $course->id,
                        'score' => $course->score,
                        'name' => $course->subject->subject_name,
                        'credit' => $course->credit->credit,
                        'groupBy' => $transcript_courses->enrollment_year,
                        'grade' => $transcript_courses->grade,
                        'type' => 'year'
                    ]
                );
            } else {
                $courseInProgress->push(
                    (object)[
                        'id' => $course->id,
                        'score' => '-',
                        'name' => $course->subject->subject_name,
                        'credit' => $course->credit->credit,
                        'groupBy' => 'Courses In Progres',
                        'grade' => $transcript_courses->grade,
                        'type' => 'courseInProgress'
                    ]
                );
            }
        });
    });
    /** for college courses */
    $collegeCourses = collect([]);
    $transcriptData->each(function ($college_courses) use ($collegeCourses) {
        $college_courses->collegeCourses->map(function ($cllg_course) use ($collegeCourses) {
            $collegeCourses->push(
                (object)[
                    'id' => $cllg_course->id,
                    'groupBy' => $cllg_course->name,
                    'course_name' => $cllg_course->course_name,
                    'grade' => $cllg_course->grade,
                    'course_grade'  => $cllg_course->course_grade,
                    'selectedCredit' => $cllg_course->selectedCredit,
                    'type' => 'college'
                ]
            );
        });
    });

    /** for ap courses */
    $apCourses = collect([]);
    $transcriptData->each(function ($college_courses) use ($apCourses) {
        $college_courses->apCourses->map(function ($ap_course) use ($apCourses) {
            $apCourses->push(
                (object)[
                    'id' => $ap_course->id,
                    'groupBy' => $ap_course->name,
                    'course_name' => $ap_course->ap_course_name,
                    'grade' => $ap_course->ap_course_grade,
                    'course_grade'  => $ap_course->ap_course_grade,
                    'selectedCredit' => $ap_course->ap_course_credits,
                    'type' => 'apCourses'
                ]
            );
        });
    });

    $courses = $courses->merge($collegeCourses)->merge($courseInProgress)->merge($apCourses);
    return $courses;
}

//get G.P.A for the student for transcript
function getGPAvalue($courses, $total_credits_earned)
{
    $academy_points = array(
        "A" => 4,
        "B" => 3,
        "C" => 2,
        'D' => 1,
        'F' => 0,
        'PASS' => 0,
        'In Progress' => 0,
        'P' => 0,
        'Pass' => 0,
    );
    $academy_points_carnegia = array(
        "A" => 40,
        "B" => 30,
        "C" => 20,
        'D' => 10,
        'F' => 0,
        'PASS' => 0,
        'In Progress' => 0,
        'P' => 0,
        'Pass' => 0,
    );
    $college_points = array(
        "A" => 5,
        "B" => 4,
        "C" => 3,
        'D' => 2,
        'F' => 0,
        'PASS' => 0,
        'In Progress' => 0,
        'P' => 0,
        'Pass' => 0,

    );
    $is_caragie = array(
        "A" => 50,
        "B" => 40,
        "C" => 30,
        'D' => 20,
        'F' => 0,
        'PASS' => 0,
        'In Progress' => 0,
        'P' => 0,
        'Pass' => 0,

    );
    $course = $courses->map(function ($course) use ($academy_points, $is_caragie, $college_points, $academy_points_carnegia) {
        if ($course->type === 'year') {
            if ($course->credit === 1.0) {
                $course->order = $academy_points[$course->score];
            } elseif ($course->credit === 0.5) {
                $course->order = $academy_points[$course->score] / 2;
            } elseif ($course->credit === 0.25) {
                $course->order = $academy_points[$course->score] / 3;
            }
            if ($course->credit === 10.0) {
                $course->order = $academy_points_carnegia[$course->score];
            } elseif ($course->credit === 5.0) {
                $course->order = $academy_points_carnegia[$course->score] / 2;
            } elseif ($course->credit === 2.5) {
                $course->order = $academy_points_carnegia[$course->score] / 3;
            }
        }
        if ($course->type === 'college') {
            if ($course->selectedCredit === 10.0) {
                $course->order = $is_caragie[$course->course_grade];
            } elseif ($course->selectedCredit === 5.0) {
                $course->order = $is_caragie[$course->course_grade] / 2;
            } elseif ($course->selectedCredit === 2.5) {
                $course->order = $is_caragie[$course->course_grade] / 3;
            } elseif ($course->selectedCredit === 1.0) {
                $course->order = $college_points[$course->course_grade];
            } elseif ($course->selectedCredit === 0.5) {
                $course->order = $college_points[$course->course_grade] / 2;
            } elseif ($course->selectedCredit === 0.25) {
                $course->order = $college_points[$course->course_grade] / 3;
            }
        }
        if ($course->type === 'apCourses') {

            if ($course->selectedCredit === 10.0) {
                $course->order = $is_caragie[$course->grade];
            } elseif ($course->selectedCredit === 5.0) {
                $course->order = $is_caragie[$course->grade] / 2;
            } elseif ($course->selectedCredit === 2.5) {
                $course->order = $is_caragie[$course->grade] / 3;
            } elseif ($course->selectedCredit === 1.0) {
                $course->order = $college_points[$course->course_grade];
            } elseif ($course->selectedCredit === 0.5) {
                $course->order = $college_points[$course->course_grade] / 2;
            } elseif ($course->selectedCredit === 0.25) {
                $course->order = $college_points[$course->course_grade] / 3;
            }
        }
        if ($course->type === 'courseInProgress') {
            $course->order = 0;
        }

        return $course;
    });
    $sumForAcademicYear = collect($course)->pluck('order')->sum();
    $academicGpa = floatval($sumForAcademicYear) / floatval($total_credits_earned);
    return round($academicGpa, 2);
}


//get Total credits for the student on transcript view
function getTotalCredits($transcript_id, $transcript_9_12_id)
{
    $course = TranscriptCourse9_12::whereIn('transcript9_12_id', $transcript_9_12_id)->with('subject')->get();
    /** collected sum for annual year  */
    $collectSelectedGrade = collect($course->pluck('selectedCredit'));
    $sumOfSeletedEnrollmentGrade = $collectSelectedGrade->sum();

    /** collected sum for college course if exits */
    $college_course = CollegeCourse::whereIn('transcript9_12_id', $transcript_9_12_id)->get();
    if (count($college_course) > 0) {
        $collectSelectedGradeCollege = collect($college_course)->pluck('selectedCredit');
        $sumOfSeletedCollegeGrade = $collectSelectedGradeCollege->sum();
        $totalSelectedGrades = floatval($sumOfSeletedEnrollmentGrade) + floatval($sumOfSeletedCollegeGrade);
    } else {
        $sumOfSeletedCollegeGrade = 0;
    }

    /** collected sum for ap courses course if exits */

    $apCourses = AdvancePlacement::whereIn('transcript9_12_id', $transcript_9_12_id)->get();
    if (count($apCourses) > 0) {
        $collectSelectedGradeApCourse = collect($apCourses)->pluck('ap_course_credits');
        $sumOfSeletedApCourseGrade = $collectSelectedGradeApCourse->sum();
    } else {
        $sumOfSeletedApCourseGrade = 0;
    }
    /** getting total credit from sum of annual year course , college grade courses and ap courses*/
    $totalSelectedGrades = floatval($sumOfSeletedEnrollmentGrade) + floatval($sumOfSeletedCollegeGrade) + floatval($sumOfSeletedApCourseGrade);
    return $totalSelectedGrades;
}
//Get the transcript details according to the enrollment ids
function getTranscriptdeatils($enroll_student)
{
    $tanscript = Transcript::where('student_profile_id', $enroll_student)->whereIn('status', ['pending', 'paid', 'canEdit', 'completed', 'approved'])->get();
    if (count($tanscript) > 0) {
        return 'true';
    } else {
        return 'false';
    }
}

//get the transcript details if paid or not
function getTranscriptPaidDetails($transcriptPayment_id)
{
    $tanscript = TranscriptPayment::whereId($transcriptPayment_id)->whereIn('status', ['paid', 'canEdit', 'completed', 'approved'])->get();
    if (count($tanscript) > 0) {
        return 'true';
    } else {
        return 'false';
    }
}

//Get the student enrollment ids
function getEnrollmetForStudents($student_id)
{
    $enroll_student = StudentProfile::find($student_id);
    $allEnrollmentPeriods = $enroll_student->enrollmentPeriods()->get();
    $enrollment_ids = collect($allEnrollmentPeriods)->pluck('id');
    return $enrollment_ids;
}

//Get payment information according to the enrollment ids
function getPaymentInformation($enrollment_ids)
{
    $payment_info = DB::table('enrollment_periods')
        ->whereIn('enrollment_payment_id', $enrollment_ids)
        ->join('enrollment_payments', 'enrollment_payments.enrollment_period_id', 'enrollment_periods.id')
        ->where('enrollment_payments.status', 'paid')
        ->get();

    return $payment_info;
}

//get all the enrollments on student id start date and end date
function getendallenrollmentes($student_id)
{
    $enrollment_periods = StudentProfile::find($student_id)->enrollmentPeriods()->get();
    foreach ($enrollment_periods as $enrollment_period) {
        $strtdate = 'Start Date: ' . \Carbon\Carbon::parse($enrollment_period->start_date_of_enrollment)->format('M j, Y');
        $enddate = 'End Date: ' . \Carbon\Carbon::parse($enrollment_period->end_date_of_enrollment)->format('M j, Y');
    }
    return $strtdate . '    ' . $enddate;
}

//get pending orders for the admin user datatable
function getOrderAmount($item_type, $item_code)
{
    if ($item_type == "enrollment_period") {
        $payment_id = EnrollmentPeriods::whereId($item_code)->first();
        $amount = EnrollmentPayment::whereId($payment_id->enrollment_payment_id)->first();
        return $amount->amount;
    } elseif ($item_type == "graduation") {
        $amount = GraduationPayment::where('graduation_id', $item_code)->first();
        return $amount->amount;
    } elseif ($item_type == "transcript") {
        $amount = TranscriptPayment::where('transcript_id', $item_code)->first();
        return $amount->amount;
    } elseif ($item_type == "postage") {
        $amount = OrderPostage::where('parent_profile_id', $item_code)->first();
        return $amount->amount;
    } elseif ($item_type == "notarization") {
        $amount = NotarizationPayment::where('notarization_id', $item_code)->first();
        if ($amount)
            return $amount->amount;
        else
            return false;
    } elseif ($item_type == "apostille") {
        $amount = NotarizationPayment::where('apostille_id', $item_code)->first();
        return $amount->amount;
    } elseif ($item_type == "custom_letter") {
        $amount = CustomLetterPayment::where('parent_profile_id', $item_code)->first();
        return $amount->amount;
    } elseif ($item_type == "order_consultation") {
        $amount = OrderPersonalConsultation::where('parent_profile_id', $item_code)->first();
        return $amount->amount;
    } elseif ($item_type == "custom") {
        $amount = CustomPayment::where('parent_profile_id', $item_code)->first();
        if ($amount)
            return ($amount->amount);
        else
            return false;
    }
}

//get Orders for order detail page
function getOrders($transction_id)
{
    //  checking from enrollment payments
    $enrollment_payments = EnrollmentPayment::whereIn('transcation_id', [$transction_id])->get();
    $enrollment_amount = collect($enrollment_payments)->pluck('amount')->toArray();
    foreach ($enrollment_amount as &$enrollment_amounts) {
        $enrollment_amounts = '$' . $enrollment_amounts;
    }
    //  checking from custom  payments
    $custom_payment = CustomPayment::whereIn('transcation_id', [$transction_id])->get();
    $cp = collect($custom_payment)->pluck('amount')->toArray();
    foreach ($cp as &$cps) {
        $cps = '$' . $cps;
    }

    //  checking from custom letter payments
    $custom_letter = CustomLetterPayment::whereIn('transcation_id', [$transction_id])->get();
    $custom_letter_amt = collect($custom_letter)->pluck('amount')->toArray();
    foreach ($custom_letter_amt as &$custom_letter_amts) {
        $custom_letter_amts = '$' . $custom_letter_amts;
    }
    //  checking for graduation payments
    $graduation = GraduationPayment::whereIn('transcation_id', [$transction_id])->get();
    $graduation_amount = collect($graduation)->pluck('amount')->toArray();
    foreach ($graduation_amount as &$graduation_amounts) {
        $graduation_amounts = '$' . $graduation_amounts;
    }
    //checking for notarization payment
    $notarization = NotarizationPayment::whereIn('transcation_id', [$transction_id])->get();
    $notarization_payment = collect($notarization)->pluck('amount')->toArray();
    foreach ($notarization_payment as &$notarization_payments) {
        $notarization_payments = '$' . $notarization_payments;
    }
    //checking for transcript payment
    $transcript = TranscriptPayment::whereIn('transcation_id', [$transction_id])->get();
    $transcript_payment = collect($transcript)->pluck('amount')->toArray();
    foreach ($transcript_payment as &$transcript_payments) {
        $transcript_payments = '$' . $transcript_payments;
    }
    // checking for order personal consultation
    $order = OrderPersonalConsultation::whereIn('transcation_id', [$transction_id])->get();
    $order_payment = collect($order)->pluck('amount')->toArray();
    foreach ($order_payment as &$order_payments) {
        $order_payments = '$' . $order_payments;
    }

    $enrollment = count($enrollment_amount) > 0 ? 'Enrollment Payment :' . implode(", ", $enrollment_amount) : '';
    $cl = count($custom_letter) > 0 ? 'Custom Letter : ' . implode(", ", $custom_letter_amt) : '';
    $cp = count($custom_payment) > 0 ? 'Custom Payment : ' . implode(", ", $cp) : '';
    $graduate = count($graduation_amount) > 0 ? 'Graduation Payment : ' . implode(',', $graduation_amount) : '';
    $notarize = count($notarization_payment) > 0 ? 'Notarization Payment :' . implode(',', $notarization_payment) : '';
    $transcript = count($transcript_payment) > 0 ? 'Transcript Payment :' . implode(',', $transcript_payment) : '';
    $orderconsultation = count($order_payment) > 0 ? 'Personal Consultation:' . implode(',', $order_payment) : '';

    return $enrollment . ' ' . $cl . ' ' . $cp . ' ' . $graduate . ' ' . $notarize . ' ' . $transcript . ' ' . $orderconsultation;
}


//get the status for dashboard to check is status is paid or pending

function getstatus($enrollment_period_id)
{
    $confirm_status = ConfirmationLetter::where('enrollment_period_id', $enrollment_period_id)->first();
    if ($confirm_status) {
        if ($confirm_status->status === 'completed' || $confirm_status->status === 'paid') {
            return 'Completed';
        } else {
            return 'Not Paid for Enrollment';
        }
    }
}

//Get Enrollment Payments status for blade file
function getPaymentstatus($enrollment_payment_id)
{
    $enrollment_payments = EnrollmentPayment::whereId($enrollment_payment_id)->first();
    return $enrollment_payments->status;
}

//Get the student data
function getStudentData($student_id)
{
    $student_name = StudentProfile::whereId($student_id)->first();
    return $student_name->fullname;
}


//To check if cart is empty or not
function getcartval()
{
    $parent_profile_id = ParentProfile::getParentId();
    $count = Cart::where('parent_profile_id', $parent_profile_id)->count();
    return $count;
}
//convert date formate
// function getDateVal($value)
// {

//     $date = $value->format('F j, Y');

//     return $date;
// }
function formatDate($date)
{
    return \Carbon\Carbon::parse($date)->format('M j , Y');
}
function getRepresentativeAmount($repGroupAmountDetails, $family_count,  $repAmount)
{
    $valueAmount = 0;
    foreach ($repGroupAmountDetails as $repGroupAmountDetail) {
        $valueAmount = $valueAmount + $repGroupAmountDetail->amount;
    }
    return ($family_count * $repAmount) + $valueAmount;
}
