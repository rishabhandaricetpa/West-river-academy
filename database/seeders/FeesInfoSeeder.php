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
            ['type' => 'first_student_half', 'description' => 'Fee for first student (Sem 2)', 'amount' => '200'],
            ['type' => 'additional_student_annual', 'description' => 'Fee for additional student (Annual)', 'amount' => '50'],
            ['type' => 'additional_student_half', 'description' => 'Fee for additional student (Sem 2)', 'amount' => '50'],
            ['type' => 'graduation', 'description' => 'Fee for Graduation', 'amount' => '395'],
            ['type' => 'apostille', 'description' => 'Fee for Apostille Package', 'amount' => '165'],
            ['type' => 'transcript', 'description' => 'K - 8 transcript process', 'amount' => '80'],
            ['type' => 'transcript_edit', 'description' => 'K - 8 edit transcript process', 'amount' => '25'],
            ['type' => 'express_international', 'description' => 'Express International Tier 1', 'amount' => '85'],
            ['type' => 'global_guaranteed_international', 'description' => 'Express International Tier 2', 'amount' => '145'],
            ['type' => 'united_postal_service', 'description' => 'Express International Tier 3', 'amount' => '85'],
            ['type' => 'priority_international', 'description' => 'Priority International', 'amount' => '55'],
            ['type' => 'priority_usa', 'description' => 'Priority USA', 'amount' => '20'],
            ['type' => 'express_usa', 'description' => 'Express USA', 'amount' => '30'],
            ['type' => 'usa_domestic_prioirity_mail', 'description' => 'USA Domestic Priority Mail', 'amount' => '0'],
            ['type' => 'notarization_doc_fee', 'description' => 'Notarization Fee', 'amount' => '20'],
            ['type' => 'apostille_doc_fee', 'description' => 'Apostille Fee', 'amount' => '75'],
            ['type' => 'custom_letter', 'description' => 'Custom Letter Fee', 'amount' => '35'],
            ['type' => 'additional_transcript', 'description' => 'Subsequent Transcript Fee', 'amount' => '25'],
            ['type' => 'consultation_fee', 'description' => 'Personal Consultation', 'amount' => '80'],

        ];
        FeesInfo::insert($data);
    }
}
