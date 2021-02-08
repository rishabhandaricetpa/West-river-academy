<?php

namespace Database\Seeders;
use Carbon\Carbon;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ForiegnLanguageCourseTableSeeder extends Seeder
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
                ['SPANISH','K-8'],                                    //FROM K-8
                ['FRENCH','K-8'],
                ['AMERICAN SIGN LANGUAGE','K-8'],                      //TO K-8
                ['SPANISH I','9-12'],
                ['SPANISH II','9-12'],
                ['SPANISH III','9-12'],
                ['SPANISH IV','9-12'],
                ['AMERICAN SIGN LANGUAGE','9-12'],
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
    
            DB::table('foreign_language_courses')->insert($array2);
        }
    }
}
