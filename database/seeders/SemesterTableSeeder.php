<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $semester_dates = [
            ['start_date' => 'August 1', 'end_date' => 'July 31'],
            ['start_date' => 'January 1', 'end_date' => 'July 31'],
            ['start_date' => 'January 1', 'end_date' => 'December 31'],
            ['start_date' => 'June 1', 'end_date' => 'December 31'],
            ['start_date' => 'April 1', 'end_date' => 'March 31'],
            ['start_date' => 'September 1', 'end_date' => 'March 31'],
        ];
        Semester::insert($semester_dates);
    }
}
