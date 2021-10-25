<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Hash;
use Carbon\Carbon;


class ImportUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import All Users';

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
        $filePath = base_path('csv/family.csv');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);
        $reader->open($filePath);

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as
                $rowIndex => $cells) {
                $cells = $cells->getCells();
                $date  = Carbon::now();

                if ($rowIndex === 1) {
                    continue;
                }
                if ($cells[13] != '' && $cells[13] != 'x' && $cells[13] != 'xx' && $cells[13] != 'xxx') {

                    User::create(
                        [
                            'name' => $cells[14] == '' ? "Test Name" :  $cells[14],
                            'email' => $cells[13],
                            'legacy_name' => $cells[11],
                            'password' => Hash::make('12345678'),
                            'email_verified_at' => $date
                        ]
                    );
                }
            }
        }

        $reader->close();
        $this->line('import successfully');
    }
}
