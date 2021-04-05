<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreditTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('credits')->delete();
        DB::table('credits')->insert([

            [
                'credit' => '0.5',
                'country' => 'Others',
                'is_carnegia' => 1,
                'total_credit' => 7.25
            ],
            [
                'credit' => '1.0',
                'country' => 'Others',
                'is_carnegia' => 1,
                'total_credit' => 7.25
            ],
            [
                'credit' => '0.25',
                'country' => 'Others',
                'is_carnegia' => 1,
                'total_credit' => 7.25

            ],
            [
                'credit' => '2.50',
                'country' => 'California',
                'is_carnegia' => 0,
                'total_credit' => 72.5
            ],
            [
                'credit' => '5.00',
                'country' => 'California',
                'is_carnegia' => 0,
                'total_credit' => 72.5
            ],
            [
                'credit' => '10.00',
                'country' => 'California',
                'is_carnegia' => 0,
                'total_credit' => 72.5
            ],
        ]);
    }
}
