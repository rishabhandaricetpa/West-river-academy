<?php

namespace App\Console\Commands;

use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\EnrollmentPeriods;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use DB;

class ImportEnrollmentPeriod extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:enrollments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Enrollment';

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
        $filePath = base_path('csv/enrollments_periods.csv');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);
        $reader->open($filePath);
        $notFound = [];
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as
                $rowIndex => $cells) {
                $cells = $cells->getCells();
                if ($rowIndex === 1) {
                    continue;
                }
                $selectedStartDate = \Carbon\Carbon::parse($cells[36]);
                $student_name = $cells[34];
                $legacy_name = $cells[12];
                // dd($student_name);
                $studentArray   = explode(' ', $student_name);

                $selectedEndDate = \Carbon\Carbon::parse($cells[37]);
                $type = $selectedStartDate->diffInMonths($selectedEndDate) > 7 ? 'annual' : 'half';


                $student = \App\Models\StudentProfile::where(DB::raw("CONCAT(lower(first_name),' ',lower(last_name))"), strtolower($student_name))
                    ->orWhere(function ($query) use ($studentArray, $student_name, $legacy_name) {
                        $query->where(DB::raw('lower(first_name)'), strtolower($studentArray[0]));
                        $query->where(DB::raw('legacy_name', $legacy_name));
                        if (isset($studentArray[1]))
                            $query->orWhere(DB::raw('lower(last_name)'), strtolower($studentArray[1]));
                        if (isset($studentArray[2]))
                            $query->orWhere(DB::raw('lower(last_name)'), strtolower($studentArray[2]));
                        if (isset($studentArray[3]))
                            $query->orWhere(DB::raw('lower(last_name)'), strtolower($studentArray[3]));
                    });

                $student    = $student->first();
                if ($student) {
                    EnrollmentPeriods::create([
                        'student_profile_id' => (isset($student)) ? $student->id : 0,
                        'start_date_of_enrollment' => $cells[36],
                        'end_date_of_enrollment' => $cells[37],
                        'grade_level' => $cells[38],
                        'order_id' => $cells[13],
                        'type' => $type,
                    ]);
                } else {
                    array_push($notFound, ['email' =>  $cells[12]]);
                }
            }
        }
// todo :: add confirmation document i.e insert data in confirmation_letter table
        $reader->close();
        $this->line('import successfully');
    }
}
