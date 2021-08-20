<?php

namespace App\Console\Commands;

use App\Models\GraduationPayment;
use Illuminate\Console\Command;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class ImportGraduationPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:graduationpayment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'graduation payment';

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
        $filePath = base_path('csv/payments.csv');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);
        $reader->open($filePath);

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as
                $rowIndex => $cells) {
                $cells = $cells->getCells();
                if ($rowIndex === 1) {
                    continue;
                }
                GraduationPayment::where('order_id',$cells[19])->update([
                    'transcation_id'=>$cells[15],
                    'payment_mode'=>$cells[17]

                ]);

            }
        }
        $reader->close();
        $this->line('import successfully');
    }
}
