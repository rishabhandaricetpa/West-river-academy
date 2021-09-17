<?php

namespace App\Console\Commands;

use App\Models\ParentProfile;
use App\Models\RecordTransfer;
use App\Models\StudentProfile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use DB;
use Illuminate\Console\Command;

class ImportRecordRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:records';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Record Transfer Request';

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
        $filePath = base_path('csv/RecordRequest.csv');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);
        $reader->open($filePath);
        $missingRecords = [];
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as
                $rowIndex => $cells) {
                $cells = $cells->getCells();
                if ($rowIndex === 1) {
                    continue;
                }
                $leagcy_name = Str::of($cells[28]);
                $student_name = Str::of($cells[29]);
                $studentArray   = explode(' ', $student_name);
                $student = StudentProfile::where(DB::raw("CONCAT(lower(first_name),'',lower(last_name))"), strtolower($student_name))
                    ->where(DB::raw('lower(legacy_name)'), trim(strtolower($leagcy_name)))
                    ->orWhere(function ($query) use ($studentArray) {
                        $query->where(DB::raw('lower(first_name)'), strtolower($studentArray[0]));
                        if (isset($studentArray[1]))
                            $query->orWhere(DB::raw('lower(last_name)', strtolower($studentArray[1])));
                        if (isset($studentArray[2]))
                            $query->orWhere(DB::raw('lower(last_name)', strtolower($studentArray[2])));
                        if (isset($studentArray[3]))
                            $query->orWhere(DB::raw('lower(last_name)', strtolower($studentArray[3])));
                    });



                $student    = $student->first();
                if ($student) {
                    $parent  = \App\Models\ParentProfile::whereId($student->parent_profile_id)->first();
                }



                if ($student) {
                    $parent  = \App\Models\ParentProfile::whereId($student->parent_profile_id)->first();
                    if ($parent) {
                        RecordTransfer::create(
                            [
                                'student_profile_id' => (isset($student)) ? $student->id : 0,
                                'parent_profile_id' => (isset($parent)) ? $parent->id : 0,
                                'school_name' => $cells[6],
                                'email' => $cells[12],
                                'fax_number' => $cells[13],
                                'phone_number' => $cells[14],
                                'street_address' => $cells[9],
                                'city' => $cells[10],
                                'state' => $cells[15],
                                'zip_code' => $cells[16],
                                'legacy_name' => $cells[28],
                                'country' => $cells[11],
                                'firstRequestDate' => $cells[19],
                                'secondRequestDate' => $cells[17],
                                'thirdRequest' => $cells[20],
                            ]
                        );
                    } else {
                        $array  = [
                            'rowIndex' => $rowIndex,
                            'legacy_name' => Str::of($cells[28]),


                        ];
                        array_push($missingRecords, $array);
                    }
                }
            }
        }
        print_r($missingRecords);
        $reader->close();
        $this->line('import successfully');
    }
}
