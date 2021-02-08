<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = ['countries', 'fees_info', 'bank_transfer_details', 'money_gram_details', 'transfer_wise_deatils'
                            ,'english_courses','another_courses','foreign_language_courses','health_courses',
                            'history_social_science_courses','mathematics_courses','physical_education_courses','science_courses'];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        foreach ($this->toTruncate as $table) {
            DB::table($table)->truncate();
        }
        // \App\Models\User::factory(10)->create();
        $this->call(CountriesTableSeeder::class);
        $this->call(FeesInfoSeeder::class);
        $this->call(BankTransferTableSeeder::class);
        $this->call(MoneyGramTableSeeder::class);
        $this->call(TransferwiseTableSeeder::class);
        $this->call(EnglishCourseTableSeeder::class);
        $this->call(ForiegnLanguageCourseTableSeeder::class);
        $this->call(AnotherCourseTableSeeder::class);
        $this->call(HealthCourseTableSeeder::class);
        $this->call(HistoryCourseTableSeeder::class);
        $this->call(MathematicsCourseTableSeeder::class);
        $this->call(PhysicalCourseTableSeeder::class);
        $this->call(ScienceCourseTableSeeder::class);
        Model::reguard();
    }
}
