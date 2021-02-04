<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MoneyGramTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('money_gram_details')->insert([
            'name' => 'Margaret Webb',
            'address' => '33721 Bluewater Lane',
            'city' => 'Dana Point',
            'state'=>'CA',
            'zip'=>'92629',
            'money_gram_id'=>'IDD9791604 (California Driver’s License)',
            'status'=>'1',
        ]);
    }
}
