<?php

namespace App\Console\Commands;

use App\Models\OrderPersonalConsultation;
use Illuminate\Console\Command;
use App\Models\ParentProfile;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class ImportPersonalConsultation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:personalconsultation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import in personal consulation';

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
        $filePath = base_path('csv/orders.csv');
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

                if ($cells[32] == 'Personal Consulting') {
                    $parent = ParentProfile::where('p1_email', $parent_email)->where('legacy', $legacy_name)->first();
                    if ($parent) {
                        OrderPersonalConsultation::create([
                            'parent_profile_id' => $parent->id,
                            'amount' => $cells[14],
                            'paying_for' => 'order_consultation',
                            'preferred_language' => 'English',
                            'status' => $cells[22] == 'PAID' ? 'paid' : 'pending',
                            'type_of_payment' => 'Order personal Consltation',
                            'order_id' => $cells[13]
                        ]);
                    }
                }
            }
        }
        $reader->close();
        $this->line('import successfully');
    }
}
