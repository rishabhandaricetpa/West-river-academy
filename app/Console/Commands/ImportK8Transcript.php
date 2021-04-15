<?php

namespace App\Console\Commands;

use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\Transcript;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;


class ImportK8Transcript extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:k8transcript';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import k8 transcript';

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
        $filePath = base_path('csv/k8transcript.csv');
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
                $parent = ParentProfile::where('legacy', $legacy_name)->first();
                $student = StudentProfile::where('legacy_name', $legacy_name)->first();
                if ($parent && $student) {
                    Transcript::create([
                        'parent_profile_id' => (isset($parent)) ? $parent->id : 0,
                        'student_profile_id' => (isset($student)) ? $student->id : 0,
                        'period' => 'K-8',
                        'status' => $cells[8],
                        'legacy_name' => $cells[12]
                    ]);
                }
            }
        }

        $reader->close();
        $this->line('import successfully');
    }
}