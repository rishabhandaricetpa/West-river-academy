<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\Transcript;
use Illuminate\Support\Str;

class ImportTranscript9_12 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:transcript9_12';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import for transcript 9_12 ';

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
        $filePath = base_path('csv/transcript9_12.csv');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);
        $reader->open($filePath);

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as
                $rowIndex => $cells) {
                $cells = $cells->getCells();
                if ($rowIndex === 1) {
                    continue;
                }
                $legacy_name = Str::of($cells[19]);
                $parent = ParentProfile::where('legacy', $legacy_name)->first();
                //  dd($parent);
                $student = StudentProfile::where('legacy_name', $legacy_name)->first();
                if (!is_null($parent)  && !is_null($student)) {
                    Transcript::create([
                        'parent_profile_id' => (isset($parent)) ? $parent->id : 0,
                        'student_profile_id' => (isset($student)) ? $student->id : 0,
                        'period' => '9-12',
                        'status' => $cells[8],
                        'legacy_name' => $cells[12]
                    ]);
                } else {
                    continue;
                }
            }
        }

        $reader->close();
        $this->line('import successfully');
    }
}