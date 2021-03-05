<?php

use App\Models\FeesInfo;

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
        $subjects  = $course->toArray();

        if ($transcriptData) :

            $transcriptDetails  = $data->transcriptDetails;

            foreach ($transcriptDetails as $key => $value) {

                if ($value['k8transcript_id'] === $data['id'] && $value['subject_id'] === $course['subject_id'])
                    return $value['score'];
            }
        endif;
    } catch (\Throwable $th) {
        return false;
    }
}
function getFeeDetails($type)
{
    $fees = FeesInfo::whereType($type)->first();
    return ($fees->amount);
}
