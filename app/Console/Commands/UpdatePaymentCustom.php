<?php

namespace App\Console\Commands;

use App\Models\CustomPayment;
use App\Models\Dashboard;
use App\Models\ParentProfile;
use App\Models\TransactionsMethod;
use Illuminate\Console\Command;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class UpdatePaymentCustom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:updatecustom';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update transction id and payment mode in custom payment';

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
                // todo add order_id column in custom payment
                $custom = CustomPayment::where('order_id', $cells[19])->first();
                if ($custom) {
                    $parent = ParentProfile::where('id', $custom->parent_profile_id)->first();
                    $custom->update([
                        'transcation_id' => $cells[15],
                        'payment_mode' => $cells[17]
                    ]);

                    $t =   TransactionsMethod::create([
                        'transcation_id' => $cells[15],
                        'payment_mode' => $cells[17],
                        'parent_profile_id' => $custom->parent_profile_id,
                        'amount' => $custom->amount,
                        'status' => $custom->status,
                        'item_type' => 'custom',
                    ]);

                    Dashboard::create([
                        'created_date' => $cells[9],
                        'linked_to' => $parent->p1_first_name,
                        'amount' => $custom->amount,
                        'related_to' => 'Custom Payment Ordered',
                        'transaction_id' =>  $t->transcation_id,
                        'parent_profile_id' => $custom->parent_profile_id,
                        'item_type_id' => $custom->id
                    ]);
                }
            }
        }
        $reader->close();
        $this->line('import successfully');
    }
}
