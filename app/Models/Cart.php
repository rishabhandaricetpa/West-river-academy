<?php

namespace App\Models;

use App\Models\EnrollmentPayment;
use App\Models\EnrollmentPeriods;
use App\Models\FeesInfo;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_type', 'item_id', 'parent_profile_id', 'student_profile_id'
    ];

    protected $table = 'cart';

    public static function getCartAmount($parent_profile_id, $total = false)
    {
        try {
            if ($total) {
                // GO AFTER CART i.e in address
                $enroll_total = Self::getEnrollQuery($parent_profile_id)->select(DB::raw('sum(enrollment_payments.amount) as amount'))->first();
                $graduation_total = Self::getGraduationQuery($parent_profile_id)->select(DB::raw('sum(graduation_payments.amount) as amount'))->first();
                $transcript_total = Self::getTranscriptQuery($parent_profile_id)->select(DB::raw('sum(transcript_payments.amount) as amount'))->first();
                $custom_total = Self::getCustomQuery($parent_profile_id)->select(DB::raw('sum(custom_payments.amount) as amount'))->first();
                $transcript_edit_total = Self::getEditTranscriptQuery($parent_profile_id)->select(DB::raw('sum(transcript_payments.amount) as amount'))->first();
                $postage_total = Self::getPostageQuery($parent_profile_id)->select(DB::raw('sum(order_postages.amount) as amount'))->first();
                $notarization_total = Self::getNotarizationQuery($parent_profile_id)->select(DB::raw('sum(notarization_payments.amount) as amount'))->first();
                $apostille_total = Self::getApostilleQuery($parent_profile_id)->select(DB::raw('sum(notarization_payments.amount) as amount'))->first();
                $custom_letter_total = Self::getCustomLetterQuery($parent_profile_id)->select(DB::raw('sum(custom_letter_payments.amount) as amount'))->first();
                $consultation_total = Self::getConsultationQuery($parent_profile_id)->select(DB::raw('sum(order_personal_consultations.amount) as amount'))->first();
                // had to make it an object to make sure it doesn't break anywhere
                // TODO - remove the amount property and replace it everywhere 
                $total_amount = (object) array();
                $total_amount->amount = $enroll_total->amount + $graduation_total->amount + $transcript_total->amount + $custom_total->amount + $transcript_edit_total->amount + $postage_total->amount + $notarization_total->amount + $custom_letter_total->amount + $consultation_total->amount + $apostille_total->amount;
                return $total_amount;
            } else {
                // in cart
                $enroll_data = Self::getEnrollData($parent_profile_id);
                $graduation_data = Self::getGraduationData($parent_profile_id);
                $transcript_data = Self::getTranscriptData($parent_profile_id);
                $custom_data = Self::getcustomData($parent_profile_id);
                $transcript_edit_data =  Self::getEditTranscriptData($parent_profile_id);
                $postage_data = Self::getPostageData($parent_profile_id);
                $notarization_data = Self::getNotarizationData($parent_profile_id);
                $apostille_data = Self::getApostilleData($parent_profile_id);
                $custom_letter_data = Self::getcustomLetterData($parent_profile_id);
                $consultation_data = Self::getConsultationData($parent_profile_id);

                return self::calculateItemsPerStudent($enroll_data, $graduation_data, $transcript_data, $custom_data, $transcript_edit_data, $postage_data, $notarization_data, $custom_letter_data, $consultation_data, $apostille_data);
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
        $cart_item_years = self::where('cart.item_type', 'enrollment_period')
            ->where('cart.parent_profile_id', $parent_profile_id)
            ->leftJoin('enrollment_periods', 'enrollment_periods.id', 'cart.item_id')
            ->select('enrollment_periods.start_date_of_enrollment', 'enrollment_periods.end_date_of_enrollment')
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
        for ($i = 0; $i < count($cart_item_years); $i++) {
            $start_date = $cart_item_years[$i]['start_date_of_enrollment'];
            $end_date = $cart_item_years[$i]['end_date_of_enrollment'];

            $check = EnrollmentPeriods::whereIn('student_profile_id', $student_ids)
                ->whereDate('enrollment_periods.start_date_of_enrollment', '<=', $start_date)
                ->whereDate('enrollment_periods.end_date_of_enrollment', '>=', $end_date)
                ->leftJoin('enrollment_payments', 'enrollment_payments.id', 'enrollment_periods.enrollment_payment_id')
                ->where('enrollment_payments.status', 'paid')
                ->exists();

            // if there's no student enrolled for that year
            if (!$check) {
                // now check if the first student payment is in the cart
                $cart_valid = self::where('cart.item_type', 'enrollment_period')
                    ->where('cart.parent_profile_id', $parent_profile_id)
                    ->leftJoin('enrollment_payments', 'enrollment_payments.enrollment_period_id', 'cart.item_id')
                    ->leftJoin('enrollment_periods', 'enrollment_periods.id', 'cart.item_id')
                    ->whereDate('enrollment_periods.start_date_of_enrollment', '<=', $start_date)
                    ->whereDate('enrollment_periods.end_date_of_enrollment', '>=', $end_date)
                    ->whereIn('enrollment_payments.amount', $fees)
                    ->exists();
                if (!$cart_valid) {
                    break;
                }
            }
        }

        return $cart_valid;
    }

    private static function calculateItemsPerStudent($enroll_data, $graduation_data, $transcript_data, $custom_data, $transcript_edit_data, $postage_data, $notarization_data, $custom_letter_data, $consultation_data, $apostille_data)
    {
        $data = [];

        foreach ($enroll_data as $key => $value) {
            $type = $value['type'] == 'annual' ? 'Annual Enrollment' : 'Second Semester Only';
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
                    'name' => ucfirst($value['first_name'])  . ' ' . ucfirst($value['last_name']),
                    'enroll_items' => [$arr],
                ];
            }
        }

        foreach ($graduation_data as $k => $val) {
            if ($val['apostille_country'] !== null && !empty($val['apostille_country'])) {
                $type = 'Graduation (with Apostille Package)';
            } else {
                $type = 'Graduation';
            }
            $arr = [
                'id' => $val['id'],
                'type' => $type,
                'amount' => $val['amount'],
            ];
            if (array_key_exists($val['student_db_id'], $data)) {
                array_push(
                    $data[$val['student_db_id']]['enroll_items'],
                    $arr
                );
            } else {
                $data[$val['student_db_id']] = [
                    'name' => ucfirst($val['first_name']) . ' ' . ucfirst($val['last_name']),
                    'enroll_items' => [$arr],
                ];
            }
        }
        foreach ($transcript_data as $key => $val) {
            $type = 'Transcript';

            $arr = [
                'id' => $val['id'],
                'type' => $type,
                'amount' => $val['amount'],
            ];
            if (array_key_exists($val['student_db_id'], $data)) {
                array_push(
                    $data[$val['student_db_id']]['enroll_items'],
                    $arr
                );
            } else {
                $data[$val['student_db_id']] = [
                    'name' => ucfirst($val['first_name']) . ' ' . ucfirst($val['last_name']),
                    'enroll_items' => [$arr],
                ];
            }
        }

        foreach ($custom_data as $key => $val) {
            $type = 'Custom Payment';

            $arr = [
                'id' => $val['id'],
                'type' => $type,
                'amount' => $val['amount'],
            ];
            if (array_key_exists($val['parent_db_id'], $data)) {
                array_push(
                    $data[$val['parent_db_id']]['enroll_items'],
                    $arr
                );
            } else {
                $data[$val['parent_db_id']] = [
                    'name' => ucfirst($val['p1_first_name']) . ' ' . ucfirst($val['p1_last_name']),
                    'enroll_items' => [$arr],
                ];
            }
        }
        foreach ($transcript_edit_data as $key => $val) {
            $type = 'Transcript Edit';

            $arr = [
                'id' => $val['id'],
                'type' => $type,
                'amount' => $val['amount'],
            ];
            if (array_key_exists($val['student_db_id'], $data)) {
                array_push(
                    $data[$val['student_db_id']]['enroll_items'],
                    $arr
                );
            } else {
                $data[$val['student_db_id']] = [
                    'name' => ucfirst($val['first_name']) . ' ' . ucfirst($val['last_name']),
                    'enroll_items' => [$arr],
                ];
            }
        }
        foreach ($postage_data as $key => $val) {
            $type = 'Order Postage';

            $arr = [
                'id' => $val['id'],
                'type' => $type,
                'amount' => $val['amount'],
            ];
            if (array_key_exists($val['parent_db_id'], $data)) {
                array_push(
                    $data[$val['parent_db_id']]['enroll_items'],
                    $arr
                );
            } else {
                $data[$val['parent_db_id']] = [
                    'name' => ucfirst($val['p1_first_name']) . ' ' . ucfirst($val['p1_last_name']),
                    'enroll_items' => [$arr],
                ];
            }
        }
        foreach ($notarization_data as $key => $val) {
            $type = 'Notarization Payment';
            $arr = [
                'id' => $val['id'],
                'type' => $type,
                'amount' => $val['amount'],
            ];
            if (array_key_exists($val['parent_db_id'], $data)) {
                array_push(
                    $data[$val['parent_db_id']]['enroll_items'],
                    $arr
                );
            } else {
                $data[$val['parent_db_id']] = [
                    'name' => ucfirst($val['first_name']) . ' ' . ucfirst($val['last_name']),
                    'enroll_items' => [$arr],
                ];
            }
        }
        foreach ($apostille_data as $key => $val) {
            $type = 'Apostille Payment';
            $arr = [
                'id' => $val['id'],
                'type' => $type,
                'amount' => $val['amount'],
            ];
            if (array_key_exists($val['parent_db_id'], $data)) {
                array_push(
                    $data[$val['parent_db_id']]['enroll_items'],
                    $arr
                );
            } else {
                $data[$val['parent_db_id']] = [
                    'name' => ucfirst($val['first_name']) . ' ' . ucfirst($val['last_name']),
                    'enroll_items' => [$arr],
                ];
            }
        }
        foreach ($custom_letter_data as $key => $val) {
            $type = 'Custom Letter Payment';

            $arr = [
                'id' => $val['id'],
                'type' => $type,
                'amount' => $val['amount'],
            ];
            if (array_key_exists($val['parent_db_id'], $data)) {
                array_push(
                    $data[$val['parent_db_id']]['enroll_items'],
                    $arr
                );
            } else {
                $data[$val['parent_db_id']] = [
                    'name' => ucfirst($val['p1_first_name']) . ' ' . ucfirst($val['p1_last_name']),
                    'enroll_items' => [$arr],
                ];
            }
        }
        foreach ($consultation_data as $key => $val) {
            $type = 'Personal Consultation Fees';

            $arr = [
                'id' => $val['id'],
                'type' => $type,
                'amount' => $val['amount'],
            ];
            if (array_key_exists($val['parent_db_id'], $data)) {
                array_push(
                    $data[$val['parent_db_id']]['enroll_items'],
                    $arr
                );
            } else {
                $data[$val['parent_db_id']] = [
                    'name' => ucfirst($val['p1_first_name']) . ' ' . ucfirst($val['p1_last_name']),
                    'enroll_items' => [$arr],
                ];
            }
        }
        return $data;
    }

    private static function getEnrollQuery($parent_profile_id)
    {
        return self::where('cart.parent_profile_id', $parent_profile_id)
            ->where('cart.item_type', 'enrollment_period')
            ->leftJoin('enrollment_periods', 'enrollment_periods.id', 'cart.item_id')
            ->leftJoin('student_profiles', 'enrollment_periods.student_profile_id', 'student_profiles.id')
            ->leftJoin('enrollment_payments', 'enrollment_payments.enrollment_period_id', 'enrollment_periods.id');
    }

    private static function getGraduationQuery($parent_profile_id)
    {
        return self::where('cart.parent_profile_id', $parent_profile_id)
            ->where('cart.item_type', 'graduation')
            ->leftJoin('graduations', 'graduations.id', 'cart.item_id')
            ->leftJoin('graduation_payments', 'cart.item_id', 'graduation_payments.graduation_id')
            ->leftJoin('student_profiles', 'graduations.student_profile_id', 'student_profiles.id');
    }

    private static function getTranscriptQuery($parent_profile_id)
    {
        return self::where('cart.parent_profile_id', $parent_profile_id)
            ->where('cart.item_type', 'transcript')
            ->leftJoin('transcripts', 'transcripts.id', 'cart.item_id')
            ->leftJoin('transcript_payments', 'cart.item_id', 'transcript_payments.transcript_id')
            ->leftJoin('student_profiles', 'transcripts.student_profile_id', 'student_profiles.id');
    }

    private static function getCustomQuery($parent_profile_id)
    {
        return self::where('cart.parent_profile_id', $parent_profile_id)
            ->where('cart.item_type', 'custom')
            ->leftJoin('custom_payments', 'cart.item_id', 'custom_payments.parent_profile_id')->whereNull('transcation_id')->where('custom_payments.status', 'pending')
            ->leftJoin('parent_profiles', 'custom_payments.parent_profile_id', 'parent_profiles.id');
    }

    private static function getEditTranscriptQuery($parent_profile_id)
    {
        return self::where('cart.parent_profile_id', $parent_profile_id)
            ->where('cart.item_type', 'transcript_edit')
            ->leftJoin('transcripts', 'transcripts.id', 'cart.item_id')
            ->leftJoin('transcript_payments', 'cart.item_id', 'transcript_payments.transcript_id')
            ->leftJoin('student_profiles', 'transcripts.student_profile_id', 'student_profiles.id');
    }

    private static function getPostageQuery($parent_profile_id)
    {
        return self::where('cart.parent_profile_id', $parent_profile_id)
            ->where('cart.item_type', 'postage')
            ->leftJoin('order_postages', 'cart.item_id', 'order_postages.parent_profile_id')->whereNull('transcation_id')->where('order_postages.status', 'pending')
            ->leftJoin('parent_profiles', 'order_postages.parent_profile_id', 'parent_profiles.id');
    }
    private static function getNotarizationQuery($parent_profile_id)
    {
        return self::where('cart.parent_profile_id', $parent_profile_id)
            ->where('cart.item_type', 'notarization')
            ->leftJoin('notarizations', 'notarizations.id', 'cart.item_id')
            ->leftJoin('notarization_payments', 'cart.item_id', 'notarization_payments.notarization_id')->where('notarization_payments.status', 'pending')
            ->leftJoin('parent_profiles', 'notarizations.parent_profile_id', 'parent_profiles.id');
    }
    private static function getApostilleQuery($parent_profile_id)
    {
        return self::where('cart.parent_profile_id', $parent_profile_id)
            ->where('cart.item_type', 'apostille')
            ->leftJoin('apostilles', 'apostilles.id', 'cart.item_id')
            ->leftJoin('notarization_payments', 'cart.item_id', 'notarization_payments.apostille_id')->where('notarization_payments.status', 'pending')
            ->leftJoin('parent_profiles', 'apostilles.parent_profile_id', 'parent_profiles.id');
    }
    private static function getCustomLetterQuery($parent_profile_id)
    {
        return self::where('cart.parent_profile_id', $parent_profile_id)
            ->where('cart.item_type', 'custom_letter')
            ->leftJoin('custom_letter_payments', 'cart.item_id', 'custom_letter_payments.parent_profile_id')->whereNull('transcation_id')->where('custom_letter_payments.status', 'pending')
            ->leftJoin('parent_profiles', 'custom_letter_payments.parent_profile_id', 'parent_profiles.id');
    }
    private static function getConsultationQuery($parent_profile_id)
    {
        return self::where('cart.parent_profile_id', $parent_profile_id)
            ->where('cart.item_type', 'order_consultation')
            ->leftJoin('order_personal_consultations', 'cart.item_id', 'order_personal_consultations.parent_profile_id')->where('order_personal_consultations.status', 'pending')
            ->leftJoin('parent_profiles', 'order_personal_consultations.parent_profile_id', 'parent_profiles.id');
    }
    private static function getEnrollData($parent_profile_id)
    {
        return self::getEnrollQuery($parent_profile_id)->select(
            'student_profiles.first_name',
            'student_profiles.last_name',
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

    private static function getGraduationData($parent_profile_id)
    {
        return self::getGraduationQuery($parent_profile_id)->select(
            'student_profiles.first_name',
            'student_profiles.last_name',
            'student_profiles.student_Id',
            'student_profiles.id as student_db_id',
            'cart.id',
            'graduation_payments.amount',
            'graduations.apostille_country',
        )
            ->groupBy('student_profiles.id')
            ->groupBy('cart.id')
            ->groupBy('graduation_payments.amount')
            ->get();
    }

    private static function getTranscriptData($parent_profile_id)
    {
        return self::getTranscriptQuery($parent_profile_id)->select(
            'student_profiles.first_name',
            'student_profiles.last_name',
            'student_profiles.last_name',
            'student_profiles.student_Id',
            'student_profiles.id as student_db_id',
            'cart.id',
            'transcript_payments.amount',
        )
            ->groupBy('student_profiles.id')
            ->groupBy('cart.id')
            ->groupBy('transcript_payments.amount')
            ->get();
    }

    private static function getCustomData($parent_profile_id)
    {
        return self::getCustomQuery($parent_profile_id)->select(
            'parent_profiles.p1_first_name',
            'parent_profiles.p1_last_name',
            'parent_profiles.id as parent_db_id',
            'cart.id',
            'custom_payments.amount',
        )
            ->groupBy('parent_profiles.id')
            ->groupBy('cart.id')
            ->groupBy('custom_payments.amount')
            ->get();
    }

    private static function getEditTranscriptData($parent_profile_id)
    {
        return self::getEditTranscriptQuery($parent_profile_id)->select(
            'student_profiles.first_name',
            'student_profiles.last_name',
            'student_profiles.student_Id',
            'student_profiles.id as student_db_id',
            'cart.id',
            'transcript_payments.amount',
        )
            ->groupBy('student_profiles.id')
            ->groupBy('cart.id')
            ->groupBy('transcript_payments.amount')
            ->get();
    }

    private static function getPostageData($parent_profile_id)
    {
        return self::getPostageQuery($parent_profile_id)->select(
            'parent_profiles.p1_first_name',
            'parent_profiles.p1_last_name',
            'parent_profiles.id as parent_db_id',
            'cart.id',
            'order_postages.amount',
        )
            ->groupBy('parent_profiles.id')
            ->groupBy('cart.id')
            ->groupBy('order_postages.amount')
            ->get();
    }

    private static function getNotarizationData($parent_profile_id)
    {
        return Self::getNotarizationQuery($parent_profile_id)->select(
            'parent_profiles.p1_first_name',
            'parent_profiles.p1_last_name',
            'parent_profiles.id as parent_db_id',
            'cart.id',
            'notarization_payments.amount',
        )
            ->groupBy('parent_profiles.id')
            ->groupBy('cart.id')
            ->groupBy('notarization_payments.amount')
            ->get();
    }
    private static function getApostilleData($parent_profile_id)
    {
        return Self::getApostilleQuery($parent_profile_id)->select(
            'parent_profiles.p1_first_name',
            'parent_profiles.p1_last_name',
            'parent_profiles.id as parent_db_id',
            'cart.id',
            'notarization_payments.amount',
        )
            ->groupBy('parent_profiles.id')
            ->groupBy('cart.id')
            ->groupBy('notarization_payments.amount')
            ->get();
    }
    private static function getcustomLetterData($parent_profile_id)
    {
        return self::getCustomLetterQuery($parent_profile_id)->select(
            'parent_profiles.p1_first_name',
            'parent_profiles.p1_last_name',
            'parent_profiles.id as parent_db_id',
            'cart.id',
            'custom_letter_payments.amount',
        )
            ->groupBy('parent_profiles.id')
            ->groupBy('cart.id')
            ->groupBy('custom_letter_payments.amount')
            ->get();
    }

    private static function getConsultationData($parent_profile_id)
    {
        return self::getConsultationQuery($parent_profile_id)->select(
            'parent_profiles.p1_first_name',
            'parent_profiles.p1_last_name',
            'parent_profiles.id as parent_db_id',
            'cart.id',
            'order_personal_consultations.amount',
        )
            ->groupBy('parent_profiles.id')
            ->groupBy('cart.id')
            ->groupBy('order_personal_consultations.amount')
            ->get();
    }
    public static function emptyCartAfterPayment($type, $status, $payment_id = null)
    {
        $parent_profile_id = ParentProfile::getParentId();
        $parentName = ParentProfile::whereId($parent_profile_id)->first();
        $cartItems = self::select()->where('parent_profile_id', $parent_profile_id)->get();
        foreach ($cartItems as $cart) {
            switch ($cart->item_type) {
                case 'enrollment_period':
                    $enrollemtpayment = EnrollmentPayment::select()->where('enrollment_period_id', $cart->item_id)->first();
                    $enrollment_period = EnrollmentPeriods::where('id', $cart->item_id)->first();
                    $student = StudentProfile::where('id', $enrollment_period->student_profile_id)->first();
                    $enrollemtpayment->status = $status;
                    $enrollemtpayment->payment_mode = $type;
                    if ($payment_id != null) {
                        $enrollemtpayment->transcation_id = $payment_id;
                    }
                    $enrollemtpayment->save();
                    $confirmationstatus = EnrollmentPayment::select()->where('enrollment_period_id', $cart->item_id)->first();
                    $confirmlink = ConfirmationLetter::select()->where('enrollment_period_id', $cart->item_id)->first();
                    if ($confirmlink != null) {
                        $confirmlink->status = $status;
                    }
                    $confirmlink->save();

                    Dashboard::create([
                        'parent_profile_id' =>  $parent_profile_id,
                        'amount' => $enrollemtpayment->amount,
                        'student_profile_id' => $enrollment_period->student_profile_id,
                        'transaction_id' => $enrollemtpayment->transcation_id,
                        'linked_to' => $student->first_name,
                        'item_type_id' => $enrollment_period->id,
                        'related_to' => 'Student Enrolled',
                        'created_date' => \Carbon\Carbon::now()->format('M d Y'),
                    ]);

                    break;

                case 'graduation':
                    $graduation_payment = GraduationPayment::where('graduation_id', $cart->item_id)->first();
                    $graduate = Graduation::where('id', $graduation_payment->graduation_id)->first();
                    $student = StudentProfile::where('id', $graduate->student_profile_id)->first();
                    if ($graduation_payment) {
                        $graduation_payment->payment_mode = $type;
                        if ($payment_id != null) {
                            $graduation_payment->transcation_id = $payment_id;
                        }
                        $graduation_payment->save();

                        $graduation = Graduation::whereId($cart->item_id)->first();
                        $graduation->status = 'paid';
                        $graduation->save();
                        Dashboard::create([
                            'parent_profile_id' => ParentProfile::getParentId(),
                            'amount' => $graduation_payment->amount,
                            'linked_to' =>  $student->first_name,
                            'transaction_id' => $graduation_payment->transcation_id,
                            'related_to' => 'Graduation Order',
                            'created_date' => \Carbon\Carbon::now()->format('M d Y'),
                        ]);
                    }
                    break;
                case 'transcript':
                    $transcript_payment = TranscriptPayment::where('transcript_id', $cart->item_id)->get();
                    $transcript = Transcript::where('id', $cart->item_id)->first();
                    $student = StudentProfile::where('id', $transcript->student_profile_id)->first();
                    foreach ($transcript_payment as $ts_payment) {
                        $ts_payment->payment_mode = $type;
                        if ($payment_id != null) {
                            $ts_payment->transcation_id = $payment_id;
                            $ts_payment->status = $status;
                        }
                        $ts_payment->save();
                        Dashboard::create([
                            'parent_profile_id' => ParentProfile::getParentId(),
                            'amount' => $ts_payment->amount,
                            'linked_to' =>  $student->first_name,
                            'item_type_id' => $ts_payment->id,
                            'transaction_id' => $ts_payment->transcation_id,
                            'related_to' => 'Transcript Ordered',
                            'created_date' => \Carbon\Carbon::now()->format('M d Y'),
                        ]);
                    }


                    $transcripts = Transcript::whereId($cart->item_id)->get();

                    foreach ($transcripts as $transcript) {
                        $transcript->status = $status;
                        $transcript->save();
                    }
                    break;

                case 'custom':
                    $custom_payment = CustomPayment::where('parent_profile_id', $cart->item_id)->where('status', 'pending')->first();
                    if ($custom_payment) {
                        $custom_payment->payment_mode = $type;
                        if ($payment_id != null) {
                            $custom_payment->transcation_id = $payment_id;
                            $custom_payment->status = $status;
                        } else {
                            $custom_payment->status = 'active';
                        }
                        $custom_payment->save();
                    }

                    Dashboard::create([
                        'parent_profile_id' => ParentProfile::getParentId(),
                        'amount' => $custom_payment->amount,
                        'linked_to' => $parentName->p1_first_name,
                        'related_to' => 'Custom Payment Ordered',
                        'item_type_id' => $custom_payment->id,
                        'transaction_id' => $custom_payment->transcation_id,
                        'created_date' => \Carbon\Carbon::now()->format('M d Y'),
                    ]);
                    break;

                case 'transcript_edit':
                    $transcript_payment = TranscriptPayment::where('transcript_id', $cart->item_id)->first();
                    $transcript = Transcript::where('id', $cart->item_id)->first();
                    $student = StudentProfile::where('id', $transcript->student_profile_id)->first();
                    if ($transcript_payment) {
                        $transcript_payment->payment_mode = $type;
                        if ($payment_id != null) {
                            $transcript_payment->transcation_id = $payment_id;
                            $transcript_payment->status = $status;
                        } else {
                            $transcript_payment->status = 'active';
                        }
                        $transcript_payment->save();
                    }
                    $transcript = Transcript::whereId($cart->item_id)->first();
                    $transcript->status = 'canEdit';
                    $transcript->save();
                    Dashboard::create([
                        'parent_profile_id' => ParentProfile::getParentId(),
                        'amount' => $transcript_payment->amount,
                        'linked_to' =>  $student->first_name,
                        'item_type_id' => $transcript_payment->id,
                        'related_to' => 'Transcript Edit Ordered',
                        'transaction_id' => $transcript_payment->transcation_id,
                        'created_date' => \Carbon\Carbon::now()->format('M d Y'),
                    ]);

                    break;
                case 'postage':
                    $postage_payment = OrderPostage::where('parent_profile_id', $cart->item_id)->where('status', 'pending')->first();
                    if ($postage_payment) {
                        $postage_payment->payment_mode = $type;
                        if ($payment_id != null) {
                            $postage_payment->transcation_id = $payment_id;
                            $postage_payment->status = $status;
                        } else {
                            $postage_payment->status = $status;
                        }
                        $postage_payment->save();
                    }

                    Dashboard::create([
                        'parent_profile_id' => ParentProfile::getParentId(),
                        'amount' => $postage_payment->amount,
                        'linked_to' => $parentName->p1_first_name,
                        'related_to' => 'Postage Ordered',
                        'item_type_id' => $postage_payment->id,
                        'transaction_id' => $postage_payment->transcation_id,
                        'created_date' => \Carbon\Carbon::now()->format('M d Y'),
                    ]);
                    break;
                case 'notarization':
                    $notarization_payment =  NotarizationPayment::where('notarization_id', $cart->item_id)->where('pay_for', 'notarization')->first();
                    if ($notarization_payment) {
                        $notarization_payment->payment_mode = $type;
                    }
                    if ($payment_id != null) {
                        $notarization_payment->transcation_id = $payment_id;
                        $notarization_payment->status = $status;
                    } else {
                        $notarization_payment->status = $status;
                    }
                    $notarization_payment->save();
                    $notarization = Notarization::whereId($notarization_payment->notarization_id)->first();
                    $notarization->status = $status;
                    $notarization->save();
                    Dashboard::create([
                        'parent_profile_id' => ParentProfile::getParentId(),
                        'amount' => $notarization_payment->amount,
                        'linked_to' =>  $parentName->p1_first_name,
                        'related_to' => 'Notarization/Appostile Ordered',
                        'item_type_id' => $notarization_payment->id,
                        'transaction_id' => $notarization_payment->transcation_id,
                        'created_date' => \Carbon\Carbon::now()->format('M d Y'),
                    ]);

                    break;
                case 'apostille':
                    $apostille_payment =  NotarizationPayment::where('apostille_id', $cart->item_id)->where('pay_for', 'apostille')->first();
                    if ($apostille_payment) {
                        $apostille_payment->payment_mode = $type;
                    }
                    if ($payment_id != null) {
                        $apostille_payment->transcation_id = $payment_id;
                        $apostille_payment->status = $status;
                    } else {
                        $apostille_payment->status = $status;
                    }
                    $apostille_payment->save();
                    $apostille = Apostille::whereId($apostille_payment->apostille_id)->first();
                    $apostille->status = $status;
                    $apostille->save();
                    // Dashboard::create([
                    //     'parent_profile_id' => ParentProfile::getParentId(),
                    //     'amount' => $apostille_payment->amount,
                    //     'linked_to' =>  $cart->item_id,
                    //     'related_to' => 'appostile_record_received',
                    //     'created_date' => \Carbon\Carbon::now()->format('M d Y'),
                    // ]);
                    Dashboard::create([
                        'parent_profile_id' => ParentProfile::getParentId(),
                        'amount' => $apostille_payment->amount,
                        'linked_to' =>  $parentName->p1_first_name,
                        'related_to' => 'Notarization/Appostile Ordered',
                        'item_type_id' => $apostille_payment->id,
                        'transaction_id' => $apostille_payment->transcation_id,
                        'created_date' => \Carbon\Carbon::now()->format('M d Y'),
                    ]);
                    break;
                case 'custom_letter':
                    $customletter_payment = CustomLetterPayment::where('parent_profile_id', $cart->item_id)->where('status', 'pending')->first();
                    if ($customletter_payment) {
                        $customletter_payment->payment_mode = $type;
                        if ($payment_id != null) {
                            $customletter_payment->transcation_id = $payment_id;
                            $customletter_payment->status = $status;
                        } else {
                            $customletter_payment->status = $status;
                        }
                        $customletter_payment->save();
                    }
                    Dashboard::create([
                        'parent_profile_id' => ParentProfile::getParentId(),
                        'amount' => $customletter_payment->amount,
                        'linked_to' =>  $parentName->p1_first_name,
                        'related_to' => 'Custom Letter',
                        'transaction_id' => $customletter_payment->transcation_id,
                        'item_type_id' => $customletter_payment->id,
                        'created_date' => \Carbon\Carbon::now()->format('M d Y'),
                    ]);
                    break;
                case 'order_consultation':
                    $consultation_payment = OrderPersonalConsultation::where('parent_profile_id', $cart->item_id)->where('status', 'pending')->first();
                    if ($consultation_payment) {
                        $consultation_payment->payment_mode = $type;
                        if ($payment_id != null) {
                            $consultation_payment->transcation_id = $payment_id;
                            $consultation_payment->status = $status;
                        } else {
                            $consultation_payment->status = $status;
                        }
                        $consultation_payment->save();
                    }
                    Dashboard::create([
                        'parent_profile_id' => ParentProfile::getParentId(),
                        'amount' => $consultation_payment->amount,
                        'linked_to' => $consultation_payment->id,
                        'related_to' => 'Personal Consulatation Ordered',
                        'item_type_id' => $consultation_payment->id,
                        'created_date' => \Carbon\Carbon::now()->format('M d Y'),
                    ]);
                    break;
                default:
                    break;
            }
        }

        $refreshCart = self::select()->where('parent_profile_id', $parent_profile_id)->get();
        $refreshCart->each->delete();
    }
}
