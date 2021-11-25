<?php

namespace App\Services;

use Carbon\Carbon;

class CountriesEnrollmentDate
{
    /** 
     * start month date
     * 
     */
    public $month_start_date = 0;

    /**
     *  end date of enrollment  
     */
    protected $month_end_date = 0;

    /**
     * Get a new instance
     */
    function __construct($month_start_date, $month_end_date)
    {
        $this->month_start_date = $month_start_date;
        $this->month_end_date = $month_end_date;
    }

    /** 
     * disable months for  start date & end date
     */
    public function getEnrollmentDates()
    {
        $to_start_month = Carbon::create($this->month_start_date)->format('m');
        $to_end_month = Carbon::create($this->month_end_date)->format('m');
        // where end date of enrollment month is 3 i.e April 
        if ($to_end_month == 3) {
            $disable_end_date = range($to_end_month, 12);
            $disable_start_date = range(0, $to_start_month - 2);
        } else if ($to_end_month == 7) {
            $disable_end_date = range($to_end_month, 12);
            $disable_start_date = range(0, $to_start_month - 2);
        } else {
            $disable_end_date = [];
            $disable_start_date = [];
        }

        return ['start_date' => $disable_start_date, 'end_date' => $disable_end_date];
    }
}
