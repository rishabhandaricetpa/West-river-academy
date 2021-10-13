<?php

namespace App\Console\Commands;

use App\Models\Coupon;
use App\Models\ParentProfile;
use Illuminate\Console\Command;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Illuminate\Support\Carbon;

class ImportCoupon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:coupon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Coupons';

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
        $filePath = base_path('csv/Coupons.csv');
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);
        $reader->open($filePath);

        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as
                $rowIndex => $cells) {
                $cells = $cells->getCells();
                if ($rowIndex === 1) {
                    continue;
                }
                $parent = [];
                $parent_email = $cells[11];


                $coupon = Coupon::where('code', $cells[8])->first();
                $parent =  ParentProfile::where('p1_email', $cells[11])->first();

                $coupon = new Coupon();
                $coupon->code = $cells[8];
                $coupon->amount = $cells[10];
                $coupon->status = $cells[39] == 'Active' ? 'active' : 'inactive';
                $coupon->description = $cells[26];

                if ($parent) {
                    $coupon->coupon_for = $parent->id;
                }
                $coupon->expire_at = \Carbon\Carbon::parse($cells[37]);
                $coupon->save();

                /* if in case multiple ids are required for one coupon
                $parent_ids = explode(',', $coupon->coupon_for);
                $parent_ids = array_filter($parent_ids);
                $parent =  ParentProfile::where('p1_email', $cells[11])->first();
                if ($parent) {
                    if (!in_array($parent->id, $parent_ids)) {
                        array_push($parent_ids, $parent->id);
                    }
                }

                $coupon->coupon_for = implode(',', $parent_ids);
                $coupon->save();*/
            }
        }
        $reader->close();
        $this->line('import successfully');
    }
}
