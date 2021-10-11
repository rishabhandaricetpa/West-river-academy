<?php

namespace App\Console\Commands;

use App\Models\Dashboard;
use App\Models\Graduation;
use App\Models\GraduationPayment;
use App\Models\StudentProfile;
use App\Models\TransactionsMethod;
use Illuminate\Console\Command;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Illuminate\Support\Carbon;

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
                GraduationPayment::where('order_id', $cells[19])->update([
                    'transcation_id' => $cells[15],
                    'payment_mode' => $cells[17]

                ]);
                $graduation =   Graduation::where('order_id', $cells[19])->first();


                if ($graduation) {
                    $student = StudentProfile::where('id',  $graduation->student_profile_id)->first();
                }

                $graduation_payment = GraduationPayment::where('order_id', $cells[19])->first();
                if ($graduation && $graduation->status == 'paid') {
                    $t =   TransactionsMethod::create([
                        'transcation_id' => $cells[15],
                        'payment_mode' => $cells[17],
                        'parent_profile_id' => $graduation->parent_profile_id,
                        'amount' => $graduation_payment->amount,
                        'status' =>  $graduation->status,
                        'item_type' => 'graduation',
                    ]);
                    Dashboard::create([
                        'created_date' => $cells[10] ? Carbon::parse($cells[10]) : Carbon::now(),
                        'linked_to' => $student->first_name,
                        'amount' => $graduation_payment->amount,
                        'related_to' => 'Graduation Ordered',
                        'transaction_id' =>  $t->transcation_id,
                        'parent_profile_id' =>  $student->parent_profile_id,
                        'item_type_id' =>  $graduation_payment->id
                    ]);
                }
            }
        }
        $reader->close();
        $this->line('import successfully');
    }
}
