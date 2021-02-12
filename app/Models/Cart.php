<?php

namespace App\Models;

use App\Models\EnrollmentPeriods;
use App\Models\FeesInfo;
use App\Models\StudentProfile;
use App\Models\ParentProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_type', 'item_id', 'parent_profile_id',
    ];

    protected $table = 'cart';

    public static function getCartAmount($parent_profile_id, $total = false)
    {
        try {
            if ($total) {
                $enroll_total = Self::getEnrollQuery()->select(DB::raw('sum(enrollment_payments.amount) as amount'))->first();
                $graduation_total = Self::getGraduationQuery()->select(DB::raw('sum(graduations.amount) as amount'))->first();
                
                // had to make it an object to make sure it doesn't break anywhere
                // TODO - remove the amount property and replace it everywhere 
                $total_amount = (object) array();
                $total_amount->amount = $enroll_total->amount + $graduation_total->amount;

                return $total_amount;
            } else {
                $enroll_data = Self::getEnrollData();
                $graduation_data = Self::getGraduationData();

                return self::calculateItemsPerStudent($enroll_data, $graduation_data);
            }
        } catch (\Exception $e) {
            return [];
        }
    }

    public static function isCartValid($parent_profile_id)
    {
        $cart_valid = true;
        $student_ids = $fees = [];

        // get student ids for the parent
        $students = ParentProfile::find($parent_profile_id)->studentProfile()->select('id')->get()->toArray();

        foreach ($students as $key => $student) {
            array_push($student_ids, $student['id']);
        }

        // get the enroll periods currently in the cart
        $cart_item_years = Cart::where('cart.item_type','enrollment_period')
                            ->where('cart.parent_profile_id',$parent_profile_id)
                            ->leftJoin('enrollment_periods','enrollment_periods.id','cart.item_id')
                            ->select('enrollment_periods.start_date_of_enrollment','enrollment_periods.end_date_of_enrollment')
                            ->get()
                            ->toArray();

        // get fee detail for first student
        $fee_info = FeesInfo::whereIN('type', ['first_student_annual', 'first_student_half'])
                            ->select('amount')
                            ->get()
                            ->toArray();

        foreach ($fee_info as $key => $fee) {
            array_push($fees, $fee['amount']);
        }

        // loop through cart years and check if the first student is already enrolled for that year
        for ($i=0; $i < count($cart_item_years); $i++) { 
            $start_date = $cart_item_years[$i]['start_date_of_enrollment'];
            $end_date = $cart_item_years[$i]['end_date_of_enrollment'];

            $check = EnrollmentPeriods::whereIn('student_profile_id',$student_ids)
                                        ->whereDate('enrollment_periods.start_date_of_enrollment','<=',$start_date)
                                        ->whereDate('enrollment_periods.end_date_of_enrollment','>=',$end_date)
                                        ->leftJoin('enrollment_payments','enrollment_payments.id','enrollment_periods.enrollment_payment_id')
                                        ->where('enrollment_payments.status','paid')
                                        ->exists();

            // if there's no student enrolled for that year
            if (! $check) {
                // now check if the first student payment is in the cart
                $cart_valid = Cart::where('cart.item_type','enrollment_period')
                                ->where('cart.parent_profile_id',$parent_profile_id)
                                ->leftJoin('enrollment_payments','enrollment_payments.enrollment_period_id','cart.item_id')
                                ->leftJoin('enrollment_periods','enrollment_periods.id','cart.item_id')
                                ->whereDate('enrollment_periods.start_date_of_enrollment','<=',$start_date)
                                ->whereDate('enrollment_periods.end_date_of_enrollment','>=',$end_date)
                                ->whereIn('enrollment_payments.amount',$fees)
                                ->exists();
                if (! $cart_valid) {
                    break;
                }
            }
        }

        return $cart_valid;
    }

    private static function calculateItemsPerStudent($enroll_data, $graduation_data)
    {
        $data = [];

        foreach ($enroll_data as $key => $value) {
            $type = $value['type'] == 'annual' ? 'Annual' : 'Second Semester Only';
            $arr = [
                'id' => $value['id'],
                'type' => $type,
                'amount' => $value['amount'],
                'start_date' => \Carbon\Carbon::parse($value['start_date_of_enrollment'])->format('d M Y'),
                'end_date' => \Carbon\Carbon::parse($value['end_date_of_enrollment'])->format('d M Y'),
            ];
            if (array_key_exists($value['student_db_id'], $data)) {
                array_push(
                    $data[$value['student_db_id']]['enroll_items'],
                    $arr
                );
            } else {
                $data[$value['student_db_id']] = [
                    'name' => ucfirst($value['first_name']),
                    'enroll_items' => [$arr],
                ];
            }
        }

        foreach ($graduation_data as $k => $val) {
            $arr = [
                'id' => $val['id'],
                'type' => 'Graduation',
                'amount' => $val['amount'],
            ];
            if (array_key_exists($val['student_db_id'], $data)) {
                array_push(
                    $data[$val['student_db_id']]['enroll_items'],
                    $arr
                );
            } else {
                $data[$val['student_db_id']] = [
                    'name' => ucfirst($val['first_name']),
                    'enroll_items' => [$arr],
                ];
            }
        }

        return $data;
    }

    private static function getEnrollQuery()
    {
        return self::where('cart.parent_profile_id', ParentProfile::getParentId())
                    ->where('cart.item_type', 'enrollment_period')
                    ->leftJoin('enrollment_periods', 'enrollment_periods.id', 'cart.item_id')
                    ->leftJoin('student_profiles', 'enrollment_periods.student_profile_id', 'student_profiles.id')
                    ->leftJoin('enrollment_payments', 'enrollment_payments.enrollment_period_id', 'enrollment_periods.id');
    }

    private static function getGraduationQuery()
    {
        return self::where('cart.parent_profile_id', ParentProfile::getParentId())
                ->where('cart.item_type', 'graduation')
                ->leftJoin('graduations', 'graduations.id', 'cart.item_id')
                ->leftJoin('student_profiles', 'graduations.student_profile_id', 'student_profiles.id');
    }

    private static function getEnrollData()
    {
        return Self::getEnrollQuery()->select(
                    'student_profiles.first_name',
                    'student_profiles.student_Id',
                    'student_profiles.id as student_db_id',
                    'enrollment_periods.type',
                    'enrollment_periods.start_date_of_enrollment',
                    'enrollment_periods.end_date_of_enrollment',
                    'cart.id',
                    'enrollment_payments.amount',
                )
                ->groupBy('student_profiles.id')
                ->groupBy('enrollment_periods.type')
                ->groupBy('cart.id')
                ->groupBy('enrollment_payments.amount')
                ->get();
    }

    private static function getGraduationData()
    {
        return Self::getGraduationQuery()->select(
                    'student_profiles.first_name',
                    'student_profiles.student_Id',
                    'student_profiles.id as student_db_id',
                    'cart.id',
                    'graduations.amount',
                )
                ->groupBy('student_profiles.id')
                ->groupBy('cart.id')
                ->groupBy('graduations.amount')
                ->get();
    }

}
