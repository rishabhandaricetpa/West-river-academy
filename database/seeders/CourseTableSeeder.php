<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->delete(); {
            $array = [
                ['1', 'English / Language Arts', 'K-8'],
                ['2', 'History / Social Science', 'K-8'],
                ['3', 'Mathematics', 'K-8'],
                ['4', 'Science', 'K-8'],
                ['5', 'Health', 'K-8'],
                ['6', 'Foreign Language', 'K-8'],
                ['7', 'Physical Education', 'K-8'],
                ['8', 'Another', 'K-8'],
            ];
            foreach ($array as $key => $value) :
                $array2[] = [
                    'id' => $value[0],
                    'course_name'  => $value[1],
                    'other_courses' => '',
                    'transcript_period' => $value[2],
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ];
            endforeach;

            DB::table('courses')->insert($array2);
        }
    }
}
