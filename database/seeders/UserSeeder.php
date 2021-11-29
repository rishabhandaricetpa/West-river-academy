<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'risha',
            'email' => 'rebecca.risha@rubicotech.in',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'name' => 'risha'
        ]);
        DB::table('parent_profiles')->insert([
            'user_id' => 1,
            'p1_first_name' => 'risha',
            'p1_last_name' => 'bhandari',
            'p1_email' => 'rebecca.risha@rubicotech.in',
            'p1_cell_phone' => 21311321,
            'p1_home_phone' => 12131,
            'p2_first_name' => 'jeteendra',
            'legacy' => 'legacy name',
            'p2_email' => 'rebecca.risha@rubicotech.in',
            'p2_cell_phone' => 212,
            'p2_home_phone' => 2131212,
            'street_address' => 'werwe',
            'city' => 'ddn',
            'state' => 'hgcg',
            'zip_code' => 23123,
            'country' => 'India',
            'p2_street_address' => 'dweewf',
            'p2_city' => 'bijnor',
            'p2_country' => 'India',
            'p2_state' => 'dsfsd',
            'status' => 0,
            'welcome_video_status' => 0
        ]);
    }
}
