<?php

namespace Database\Seeders;

use App\Models\CountrySemester;
use Illuminate\Database\Seeder;

class CountrySemesterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country_semester = [
            ['country_id' => 97, 'semester_id' => 5],
            ['country_id' => 97, 'semester_id' => 6],
            ['country_id' => 2, 'semester_id' => 3],
            ['country_id' => 2, 'semester_id' => 4],
        ];
        CountrySemester::insert($country_semester);
    }
}
