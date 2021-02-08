<?php

namespace Database\Seeders;

use Carbon\Carbon;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScienceCourseTableSeeder extends Seeder
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
                ['SCIENCE','K-8'],
                ['SCIENCE AND TECHNOLOGY','K-8'],
                ['BIOLOGY','9-12'],
                ['CHEMISTRY','9-12'],
                ['PHYSICS','9-12'],
                ['EARTH SCIENCE','9-12'],
                ['PHYSICAL SCIENCE','9-12'],
                ['LIFE SCIENCE','9-12'],
                ['GEOLOGY','9-12'],
                ['ENVIRONMENTAL SCIENCE','9-12'],
                ['ASTRONOMY','9-12'],
                ['BOTANY SCIENCE','9-12'],
                ['HORTICULTURE','9-12'],
                ['MARINE BIOLOGY','9-12'],

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
    
            DB::table('science_courses')->insert($array2);
        }
    }
}
