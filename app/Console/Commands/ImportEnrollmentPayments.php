<?php

namespace App\Console\Commands;

use App\Models\EnrollmentPayment;
use App\Models\EnrollmentPeriods;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Hash;

class ImportEnrollmentPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:enrollmentpayment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Enrollment Payment';

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
        $filePath = base_path('csv/payment.csv');
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


                $enrollment_payment = EnrollmentPeriods::where('order_id', $order_id)->first();

                if ($enrollment_payment) {
                    EnrollmentPayment::create([
                        'enrollment_period_id' => (isset($enrollment_payment)) ? $enrollment_payment->id : 0,
                        'amount' => $cells[2],
                        'order_id' => $cells[19],
                        'status' => $cells[16] == 'APPLIED' ? 'paid' : 'pending',
                    ]);
                }
            }
        }
        $reader->close();
        $this->line('import successfully');
    }
}
