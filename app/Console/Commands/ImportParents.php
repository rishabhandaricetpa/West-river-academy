<?php

namespace App\Console\Commands;

use App\Models\ParentProfile;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Hash;

class ImportParents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:parents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importing Parents';

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
        $_this = $this;
        $filePath = base_path('csv/family.csv');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);
        $reader->open($filePath);
$duplicateCheckArray = [];
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as
                $rowIndex => $cells) {
                $cells = $cells->getCells();
                if ($rowIndex === 1) {
                    continue;
                }
                $p1_email = Str::of($cells[13]);
                if( !isset($duplicateCheckArray[$p1_email]) ) $duplicateCheckArray[$p1_email] = 0;
                $duplicateCheckArray[$p1_email] = ($duplicateCheckArray[$p1_email] + 1);

                $_this->line($p1_email);
                // if ($p1_email != '' && 1==2) {

                //     $user = User::where('email', $p1_email)->first();
                //     if (!$user) {
                //         $user = User::create(
                //             [
                //                 'name' => $cells[14],
                //                 'email' => $cells[13],
                //                 'legacy_name' => $cells[11],
                //                 'password' => Hash::make('12345678'),
                //             ]
                //         );
                //     } 
                //     $parent = ParentProfile::where('p1_email', $p1_email)->first();
                //     if( !$parent )
                //         ParentProfile::create([
                //             'user_id' => $user ? $user->id : null,
                //             'p1_first_name' => $cells[14],
                //             'p1_last_name' => $cells[15],
                //             'p1_email' => $cells[13],
                //             'p1_cell_phone' => $cells[4],
                //             'p1_home_phone' =>  $cells[4],
                //             'street_address' => $cells[8],
                //             'legacy' => $cells[11],
                //             'city' => $cells[5],
                //             'state' =>  $cells[7],
                //             'zip_code' =>  $cells[9],
                //             'country' => $cells[6],
                //             'reference' =>  $cells[18],
                //             'immunized' =>  $cells[10]
                //         ]);
                // }
               
            }
        }
        echo '<pre>'; print_r($duplicateCheckArray);
        $reader->close();
        $this->line('import successfully');
    }
}
