<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        DB::table('admins')->insert([

            [
                'name' => 'Rebecca',
                'email' => 'rebecca.risha@ithands.com',
                'password' => bcrypt('password'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Paige',
                'email' => 'paige.priyanka@ithands.com',
                'password' => bcrypt('password'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Ray',
                'email' => 'ray.rajnish@ithands.com',
                'password' => bcrypt('password'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            //west River admins
            [
                'name' => 'Danielle',
                'email' => 'Danielle@westriveracademy.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Karen',
                'email' => 'Karen@westriveracademy.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Paula',
                'email' => 'Paula@westriveracademy.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Peggy',
                'email' => 'Peggy@westriveracademy.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Rachel',
                'email' => 'Rachel@westriveracademy.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Stacey',
                'email' => 'Stacey@westriveracademy.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Administrator',
                'email' => 'contact@westriveracademy.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Raelyn',
                'email' => 'raelyn@westriveracademy.com',
                'password' => bcrypt('12345678'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],


        ]);
    }
}
