<?php

namespace App\Console\Commands;

use App\Models\RepresentativeAmount;
use App\Models\RepresentativeGroup;
use Illuminate\Console\Command;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use DB;
use Illuminate\Support\Str;

class ImportRepresentativeAmount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:repamount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'table representative_amount';

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
        $filePath = base_path('csv/generated.csv');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);
        $reader->open($filePath);

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as
                $rowIndex => $cells) {
                $cells = $cells->getCells();
                if ($rowIndex === 1) {
                    continue;
                }
                $rep_name = Str::of($cells[8]);

                $rep_email = Str::of($cells[7]);

                $representative =  RepresentativeGroup::where('email', $rep_email)
                    ->first();
                if ($representative) {
                    RepresentativeAmount::create([
                        'representative_group_id' =>  $representative->id,
                        'amount' => $cells[25] == '' ||   $cells[25] == null ?  0 : $cells[25],
                        'notes' => $cells[5],
                    ]);
                }
            }
        }

        $reader->close();
        $this->line('import successfully');
    }
}
