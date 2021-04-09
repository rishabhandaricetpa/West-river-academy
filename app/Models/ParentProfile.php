<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'p1_first_name', 'p1_middle_name', 'p1_last_name', 'p1_email', 'p1_cell_phone', 'p1_home_phone',
        'p2_first_name', 'p2_middle_name', 'p2_email', 'p2_cell_phone', 'p2_home_phone',
        'street_address', 'city', 'state', 'zip_code', 'country', 'reference', 'legacy',
        'immunized'
    ];
    protected $table = 'parent_profiles';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function studentProfile()
    {
        return $this->hasMany('App\Models\StudentProfile', 'parent_profile_id', 'id');
    }

    public function graduations()
    {
        return $this->hasMany('App\Models\Graduation', 'parent_profile_id', 'id');
    }

    public static function getParentPendingFees($parent_profile_id, $total = false)
    {
        try {
            $fees = DB::table('student_profiles')
                ->where('student_profiles.parent_profile_id', $parent_profile_id)
                ->leftJoin('enrollment_periods', 'enrollment_periods.student_profile_id', 'student_profiles.id')
                ->leftJoin('enrollment_payments', 'enrollment_payments.enrollment_period_id', 'enrollment_periods.id')
                ->where('enrollment_payments.status', 'pending');

            if ($total) {
                return $fees->select(DB::raw('sum(enrollment_payments.amount) as amount'))->first();
            } else {
                return $fees->select(
                    'enrollment_periods.id',
                    'enrollment_periods.type',
                    'enrollment_payments.amount',
                    'enrollment_periods.start_date_of_enrollment',
                    'enrollment_periods.end_date_of_enrollment',
                    'student_profiles.first_name',
                    'student_profiles.student_Id',
                )
                    ->groupBy('student_profiles.id')
                    ->groupBy('enrollment_periods.id')
                    ->groupBy('enrollment_periods.type')
                    ->groupBy('enrollment_payments.amount')
                    ->get();
            }
        } catch (\Exception $e) {
            return [];
        }
    }

    public function address()
    {
        return $this->hasMany('App\Models\Address', 'parent_profile_id', 'id');
    }

    public function transactionsMethod()
    {
        return $this->hasMany('App\Models\TransactionsMethod', 'parent_profile_id', 'id');
    }

    public static function getParentId()
    {
        $id = Auth::user()->id;
        $parentProfileData = User::find($id)->parentProfile()->first();

        return $parentProfileData->id;
    }

    public function transcripts()
    {
        return $this->hasMany('App\Models\Graduation', 'parent_profile_id', 'id');
    }

    public function schoolRecord()
    {
        return $this->hasMany(RecordTransfer::class);
    }

    public function customPayment()
    {
        return $this->hasMany('App\Models\CustomPayment', 'parent_profile_id', 'id');
    }

    public function notarization()
    {
        return $this->hasOne('App\Models\Notarization', 'parent_profile_id', 'id');
    }

    public function notarizationPyaments()
    {
        return $this->hasOne('App\Models\NotarizationPayment', 'parent_profile_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification', 'parent_profile_id', 'id');
    }
}
