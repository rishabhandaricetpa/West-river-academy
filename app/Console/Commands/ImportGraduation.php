<?php

namespace App\Console\Commands;

use App\Models\Graduation;
use App\Models\GraduationDetail;
use App\Models\GraduationMailingAddress;
use App\Models\GraduationPayment;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use Illuminate\Console\Command;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use DB;

class ImportGraduation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:graduation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import graduation table data';

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
        $filePath = base_path('csv/graduation.csv');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);
        $reader->open($filePath);

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as
                $rowIndex => $cells) {
                $cells = $cells->getCells();
                if ($rowIndex === 1) {
                    continue;
                }
                $parent = ParentProfile::where('p1_email', $cells[11])->orWhere(DB::raw('lower(legacy)'), trim(strtolower($cells[12])))->first();
                if ($parent) {
                    $student = StudentProfile::where('parent_profile_id', $parent->id)->first();
                }
                // if ($student->count() > 1)
                //     $student->where(DB::raw('lower(legacy_name)'), trim(strtolower($cells[12])));

                if ($parent && $student) {
                    $graduation =  Graduation::create([
                        'parent_profile_id' => $parent->id,
                        'student_profile_id' => $student->id,
                        'status' => $cells[22] == 'paid' ? 'paid' : 'pending',
                        'grade_9_info' => '',
                        'grade_10_info' => '',
                        'grade_11_info' => '',
                        'order_id' => $cells[13]
                    ]);
                    if ($cells[22] !== 'unpaid') {
                        GraduationPayment::create([
                            'graduation_id' => $graduation->id,
                            'amount' => $cells[14],
                            'order_id' => $cells[13]
                        ]);
                    }
                    GraduationDetail::create([
                        'graduation_id' => $graduation->id,
                        'notes' => $cells[32]
                    ]);
                    GraduationMailingAddress::create([
                        'graduation_id' => $graduation->id,
                        'name' => $cells[17],
                        'street' => $cells[20],
                        'city' => $cells[15],
                        'country' => $cells[16],
                        'postal_code' => $cells[21]

                    ]);
                }
            }
        }
        $reader->close();
        $this->line('import successfully');
    }
}
