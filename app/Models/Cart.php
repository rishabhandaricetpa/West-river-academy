<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\FeesInfo;
use App\Models\EnrollmentPeriods;
use App\Models\StudentProfile;

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
            $type =  $value['type'] == 'annual' ? 'Annual' : 'Second Semester Only';
            $arr = [
                'id' => $value['id'],
                'type' => $type,
                'amount' => $value['amount'],
                'start_date' => \Carbon\Carbon::parse($value['start_date_of_enrollment'])->format('d M Y'),
                'end_date' => \Carbon\Carbon::parse($value['end_date_of_enrollment'])->format('d M Y')
            ];
            if(array_key_exists($value['student_db_id'], $data)){
                array_push(
                    $data[$value['student_db_id']]['enroll_items'],
                    $arr
                );
            }else{
                $data[$value['student_db_id']] = [
                    'name' => ucfirst($value['first_name']),
                    'enroll_items' => [$arr]
                ];
            }
        }

        return $data;
    }

    public static function isCartValid($parent_profile_id)
    {
        $cart_valid = true;
        $student_ids = $fees = [];
        
        // get student ids for the parent
        $students = ParentProfile::find($parent_profile_id)->studentProfile()->select('id')->get()->toArray();

        foreach ($students as $key => $student) {
            array_push($student_ids,$student['id']);
        }

        // get the enroll period years currently in the cart
        $cart_item_years = Cart::where('cart.item_type','enrollment_period')
                            ->where('cart.parent_profile_id',$parent_profile_id)
                            ->leftJoin('enrollment_periods','enrollment_periods.id','cart.item_id')
                            ->select(DB::raw('YEAR(enrollment_periods.start_date_of_enrollment) as enroll_year'))
                            ->groupBy('enroll_year')
                            ->get()
                            ->toArray();

        // get fee detail for first student
        $fee_info = FeesInfo::whereIN('type',['first_student_annual','first_student_half'])
                            ->select('amount')
                            ->get()
                            ->toArray();

        foreach ($fee_info as $key => $fee) {
            array_push($fees,$fee['amount']);
        }

        // loop through cart years and check if the first student is already enrolled for that year
        for ($i=0; $i < count($cart_item_years); $i++) { 
            $year = $cart_item_years[$i]['enroll_year'];
            $check = EnrollmentPeriods::whereIn('student_profile_id',$student_ids)
                                        ->whereYear('start_date_of_enrollment',$year)
                                        ->leftJoin('enrollment_payments','enrollment_payments.id','enrollment_periods.enrollment_payment_id')
                                        ->where('enrollment_payments.status','paid')
                                        ->exists();
            
            // if there's no student enrolled for that year
            if(!$check){ 
                // now check if the first student payment is in the cart
                $cart_valid = Cart::where('cart.item_type','enrollment_period')
                                ->where('cart.parent_profile_id',$parent_profile_id)
                                ->leftJoin('enrollment_payments','enrollment_payments.enrollment_period_id','cart.item_id')
                                ->leftJoin('enrollment_periods','enrollment_periods.id','cart.item_id')
                                ->whereYear('enrollment_periods.start_date_of_enrollment',$year)
                                ->whereIn('enrollment_payments.amount',$fees)
                                ->exists();
                if(!$cart_valid){
                    break;
                }
            }
        }
                        
        return $cart_valid;
    }
}
