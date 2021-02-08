<?php
namespace Database\Seeders;

use Carbon\Carbon;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AnotherCourseTableSeeder extends Seeder
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
                ['ENGLISH','K-8'],
                ['LANGUAGE ART','K-8'],
                ['READING','K-8'],
                ['WRITING','K-8'],
                ['ORAL COMMUNICATION','K-8'],
                ['MEDIA LITERACY','K-8'],
                ['MUSIC','9-12'],
                ['ART','9-12'],
                ['DANCE','9-12'],
                ['DRAMA','9-12'],

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
    
            DB::table('another_courses')->insert($array2);
        }
    }
}
