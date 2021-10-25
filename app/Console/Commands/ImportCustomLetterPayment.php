<?php

namespace App\Console\Commands;

use App\Models\CustomLetterPayment;
use Illuminate\Console\Command;
use App\Models\ParentProfile;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class ImportCustomLetterPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:customletter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Custom letter table';

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
        $filePath = base_path('csv/custom_letter.csv');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);
        $reader->open($filePath);

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as
                $rowIndex => $cells) {
                $cells = $cells->getCells();
                if ($rowIndex === 1) {
                    continue;
                }
                $parent_email = $cells[11];
                $legacy_name = $cells[12];
                // todo add order_id column in custom payment
                $parent = ParentProfile::where('p1_email', $parent_email)->where('legacy', $legacy_name)->first();
                if ($parent) {
                    CustomLetterPayment::create([
                        'parent_profile_id' => $parent->id,
                        'amount' => $cells[23],
                        'paying_for' => $cells[32],
                        'type_of_payment' => 'Custom Letter',
                        "status" => $cells[22] == 'PAID' ? 'paid' : 'pending',
                        'order_id' => $cells[13]
                    ]);
                }
            }
        }
        $reader->close();
        $this->line('import successfully');
    }
}
