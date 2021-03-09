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
            ['type' => 'apostille', 'description' => 'Fee for Apostille Package', 'amount' => '165'],
            ['type' => 'transcript', 'description' => 'K - 8 transcript process', 'amount' => '80'],
            ['type' => 'transcript_edit', 'description' => 'K - 8 edit transcript process', 'amount' => '25'],
            ['type' => 'express_international', 'description' => 'Express International', 'amount' => '55'],
            ['type' => 'global_guaranteed_international', 'description' => 'Glaboal Guanteed International', 'amount' => '85'],
            ['type' => 'priority_international', 'description' => 'Priority International', 'amount' => '145'],
            ['type' => 'priority_usa', 'description' => 'Priority USA', 'amount' => '10'],
            ['type' => 'express_usa', 'description' => 'Express USA', 'amount' => '30'],
            ['type' => 'notarization_doc_fee', 'description' => 'Fees for Notarization Documents', 'amount' => '20'],
            ['type' => 'apostille_doc_fee', 'description' => 'Fees for Apostille Documents', 'amount' => '75'],
            ['type' => 'custom_letter', 'description' => 'Fees for Custom Letter', 'amount' => '20'],
        ];
        FeesInfo::insert($data);
    }
}
