<?php

namespace App\Console\Commands;

use App\Models\RepresentativeGroup;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use DB;

class RepresentativeGroups extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:representative';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import representative group table for rep name';

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
        $filePath = base_path('csv/rep.csv');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);
        $reader->open($filePath);

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as
                $rowIndex => $cells) {
                $cells = $cells->getCells();
                if ($rowIndex === 1) {
                    continue;
                }
                $rep_name = Str::of($cells[8]);
                $rep_type = Str::of($cells[13]);
                $rep_country = Str::of($cells[6]);
                $rep_email = Str::of($cells[7]);
                $rep_phone = Str::of($cells[9]);
                $terms_of_agreement = Str::of($cells[5]);
                $rep_skype = Str::of($cells[10]);
                $representative =  RepresentativeGroup::where('email', $rep_email)
                    ->orWhere(function ($query) use ($rep_name) {
                        $query->where(DB::raw('lower(name)', Str::lower($rep_name)));
                    })->exists();
                if (!$representative) {
                    RepresentativeGroup::create([
                        'type' => $rep_type,
                        'name' => $rep_name,
                        'country' => $rep_country,
                        'rep_phone' => $rep_phone,
                        'terms_of_agreement' => $terms_of_agreement,
                        "rep_skype" => $rep_skype,
                        'email' => $rep_email,
                    ]);
                }
            }
        }

        $reader->close();
        $this->line('import successfully');
    }
}
