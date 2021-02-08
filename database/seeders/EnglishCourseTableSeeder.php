<?php

namespace Database\Seeders;
use Carbon\Carbon;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EnglishCourseTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $array =[
            ['ENGLISH','K-8'],
            ['LANGUAGE ART','K-8'],
            ['READING','K-8'],
            ['WRITING','K-8'],
            ['ORAL COMMUNICATION','K-8'],
            ['MEDIA LITERACY','K-8'],
            ['ENGLISH I','9-12'],
            ['ENGLISH II','9-12'],
            ['ENGLISH III','9-12'],
            ['ENGLISH IV','9-12'],
            ['LANGUAGE ARTS I','9-12'],
            ['LANGUAGE ARTS II','9-12'],
            ['LANGUAGE ARTS III','9-12'],
            ['LANGUAGE ARTS IV','9-12'],
            ['GRAMMAR & COMPOSITION','9-12'],
            ['ENGLISH LITERATURE','9-12'],
            ['AMERICAN LITERATURE','9-12'],
            ['LITERATURE & LANGUAGE','9-12'],
            ['WORLD LITERATURE','9-12'],
            ['JOURNALISM','9-12'],
            ['THE NOVEL','9-12'],
            ['SHORT STORY WRITING','9-12'],
            ['CONTEMPORARY ENGLISH LITERARURE','9-12'],
            ['CREATIVE WRITING','9-12'],
            ['CRITICAL THINKING SKILLS','9-12'],
            ['INTRO. TO LOGIC','9-12'],
            ['FILM AS LITERATURE','9-12'],
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

        DB::table('english_courses')->insert($array2);
    }
}
