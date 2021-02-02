<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;
class DatabaseSeeder extends Seeder
{
    protected $toTruncate = ['countries','fees_info','bank_transfer_details','money_gram_details','transfer_wise_deatils'];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        foreach($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }
        // \App\Models\User::factory(10)->create();
        $this->call(CountriesTableSeeder::class);
        $this->call(FeesInfoSeeder::class);
        $this->call(BankTransferTableSeeder::class);
        $this->call(MoneyGramTableSeeder::class);
        $this->call(TransferwiseTableSeeder::class);
        Model::reguard();

    }
}
