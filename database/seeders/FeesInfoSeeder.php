<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FeesInfo;

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
            ['type' => 'first_student_annual', 'description' => 'Fee for first student (Annual)', 'amount' => '350'],
            ['type' => 'first_student_half', 'description' => 'Fee for first student (semi)', 'amount' => '200'],
            ['type' => 'additional_student_annual', 'description' => 'Fee for additional student (Annual)', 'amount' => '50'],
            ['type' => 'additional_student_half', 'description' => 'Fee for additional student (semi)', 'amount' => '50'],
        ];
        FeesInfo::insert($data);
    }
}
