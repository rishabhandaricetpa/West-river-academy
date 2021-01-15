<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SemesterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $year =date("Y");
        $semester_dates = [
            ['start_date' => Carbon::create( $year, '08', '01')->format('Y-m-d'), 'end_date' => Carbon::create( $year, '07', '31')->format('Y-m-d')],
            ['start_date' => Carbon::create( $year, '01', '01')->format('Y-m-d'), 'end_datfe' => Carbon::create( $year, '07', '31')->format('Y-m-d')],
            ['start_date' => Carbon::create( $year, '01', '01')->format('Y-m-d'), 'end_date' => Carbon::create( $year, '12', '31')->format('Y-m-d')],
            ['start_date' => Carbon::create( $year, '06', '01')->format('Y-m-d'), 'end_date' => Carbon::create( $year, '12', '31')->format('Y-m-d')],
            ['start_date' => Carbon::create( $year, '04', '01')->format('Y-m-d'), 'end_date' => Carbon::create( $year, '03', '31')->format('Y-m-d')],
            ['start_date' => Carbon::create( $year, '09', '01')->format('Y-m-d'), 'end_date' => Carbon::create( $year, '03', '31')->format('Y-m-d')],
        ];
        Semester::insert($semester_dates);
    }
}
