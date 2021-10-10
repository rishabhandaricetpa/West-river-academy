<?php

namespace App\Console\Commands;

use App\Models\OrderPersonalConsultation;
use App\Models\TransactionsMethod;
use App\Models\Dashboard;
use App\Models\ParentProfile;
use Illuminate\Console\Command;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;


class UpdatePersonalConsultation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:updatepaymentconsultation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import transction id and payment mode in personal consultation';

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
                $parent_email = $cells[11];
                $legacy_name = $cells[12];

                $personal_consultation = OrderPersonalConsultation::where('order_id', $cells[19])->first();
                if ($personal_consultation) {
                    $parent =  ParentProfile::where('id', $personal_consultation->parent_profile_id)->first();
                    $personal_consultation->update([
                        'transcation_id' => $cells[15],
                        'payment_mode' => $cells[17]
                    ]);

                    $t =   TransactionsMethod::create([
                        'transcation_id' => $cells[15],
                        'payment_mode' => $cells[17],
                        'parent_profile_id' => $personal_consultation->parent_profile_id,
                        'amount' => $personal_consultation->amount,
                        'status' => $personal_consultation->status,
                        'item_type' => 'order_consultation',
                    ]);

                    Dashboard::create([
                        'created_date' => $cells[9],
                        'linked_to' => $parent->p1_first_name,
                        'amount' => $personal_consultation->amount,
                        'related_to' => 'Personal Consulatation Ordered',
                        'transaction_id' =>  $t->transcation_id,
                        'parent_profile_id' => $personal_consultation->parent_profile_id,
                        'item_type_id' => $personal_consultation->id
                    ]);
                }
            }
        }
        $reader->close();
        $this->line('import successfully');
    }
}
