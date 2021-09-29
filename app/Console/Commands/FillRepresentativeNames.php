<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Str;

class FillRepresentativeNames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:repname';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fill empty rep name for parents';

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
        $filePath = base_path('csv/rep.csv');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);
        $writer = WriterEntityFactory::createCSVWriter();
        $writer->openToFile(base_path('csv/generated.csv'));
        $reader->open($filePath);

        foreach ($reader->getSheetIterator() as $sheet) {
            $last_rep_name = '';
            foreach ($sheet->getRowIterator() as
                $rowIndex => $cells) {
                $cells = $cells->toArray();
                // print_r($cells);

                if ($rowIndex === 1) {
                    continue;
                }
                $rep_name =   $cells[8];
                if ($last_rep_name  === '') {

                    if (strlen($rep_name) > 0) {
                        $last_rep_name = $rep_name;
                    }
                    $cells[8] = $last_rep_name;
                     // print($cells[8]);
                    continue;
                }
                if (strlen($rep_name) == 0 && $rep_name != $last_rep_name) {
                    $rep_name = $last_rep_name;
                } else {
                    $last_rep_name = $rep_name;
                }
            
                $cells[8] = $last_rep_name;
                // print_r($cells);
                

               // var_dump($cells);
                $rowFromValues = WriterEntityFactory::createRowFromArray($cells);
                $writer->addRow($rowFromValues);
            }
        }
        // print_r($arr);
        $reader->close();
        $writer->close();
        $this->line('import successfully');
    }
}
