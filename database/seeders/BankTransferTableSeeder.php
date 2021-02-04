<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BankTransferTableSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bank_transfer_details')->insert([
            'bank_name' => 'US Bank NA',
            'swift_code' => 'USBKUS44IMT',
            'bank_address' => '33621 Del Obispo St, Ste A',
            'street'=>'Dana Point, CA 92629',
            'phone_number'=>'(800) 872-2657',
            'routing_number'=>'102000021',
            'account_name'=>'West River Educational Services, Inc.',
            'account_number'=>'153463063153',
            'status'=>'1',
        ]);
    }
}
