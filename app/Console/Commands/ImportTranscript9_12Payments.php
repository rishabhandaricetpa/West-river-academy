<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\Transcript;
use App\Models\TranscriptPayment;
use Illuminate\Support\Str;

class ImportTranscript9_12Payments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:transcript9_12payment';

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
        $filePath = base_path('csv/payments9_12.csv');
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
                $transcript = Transcript::where('legacy_name', $legacy_name)->first();
                if (!is_null($transcript)  ) {
                    TranscriptPayment::create([
                        'transcript_id' => (isset($transcript)) ? $transcript->id : 0,
                        'amount' => $cells[30],
                        'status' => $cells[22],
                        'legacy_name' => $cells[12],
                        'order_id' => $cells[13],
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