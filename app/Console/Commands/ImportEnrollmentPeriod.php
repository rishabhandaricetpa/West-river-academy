<?php

namespace App\Console\Commands;

use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\EnrollmentPeriods;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

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

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as
                $rowIndex => $cells) {
                $cells = $cells->getCells();
                if ($rowIndex === 1) {
                    continue;
                }
                $legacy_name = Str::of($cells[12]);
                $selectedStartDate = \Carbon\Carbon::parse($cells[36]);
                $selectedEndDate = \Carbon\Carbon::parse($cells[37]);
                $type = $selectedStartDate->diffInMonths($selectedEndDate) > 7 ? 'annual' : 'half';

                $student_present = StudentProfile::where('legacy_name', $legacy_name)->first();

                if ($student_present) {
                    EnrollmentPeriods::create([
                        'student_profile_id' => (isset($student_present)) ? $student_present->id : 0,
                        'start_date_of_enrollment' => $cells[36],
                        'end_date_of_enrollment' => $cells[37],
                        'grade_level' => $cells[38],
                        'order_id' => $cells[13],
                        'type' => $type,
                    ]);
                }
            }
        }
        $reader->close();
        $this->line('import successfully');
    }
}
