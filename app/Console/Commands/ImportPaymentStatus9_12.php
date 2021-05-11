<?php

namespace App\Console\Commands;

use App\Models\TranscriptPayment;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Hash;

class ImportPaymentStatus9_12 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:paymentstatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Payment status after transcript payments';

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
                $order_id = Str::of($cells[19]);


                $transcript = TranscriptPayment::where('order_id', $order_id)->first();
                if ($transcript) {
                    $updatePaymentIdinTranscript = TranscriptPayment::where('order_id', $order_id)->update(
                        [
                            'transcation_id' => $cells[15],
                            'payment_mode' => $cells[17],
                            'status'=>$cells[17]==='APPLIED'?'paid':'pending',
                        ]
                    );
                }
            }
        }
        $reader->close();
        $this->line('import successfully');
    }
}
