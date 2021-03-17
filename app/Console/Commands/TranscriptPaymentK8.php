<?php

namespace App\Console\Commands;

use App\Models\Transcript;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class TranscriptPaymentK8 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:transcriptk8payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Transcript Payment for k8';

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
                $transcript = Transcript::where('legacy_name', $legacy_name)->first();

                if ($transcript) {
                    Transcript::create([
                        'transcript_id' => (isset($transcript)) ? $transcript->id : null,
                        'amount' => (isset($student)) ? $student->id : null,
                        'status' => 'K-8',
                        'transcation_id' => $cells[8],
                        'payment_mode' => $cells[12]
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
