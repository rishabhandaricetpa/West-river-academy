<?php

namespace App\Console\Commands;

use App\Models\NotarizationPayment;
use App\Models\TransactionsMethod;
use Illuminate\Console\Command;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class ImportNotarizationPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:notarizationpayment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import notarization payment details in notrization_payment table';

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
                $notarization = NotarizationPayment::where('order_id', $cells[19])->first();
                 NotarizationPayment::where('order_id',$cells[19])->update([
                    'transcation_id'=>$cells[15],
                    'payment_mode'=>$cells[17]
                 ]);
                 if($notarization){
                    TransactionsMethod::create([
                        'transcation_id' => $cells[15],
                        'payment_mode' => $cells[17],
                        'order_id' => $cells[19],
                        'parent_profile_id' => $notarization->parent_profile_id,
                        'amount' => $cells[20],
                        'status' => $cells[16],
                    ]);
                 }
               


            }
        }
        $reader->close();
        $this->line('import successfully');
    }
}
