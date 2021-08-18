<?php

namespace App\Console\Commands;

use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\Notarization;
use App\Models\NotarizationPayment;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\EnrollmentPayment;
use App\Models\EnrollmentPeriods;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class ImportNotarization extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:notarization';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Notarization';

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
        $filePath = base_path('csv/Notarization.csv');
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
                    $notarization_data =  Notarization::create([
                        'parent_profile_id' => $legacy_name ? $legacy_name->id : 0,
                        'postage_option' => $cells[32],
                        'first_name' => $cells[3],
                        'last_name' => $cells[4],
                        'street' => $cells[6],
                        'city' =>  $cells[5],
                        'country' => $cells[16],
                        'zip_code' => $cells[7],
                        'transcript_doc' => '',
                        'custom_doc' => '',
                        'status' => $cells[22],
                        'confirmation_doc' =>  '',
                    ]);
                    NotarizationPayment::create([
                        'notarization_id' => $notarization_data ? $notarization_data->id : 0,
                        'parent_profile_id' => $legacy_name ? $legacy_name->id : 0,
                        'pay_for' => 'notarization',
                        'amount' => $cells[24],
                        'status' =>  'pending',
                        'order_id' => $cells[13]
                    ]);
                }
            }
        }

        $reader->close();
        $this->line('import successfully');
    }
}
