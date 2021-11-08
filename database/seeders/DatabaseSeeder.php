<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Schema;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = [
        'countries', 'fees_info', 'bank_transfer_details', 'money_gram_details', 'transfer_wise_deatils',
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Schema::disableForeignKeyConstraints();
        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }
        Schema::enableForeignKeyConstraints();
        // \App\Models\User::factory(10)->create();
        $this->call(CountriesTableSeeder::class);
        $this->call(FeesInfoSeeder::class);
        $this->call(BankTransferTableSeeder::class);
        $this->call(MoneyGramTableSeeder::class);
        $this->call(TransferwiseTableSeeder::class);
        $this->call(CourseTableSeeder::class);
        $this->call(SubjectTableSeeder::class);
        $this->call(AdminLoginSeeder::class);
        $this->call(CreditTableSeeder::class);
        Model::reguard();
    }
}
