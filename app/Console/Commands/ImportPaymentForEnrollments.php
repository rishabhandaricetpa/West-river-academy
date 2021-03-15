<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\EnrollmentPayment;
use App\Models\EnrollmentPeriods;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class ImportPaymentForEnrollments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Payment For Enrollments';

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
        $filePath = base_path('csv/paymentsDataforenrollment.csv');
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
                $payment_order_id = EnrollmentPayment::where('order_id', $order_id)->first();
                if ($payment_order_id) {
                    // $student = EnrollmentPayment::where('order_id', $order_id);
                    // $student->transcation_id = $cells[15];
                    // $student->payment_mode =  $cells[17];
                    // $student->update();
                    $updatePayments = EnrollmentPayment::where('order_id', $order_id)->update(
                        [
                            'transcation_id' => $cells[15],
                            'payment_mode' => $cells[17],
                        ]
                    );
                    $updatePaymentIdinPeriods = EnrollmentPeriods::where('order_id', $order_id)->update(
                        [
                            'enrollment_payment_id' => (isset($payment_order_id)) ? $payment_order_id->id : 0,
                        ]
                    );
                } else {
                    continue;
                }
            }
        }
        $reader->close();
        $this->line('import successfully');
    }
}
