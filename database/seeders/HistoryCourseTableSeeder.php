<?php

namespace Database\Seeders;

use Carbon\Carbon;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistoryCourseTableSeeder extends Seeder
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
                ['SOCIAL STUDIES','K-8'],
                ['HISTORY','K-8'],
                ['GEOGRAPHY','K-8'],
                ['SOCIAL SCIENCE','K-8'],
                ['US HISTORY & GEOGRAPHY','9-12'],
                ['US HISTORY','9-12'],
                ['AMERICAN GOVERNMENT','9-12'],
                ['WORLD HISTORY, CULTURE & GEOGRAPHY','9-12'],
                ['WORLD GEOGRAPHY','9-12'],
                ['ECONOMICS','9-12'],
                ['ANCINT HISTORY','9-12'],
                ['MEDIEVAL HISTORY','9-12'],
                ['RENAISSANCE HISTORY','9-12'],
                ['WESTERN CIVILIZATION','9-12'],
                ['CONTEMPORARY ISSUES','9-12'],
                ['POLITICAL SCIENCE','9-12'],
                ['WORLD CULTURE','9-12'],
                ['CIVICS','9-12'],
                ['ANTHROPOLOGY','9-12'],
                ['EUROPEAN HISTORY','9-12'],
                ['JAPANESE CULTURE','9-12'],
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
    
            DB::table('history_social_science_courses')->insert($array2);
        }
    }
}
