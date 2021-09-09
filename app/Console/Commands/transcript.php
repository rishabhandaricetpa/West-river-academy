<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Hash;
use DB;
use Carbon\Carbon;


class transcript extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:transcript';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $filePath = base_path('csv/transcript.csv');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);
        $reader->open($filePath);

        $dataArray['correctRecords']  = [];
        $dataArray['parentNotFound']  = [];
        $dataArray['studentNotFound']  = [];
        $dataArray['student']  = [];
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as
                $rowIndex => $cells) {
                $cells = $cells->getCells();
                if ($rowIndex === 1) {
                    continue;
                }
                
                $parent_email = Str::of($cells[21]);
                $student_name  = Str::of($cells[9]);
                $legacy_name  = Str::of($cells[19]);
                
                if( $parent_email && $legacy_name )
                {
                    $studentArray   = explode(' ', $student_name);
                    $isParentEmail  = strpos($parent_email,config('constants.CSV_DOMAIN'));

                    $student = \App\Models\StudentProfile::where( DB::raw("CONCAT(lower(first_name),' ',lower(last_name))"), strtolower($student_name) )
                                                        ->orWhere(function($query) use($studentArray, $student_name, $legacy_name) {
                                                                $query->where(DB::raw('lower(first_name)'), strtolower($studentArray[0]));
                                                                if(isset($studentArray[1]))
                                                                    $query->orWhere(DB::raw('lower(last_name)'), strtolower($studentArray[1]));
                                                                if(isset($studentArray[2]))
                                                                    $query->orWhere(DB::raw('lower(last_name)'), strtolower($studentArray[2]));
                                                                if(isset($studentArray[3]))
                                                                    $query->orWhere(DB::raw('lower(last_name)'), strtolower($studentArray[3]));
                                                            });
                    if( $student->count() > 1 )
                        $student->where(DB::raw('lower(legacy_name)'), trim(strtolower($legacy_name))); 
                    
                    $student    = $student->first();

                    if( $student )
                    {
                        if( $isParentEmail )
                            $parent  = \App\Models\ParentProfile::whereId($student->parent_profile_id)->first();
                        else
                            $parent  = \App\Models\ParentProfile::where('p1_email', strtolower($parent_email))->first();

                        if($parent)
                        {
                            $array  = [
                                'parent_profile_id' => $parent->id,
                                'student_profile_id' => $student->id,
                                'parent' => $parent->p1_first_name.' '.$parent->p1_last_name,
                                'student' => $student->first_name.' '.$student->last_name,
                                'status' => 'pending',
                            ];
                            array_push($dataArray['correctRecords'], $array);
                        }
                        else{
                            $array  = [
                                'rowIndex' => $rowIndex,
                                'student_profile_id' => $student->id,
                                'student' => $student->first_name.' '.$student->last_name,
                                'status' => 'pending',
                            ];
                            array_push($dataArray['parentNotFound'], $array);
                        }
                    }else{
                        $array  = [
                            'rowIndex' => $rowIndex,
                            'status' => 'pending',
                        ];
                        array_push($dataArray['studentNotFound'], $array);
                    }
                }
            }
        }
        \App\Models\Transcript::insert($dataArray['correctRecords']);
        $reader->close();
        $this->line('import successfully');
    }
}
