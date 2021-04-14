<?php

use App\Models\FeesInfo;
use App\Models\Country;

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


//get G.P.A for the student
function getGPAvalue($courses, $total_credits_earned)
{
}
