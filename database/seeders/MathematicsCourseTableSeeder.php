<?php

namespace Database\Seeders;

use Carbon\Carbon;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MathematicsCourseTableSeeder extends Seeder
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
                ['MATHEMATICS','K-8'],
                ['PRE-ALGEBRA','K-8'],
                ['ALGEBRA I','9-12'],
                ['ALGEBRA 2/TRIGONOMETRY','9-12'],
                ['ADVANCED ALGEBRA','9-12'],
                ['TRIGONOMETRY','9-12'],
                ['PRE - CALCULUS','9-12'],
                ['GENERAL MATH','9-12'],
                ['PROBABILITY &STATISTICS','9-12'],
                ['PERSONAL FINANCE','9-12'],
                ['COMPOUTER SCIENCE','9-12'],
                ['COMPOUTER SKILLS','9-12'],
                ['COMPOUTER PROGRAMMMING','9-12'],
                ['APPLIED MATH','9-12'],
                ['BUSINESS MATH','9-12'],
                ['PRACTICAL MATH','9-12'],
                ['CONSUMER MATH','9-12'],
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
    
            DB::table('mathematics_courses')->insert($array2);
        }
    }
}
