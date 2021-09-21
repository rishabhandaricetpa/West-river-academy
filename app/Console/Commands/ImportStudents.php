<?php

namespace App\Console\Commands;

use App\Models\ParentProfile;
use App\Models\StudentProfile;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use DB;
class ImportStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:students';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Students';

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
        $filePath = base_path('csv/students.csv');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);
        $reader->open($filePath);
        $alreadyStudent  = [];

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as
                $rowIndex => $cells) {
                $cells = $cells->getCells();
                if ($rowIndex === 1) {
                    continue;
                }
                $parent_email = Str::of($cells[17]);
                $family_name  = Str::of($cells[11]);
                $user_email = ParentProfile::where('p1_email', $parent_email)->first();
                $legacy_name = ParentProfile::where('legacy', $family_name)->first();

                $student = \App\Models\StudentProfile::
                                                            where(function($query) use($cells) {
                                                                $query->where(DB::raw('lower(first_name)'), strtolower($cells[12]));
                                                                $query->where(DB::raw('lower(last_name)'), strtolower($cells[13]));
                                                                $query->whereEmail($cells[3]);
                                                                $query->whereLegacyName($cells[11]);
                                                            });
                    $student    = $student->first();
                if( !$student ){
                    if ($user_email) {
                        StudentProfile::create([
                            'parent_profile_id' => $user_email ? $user_email->id : 0,
                            'first_name' => $cells[12],
                            'last_name' => $cells[13],
                            'gender' => $cells[5],
                            'd_o_b' => $cells[2],
                            'email' =>  $cells[3],
                            'cell_phone' => $cells[16],
                            'student_Id' => $cells[9],
                            'legacy_name' => $cells[11],
                            'student_situation' =>  $cells[9],
                        ]);
                    } elseif ($legacy_name) {
                        StudentProfile::create([
                            'parent_profile_id' => $legacy_name ? $legacy_name->id : 0,
                            'first_name' => $cells[12],
                            'last_name' => $cells[13],
                            'gender' => $cells[5],
                            'd_o_b' => $cells[2],
                            'email' =>  $cells[3],
                            'cell_phone' => $cells[16],
                            'student_Id' => $cells[9],
                            'legacy_name' => $cells[11],
                            'student_situation' =>  $cells[9],
                        ]);
                    }
                    else{
                        array_push($alreadyStudent, ['email' =>  $cells[3]]);
                    }
                }
            }
        }
        $reader->close();
        $this->line('import successfully');
    }
}
