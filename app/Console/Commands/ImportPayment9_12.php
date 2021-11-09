<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Hash;
use DB;
use Carbon\Carbon;

class ImportPayment9_12 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:payment9_12';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transcript Payment';

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
        $paymentArray  = [];
        $parentNotFoundArray  = [];
        $studentNotFoundArray  = [];
        $this->line('starting import');
        $filePath = base_path('csv/payments9_12.csv');
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
                $transaction_id = Str::of($cells[13]);
                // $parent = \App\Models\ParentProfile::where('legacy', $legacy_name)->first();
                $student = \App\Models\StudentProfile::where(DB::raw('legacy_name'), $legacy_name)->first();
                
                $parent = \App\Models\ParentProfile::
                            where(function($query) use($email, $legacy_name) {
                                $query->where(DB::raw('lower(legacy)'), strtolower($legacy_name));
                                $query->orWhere('p1_email', strtolower($email));
                            })->first();
                // echo '<pre>'; print_r($parent);
                if ( !is_null($parent) && !is_null($student) && !empty(trim($cells[11])) ) {
                    array_push($paymentArray, [
                        'parent_id' => $parent['id'],
                        'student_id' => $student['id'],
                        'transaction_id' => $transaction_id
                    ]);
                } elseif( is_null($parent) ){
                    array_push($parentNotFoundArray, $email);
                }else if( is_null($student)){
                    array_push($studentNotFoundArray, $email);
                }else {
                    continue;
                }
            }
        }
echo '<pre>';print_r($paymentArray);print_r($parentNotFoundArray);print_r($studentNotFoundArray);
        $reader->close();
        $this->line('import successfully');
    }
}
