<?php

namespace Database\Seeders;
use Carbon\Carbon;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class HealthCourseTableSeeder extends Seeder
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
                ['HEALTH EDUCATION','K-8'],
                ['HEALTH','9-12'],
                ['HEALTH & NUTRITION','9-12'],
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
    
            DB::table('health_courses')->insert($array2);
        }
    }
}
