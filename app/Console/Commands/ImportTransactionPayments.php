<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\EnrollmentPayment;
use App\Models\ParentProfile;
use App\Models\TransactionsMethod;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class ImportTransactionPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:transactions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import transcations data';

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
                $legacy_name = Str::of($cells[12]);
                $email = Str::of($cells[11]);
                $parent_profile = ParentProfile::where('p1_email', $email)->first();
                if ($parent_profile) {
                    TransactionsMethod::create([
                        'transcation_id' => $cells[15],
                        'payment_mode' => $cells[17],
                        'order_id' => $cells[19],
                        'parent_profile_id' => (isset($parent_profile)) ? $parent_profile->id : 0,
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
