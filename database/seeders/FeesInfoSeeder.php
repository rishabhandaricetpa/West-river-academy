<?php

namespace Database\Seeders;

use App\Models\FeesInfo;
use Illuminate\Database\Seeder;

class FeesInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['type' => 'first_student_annual', 'description' => 'Fee for first student (Annual)', 'amount' => '375'],
            ['type' => 'first_student_half', 'description' => 'Fee for first student (semi)', 'amount' => '200'],
            ['type' => 'additional_student_annual', 'description' => 'Fee for additional student (Annual)', 'amount' => '50'],
            ['type' => 'additional_student_half', 'description' => 'Fee for additional student (semi)', 'amount' => '50'],
            ['type' => 'graduation', 'description' => 'Fee for Graduation', 'amount' => '395'],
            ['type' => 'transcript', 'description' => 'K - 8 transcript process', 'amount' => '80'],
        ];
        FeesInfo::insert($data);
    }
}
