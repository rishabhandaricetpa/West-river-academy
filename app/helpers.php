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
use App\Models\ParentProfile;
use App\Models\Transcript;
use App\Models\TranscriptPayment;
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
function getFeeDetails($type)
{
    try {
        $fees = FeesInfo::whereType($type)->first();
        return ($fees->amount);
    } catch (\Throwable $th) {
        return false;
    }
}
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

//get G.P.A for the student
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
    );
    $course = $courses->map(function ($course) use ($academy_points, $is_caragie, $college_points) {
        if ($course->type === 'year') {
            if ($course->credit === 1.0) {
                $course->order = $academy_points[$course->score];
            } elseif ($course->credit === 0.5) {
                $course->order = $academy_points[$course->score] / 2;
            } elseif ($course->credit === 0.25) {
                $course->order = $academy_points[$course->score] / 3;
            }
            if ($course->credit === 10.0) {
                $course->order = $academy_points[$course->score];
            } elseif ($course->credit === 5.0) {
                $course->order = $academy_points[$course->score] / 2;
            } elseif ($course->credit === 2.5) {
                $course->order = $academy_points[$course->score] / 3;
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
function getTranscriptdeatils($enroll_student)
{
    $tanscript = Transcript::where('student_profile_id', $enroll_student)->whereIn('status', ['pending','paid', 'canEdit', 'completed', 'approved'])->get();
    if (count($tanscript) > 0) {
        return 'true';
    } else {
        return 'false';
    }
}
function getTranscriptPaidDetails($transcriptPayment_id){
    $tanscript = TranscriptPayment::whereId($transcriptPayment_id)->whereIn('status', ['paid', 'canEdit', 'completed', 'approved'])->get();
    if (count($tanscript) > 0) {
        return 'true';
    } else {
        return 'false';
    }

   
}
