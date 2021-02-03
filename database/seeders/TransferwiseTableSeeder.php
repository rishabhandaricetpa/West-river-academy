<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TransferwiseTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transfer_wise_deatils')->insert([
            'account_holder' => 'West River Educational Services',
            'account_number' => '822000140123',
            'wire_transfer_number' => '026073008',
            'swift_code'=>'CMFGUS33',
            'routing_number'=>'026073150',
            'address'=>'TransferWise 19 W.',
            'state'=>'24th Street New York, NY 1001',
            'country'=>'United States',
            'website'=>'http://transferwise.com',
            'status'=>'1'
        ]);
    }
}