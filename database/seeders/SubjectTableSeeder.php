<?php

namespace Database\Seeders;

use Carbon\Carbon;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectTableSeeder extends Seeder
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
                //english

                ['1','ENGLISH','K-8'],
                ['1','LANGUAGE ART','K-8'],
                ['1','READING','K-8'],
                ['1','WRITING','K-8'],
                ['1','ORAL COMMUNICATION','K-8'],
                ['1','MEDIA LITERACY','K-8'],
                ['1','ENGLISH I','9-12'],
                ['1','ENGLISH II','9-12'],
                ['1','ENGLISH III','9-12'],
                ['1','ENGLISH IV','9-12'],
                ['1','LANGUAGE ARTS I','9-12'],
                ['1','LANGUAGE ARTS II','9-12'],
                ['1','LANGUAGE ARTS III','9-12'],
                ['1','LANGUAGE ARTS IV','9-12'],
                ['1','GRAMMAR & COMPOSITION','9-12'],
                ['1','ENGLISH LITERATURE','9-12'],
                ['1','AMERICAN LITERATURE','9-12'],
                ['1','LITERATURE & LANGUAGE','9-12'],
                ['1','WORLD LITERATURE','9-12'],
                ['1','JOURNALISM','9-12'],
                ['1','THE NOVEL','9-12'],
                ['1','SHORT STORY WRITING','9-12'],
                ['1','CONTEMPORARY ENGLISH LITERARURE','9-12'],
                ['1','CREATIVE WRITING','9-12'],
                ['1','CRITICAL THINKING SKILLS','9-12'],
                ['1','INTRO. TO LOGIC','9-12'],
                ['1','FILM AS LITERATURE','9-12'],
                
                //foriegn language
                ['6','SPANISH','K-8'],                                    //FROM K-8
                ['6','FRENCH','K-8'],
                ['6','AMERICAN SIGN LANGUAGE','K-8'],                      //TO K-8
                ['6','SPANISH I','9-12'],
                ['6','SPANISH II','9-12'],
                ['6','SPANISH III','9-12'],
                ['6','SPANISH IV','9-12'],
                ['6','AMERICAN SIGN LANGUAGE','9-12'],
                
                //health
                ['5','HEALTH EDUCATION','K-8'],
                ['5','HEALTH','9-12'],
                ['5','HEALTH & NUTRITION','9-12'],
                
                //history
                ['2','SOCIAL STUDIES','K-8'],
                ['2','HISTORY','K-8'],
                ['2','GEOGRAPHY','K-8'],
                ['2','SOCIAL SCIENCE','K-8'],
                ['2','US HISTORY & GEOGRAPHY','9-12'],
                ['2','US HISTORY','9-12'],
                ['2','AMERICAN GOVERNMENT','9-12'],
                ['2','WORLD HISTORY, CULTURE & GEOGRAPHY','9-12'],
                ['2','WORLD GEOGRAPHY','9-12'],
                ['2','ECONOMICS','9-12'],
                ['2','ANCINT HISTORY','9-12'],
                ['2','MEDIEVAL HISTORY','9-12'],
                ['2','RENAISSANCE HISTORY','9-12'],
                ['2','WESTERN CIVILIZATION','9-12'],
                ['2','CONTEMPORARY ISSUES','9-12'],
                ['2','POLITICAL SCIENCE','9-12'],
                ['2','WORLD CULTURE','9-12'],
                ['2','CIVICS','9-12'],
                ['2','ANTHROPOLOGY','9-12'],
                ['2','EUROPEAN HISTORY','9-12'],
                ['2','JAPANESE CULTURE','9-12'],
                
                //maths
                ['3','MATHEMATICS','K-8'],
                ['3','PRE-ALGEBRA','K-8'],
                ['3','ALGEBRA I','9-12'],
                ['3','ALGEBRA 2/TRIGONOMETRY','9-12'],
                ['3','ADVANCED ALGEBRA','9-12'],
                ['3','TRIGONOMETRY','9-12'],
                ['3','PRE - CALCULUS','9-12'],
                ['3','GENERAL MATH','9-12'],
                ['3','PROBABILITY &STATISTICS','9-12'],
                ['3','PERSONAL FINANCE','9-12'],
                ['3','COMPOUTER SCIENCE','9-12'],
                ['3','COMPOUTER SKILLS','9-12'],
                ['3','COMPOUTER PROGRAMMMING','9-12'],
                ['3','APPLIED MATH','9-12'],
                ['3','BUSINESS MATH','9-12'],
                ['3','PRACTICAL MATH','9-12'],
                ['3','CONSUMER MATH','9-12'],

               
                //physical
                ['7','PHYSICAL EDUCATION','K-8'],
                ['7','PE','9-12'],
                ['7','PE: LIFE SPORTS','9-12'],
                ['7','PE: SNOWBOARDING','9-12'],
                ['7','PE: HIKING','9-12'],
                ['7','PE: CROSSFIT TRAINING','9-12'],
                ['7','PE: WEIGHT LIFTING','9-12'],
                ['7','PE: PHYSICAL TRAINING','9-12'],
                
                //science
                ['4','SCIENCE','K-8'],
                ['4','SCIENCE AND TECHNOLOGY','K-8'],
                ['4','BIOLOGY','9-12'],
                ['4','CHEMISTRY','9-12'],
                ['4','PHYSICS','9-12'],
                ['4','EARTH SCIENCE','9-12'],
                ['4','PHYSICAL SCIENCE','9-12'],
                ['4','LIFE SCIENCE','9-12'],
                ['4','GEOLOGY','9-12'],
                ['4','ENVIRONMENTAL SCIENCE','9-12'],
                ['4','ASTRONOMY','9-12'],
                ['4','BOTANY SCIENCE','9-12'],
                ['4','HORTICULTURE','9-12'],
                ['4','MARINE BIOLOGY','9-12'],
                
                //anoher
                ['8','ART','K-8'],
                ['8','DANCE','K-8'],
                ['8','DRAMA','K-8'],
                ['8','MUSIC','K-8'],
                ['8','VIRTUAL ARTS','K-8'],
                ['8','MUSIC','9-12'],
                ['8','ART','9-12'],
                ['8','DANCE','9-12'],
                ['8','DRAMA','9-12'],
                

            ];
            foreach ($array as $key => $value):
                $array2[] = [
                    'courses_id'=> $value[0],
                    'subject_name'  => $value[1],
                    'other_subject'=>'',
                    'transcript_period'=>$value[2],
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ];
            endforeach;
    
            DB::table('subjects')->insert($array2);
        }
    }
}
