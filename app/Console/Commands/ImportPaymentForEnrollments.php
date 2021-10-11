<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\EnrollmentPayment;
use App\Models\TransactionsMethod;
use App\Models\Dashboard;
use App\Models\EnrollmentPeriods;
use App\Models\StudentProfile;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class ImportPaymentForEnrollments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:enrollmentpaymentsmethods';

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
                $legacy_name = Str::of($cells[12]);
                $payment_order_id = EnrollmentPayment::where('order_id', $order_id)->first();
                if ($payment_order_id) {
                    $updatePayments = EnrollmentPayment::where('order_id', $order_id)->update(
                        [
                            'transcation_id' => $cells[15],
                            'payment_mode' => $cells[17],
                        ]
                    );
                    $ep =   EnrollmentPeriods::where('order_id', $order_id)->first();
                    $student = StudentProfile::where('id', $ep->student_profile_id)->first();
                    EnrollmentPeriods::where('order_id', $order_id)->update(
                        [
                            'enrollment_payment_id' => (isset($payment_order_id)) ? $payment_order_id->id : 0,
                        ]
                    );

                    if ($payment_order_id->status == 'paid') {
                        $t =   TransactionsMethod::create([
                            'transcation_id' => $cells[15],
                            'payment_mode' => $cells[17],
                            'parent_profile_id' =>  $student->parent_profile_id,
                            'amount' => $payment_order_id->amount,
                            'status' => $payment_order_id->status,
                            'item_type' => 'Enrollment',
                        ]);

                        Dashboard::create([
                            'created_date' => $cells[9],
                            'linked_to' => $student->first_name,
                            'amount' => $payment_order_id->amount,
                            'related_to' => 'Student Enrolled',
                            'transaction_id' =>  $t->transcation_id,
                            'parent_profile_id' =>  $student->parent_profile_id,
                            'item_type_id' => $ep->id
                        ]);
                    }
                } else {
                    continue;
                }
            }
        }
        $reader->close();
        $this->line('import successfully');
    }
}
