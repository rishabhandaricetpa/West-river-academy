<?php

namespace Database\Seeders;

use Carbon\Carbon;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhysicalCourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            $array =[
                ['PHYSICAL EDUCATION','K-8'],
                ['PE','9-12'],
                ['PE: LIFE SPORTS','9-12'],
                ['PE: SNOWBOARDING','9-12'],
                ['PE: HIKING','9-12'],
                ['PE: CROSSFIT TRAINING','9-12'],
                ['PE: WEIGHT LIFTING','9-12'],
                ['PE: PHYSICAL TRAINING','9-12'],
            ];
            foreach ($array as $key => $value):
                $array2[] = [
                    'course_name'  => $value[0],
                    'other_courses'=>'',
                    'transcript_period'=>$value[1],
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ];
            endforeach;
    
            DB::table('physical_education_courses')->insert($array2);
        }
    }
}
