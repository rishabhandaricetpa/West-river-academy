<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_type', 'item_id', 'parent_profile_id'
    ];

    protected $table = "cart";

    public static function getCartAmount($parent_profile_id, $total = false)
    {
        try {
            $enroll_query = Cart::where('cart.parent_profile_id', $parent_profile_id)
                            ->where('cart.item_type', 'enrollment_period')
                            ->leftJoin('enrollment_periods','enrollment_periods.id','cart.item_id')
                            ->leftJoin('student_profiles','enrollment_periods.student_profile_id','student_profiles.id')
                            ->leftJoin('enrollment_payments','enrollment_payments.enrollment_period_id','enrollment_periods.id');
            
            if($total){
                return $enroll_query->select(DB::raw('sum(enrollment_payments.amount) as amount'))->first();
            }else{
                $enroll_data = $enroll_query->select(
                                                'student_profiles.first_name',
                                                'student_profiles.student_Id',
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

                return Self::calculateItemsPerStudent($enroll_data);
            }
        } catch (\Exception $e) {
            return [];
        }
    }

    private static function calculateItemsPerStudent($enroll_data)
    {
        $data = [];

        foreach ($enroll_data as $key => $value) {
            if(array_key_exists($value['student_Id'], $data)){
                array_push(
                    $data[$value['student_Id']]['enroll_items'],
                    [
                        'id' => $value['id'],
                        'type' => $value['type'],
                        'amount' => $value['amount'],
                        'start_date' => $value['start_date_of_enrollment'],
                        'end_date' => $value['end_date_of_enrollment']
                    ]
                );
            }else{
                $data[$value['student_Id']] = [
                    'name' => $value['first_name'],
                    'enroll_items' => [[
                        'id' => $value['id'],
                        'type' => $value['type'],
                        'amount' => $value['amount'],
                        'start_date' => $value['start_date_of_enrollment'],
                        'end_date' => $value['end_date_of_enrollment']
                    ]]
                ];
            }
        }

        return $data;
    }
}
