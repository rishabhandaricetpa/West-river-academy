<?php

namespace App\Console\Commands;

use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\OrderPersonalConsultation;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\EnrollmentPayment;
use App\Models\EnrollmentPeriods;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class ImportConsultation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:consultation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Personal Cosnultation data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->line('starting import');
        $filePath = base_path('csv/personalconsultation.csv');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);
        $reader->open($filePath);

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as
                $rowIndex => $cells) {
                $cells = $cells->getCells();
                if ($rowIndex === 1) {
                    continue;
                }
                $parent_email = Str::of($cells[11]);
                $family_name  = Str::of($cells[12]);
                $user_email = ParentProfile::where('p1_email', $parent_email)->first();
                $legacy_name = ParentProfile::where('legacy', $family_name)->first();
                if ($legacy_name) {
                    $notarization_data =  OrderPersonalConsultation::create([
                        'parent_profile_id' => $legacy_name ? $legacy_name->id : 0,
                        'preferred_language' => '',
                        'en_call_type' => '',
                        'sp_call_type' => '',
                        'amount' => $cells[24],
                        'consulting_about' =>  $cells[5],
                        'paying_for' => $cells[32],
                        'type_of_payment' => $cells[7],
                        'transcation_id' => '',
                        'payment_mode' => '',
                        'status' => $cells[22],
                        'order_id' => $cells[13]
                    ]);
                }
            }
        }
        $reader->close();
        $this->line('import successfully');
    }
}
