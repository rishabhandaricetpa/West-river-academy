<?php

namespace App\Console\Commands;

use App\Models\ParentProfile;
use App\Models\RepresentativeGroup;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use DB;
use Illuminate\Support\Str;


use Illuminate\Console\Command;

class UpdateParentRepresentative extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:parentrep';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update parent with rep id';

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
        // $arr['correct'] = [];
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as
                $rowIndex => $cells) {
                $cells = $cells->getCells();
                if ($rowIndex === 1) {
                    continue;
                }


                $legacy_name = Str::of($cells[20]);

                $parent =  ParentProfile::where('legacy', $legacy_name)->first();
                $rep_name =   Str::of($cells[8]);
                if ($parent) {
                    $representative = RepresentativeGroup::where('name', $rep_name)->first();
                }

                if ($parent  && $representative) {
                    $parent->update([
                        'representative_group_id' =>
                        $representative->id
                    ]);
                }

             
            }
        }
        // print_r($arr);
        $reader->close();
        $this->line('import successfully');
    }
}
