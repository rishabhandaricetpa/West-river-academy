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
                'is_carnegia' => 1
            ],
            [
                'credit' => '1.0',
                'country' => 'Others',
                'is_carnegia' => 1
            ],
            [
                'credit' => '2.5',
                'country' => 'Others',
                'is_carnegia' => 1

            ],
            [
                'credit' => '10',
                'country' => 'California',
                'is_carnegia' => 0
            ],
            [
                'credit' => '20',
                'country' => 'California',
                'is_carnegia' => 0
            ],
            [
                'credit' => '30',
                'country' => 'California',
                'is_carnegia' => 0
            ],
        ]);
    }
}
