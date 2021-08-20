<?php

namespace App\Console\Commands;

use App\Models\Apostille;
use App\Models\Notarization;
use App\Models\NotarizationPayment;
use App\Models\ParentProfile;
use Illuminate\Console\Command;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;


class ImportApostile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:apostile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Apostile data in table apostile and notzation without transction data';

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
        $filePath = base_path('csv/apostile.csv');
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
                $parent = ParentProfile::where('p1_email',$parent_email)->first();
                if($parent){
                 $apostile=   Apostille::create([
                        'parent_profile_id'=>$parent->id,
                        'postage_option'=> 'Apostille',
                        'apostille_country'=>$cells[16],
                        'first_name'=>$cells[17],
                        'last_name'=>$cells[18],
                        'street'=>$cells[20],
                        'city'=>$cells[15],
                        'country'=>$cells[16],
                        'zip_code'=>$cells[21]
                    ]);
                    NotarizationPayment::create([
                        "apostille_id"=> $apostile->id,
                        'parent_profile_id'=>$parent->id,
                        'pay_for'=>'apostile',
                        'amount'=>$cells[33],
                        'status'=>$cells[22],
                        'order_id'=>$cells[13]
                    ]);

                }
              
               
            }
        }
        $reader->close();
        $this->line('import successfully');
    }
}
