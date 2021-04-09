<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CustomPayment;
use App\Models\FeesInfo;
use App\Models\Graduation;
use App\Models\GraduationMailingAddress;
use App\Models\GraduationPayment;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\TranscriptK8;
use App\Models\TranscriptPayment;
use App\Models\User;
use App\Models\OrderPostage;
use App\Models\NotarizationPayment;
use App\Models\CustomLetterPayment;
use App\Models\Notarization;
use App\Models\OrderPersonalConsultation;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    private $parent_profile_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $Userid = auth()->user()->id;
            $parentProfileData = User::find($Userid)->parentProfile()->first();
            $this->parent_profile_id = $parentProfileData->id;

            return $next($request);
        });
    }

    public function index()
    {
        $enroll_fees = Cart::getCartAmount($this->parent_profile_id);

        return view('cart', compact('enroll_fees'));
    }

    public function store(Request $request)
    {
        // dd($request);
        try {
            DB::beginTransaction();
            $data = $request->all();

            switch ($data['type']) {
                case 'enrollment_period':
                    if (!isset($data['eps'])) {
                        return redirect()->back()->with([
                            'message' => 'Please select atleast one Student!',
                            'alert-type' => 'error',
                        ]);
                    }

                    for ($i = 0; $i < count($data['eps']); $i++) {
                        $item_id = $data['eps'][$i];
                        if (!Cart::where('item_id', $item_id)->where('item_type', 'enrollment_period')->exists()) {
                            Cart::create([
                                'item_type' => 'enrollment_period',
                                'item_id' => $item_id,
                                'parent_profile_id' => $this->parent_profile_id,
                            ]);
                        }
                    }
                    break;

                case 'graduation':
                    $parent_profile_id = ParentProfile::getParentId();

                    $student = StudentProfile::whereId($data['student_id'])
                        ->where('parent_profile_id', $parent_profile_id)
                        ->with('graduation')
                        ->first();

                    if ($student) {
                        GraduationMailingAddress::create([
                            'graduation_id' => $student->graduation->id,
                            'name' => $data['name'],
                            'street' => $data['street'],
                            'city' => $data['city'],
                            'country' => $data['country'],
                            'postal_code' => $data['postal_code'],
                        ]);

                        if (isset($data['apostille_country']) && !empty($data['apostille_country'])) {
                            // change graduation fee amount based on Apostille
                            $amount = FeesInfo::getFeeAmount('apostille') + FeesInfo::getFeeAmount('graduation');
                        } else {
                            $amount = FeesInfo::getFeeAmount('graduation');
                        }

                        Graduation::whereId($student->graduation->id)->update(['apostille_country' => $data['apostille_country']]);
                        GraduationPayment::where('graduation_id', $student->graduation->id)->update(['amount' => $amount]);

                        if (!Cart::where('item_id', $student->graduation->id)->where('item_type', 'graduation')->exists()) {
                            Cart::create([
                                'item_type' => 'graduation',
                                'item_id' => $student->graduation->id,
                                'parent_profile_id' => $parent_profile_id,
                            ]);
                        }
                    } else {
                        return redirect()->back()->with([
                            'message' => 'Invalid data entered!',
                            'alert-type' => 'error',
                        ]);
                    }
                    break;
                case 'transcript':
                    $parent_profile_id = ParentProfile::getParentId();
                    $student = StudentProfile::whereId($data['student_id'])
                        ->where('parent_profile_id', $parent_profile_id)
                        ->with('transcript')
                        ->first();
                    $amount = FeesInfo::getFeeAmount('transcript');
                    if (!Cart::where('item_id', $request->get('transcript_id'))->where('item_type', 'transcript')->exists()) {
                        Cart::create([
                            'item_type' => 'transcript',
                            'item_id' => $request->get('transcript_id'),
                            'parent_profile_id' => $parent_profile_id,
                        ]);
                    }
                    break;
                case 'custom':
                    $clearpendingPayments = CustomPayment::where('status', 'pending')->where('parent_profile_id', ParentProfile::getParentId())->delete();
                    $customPaymentsData = CustomPayment::create([
                        'parent_profile_id' => ParentProfile::getParentId(),
                        'amount' => $request->get('amount'),
                        'paying_for' => 'custom',
                        'type_of_payment' => 'Custom Payments',
                        'status' => 'pending',
                    ]);
                    $parentId = $customPaymentsData->parent_profile_id;
                    $parent_profile_id = ParentProfile::getParentId();
                    $amount = $data['amount'];
                    if (!Cart::where('item_id', $parent_profile_id)->where('item_type', 'custom')->exists()) {
                        Cart::create([
                            'item_type' => 'custom',
                            'item_id' => $parent_profile_id,
                            'parent_profile_id' => $parent_profile_id,
                        ]);
                    }
                    break;

                case 'transcript_edit':
                    $parent_profile_id = ParentProfile::getParentId();
                    $student = StudentProfile::whereId($data['student_id'])
                        ->where('parent_profile_id', $parent_profile_id)
                        ->with('transcript')
                        ->first();
                    $amount = FeesInfo::getFeeAmount('transcript_edit');
                    if (!Cart::where('item_id', $request->get('transcript_id'))->where('item_type', 'transcript_edit')->exists()) {
                        Cart::create([
                            'item_type' => 'transcript_edit',
                            'item_id' => $request->get('transcript_id'),
                            'parent_profile_id' => $parent_profile_id,
                        ]);
                    }
                    break;

                case 'postage':
                    $clearpendingPayments = OrderPostage::where('status', 'pending')->where('parent_profile_id', ParentProfile::getParentId())->delete();
                    $amount = $request->get('postage_charges') + $request->get('usa_shiiping');
                    $orderPostageData = OrderPostage::create([
                        'parent_profile_id' => ParentProfile::getParentId(),
                        'amount' =>   $amount,
                        'paying_for' => $request->get('type'),
                        'type_of_payment' => '',
                        'status' => 'pending',
                    ]);
                    $parentId = $orderPostageData->parent_profile_id;
                    $parent_profile_id = ParentProfile::getParentId();
                    if (!Cart::where('item_id', $parent_profile_id)->where('item_type', 'postage')->exists()) {
                        Cart::create([
                            'item_type' => 'postage',
                            'item_id' => $parent_profile_id,
                            'parent_profile_id' => $parent_profile_id,
                        ]);
                    }
                    break;
                case 'notarization':
                    $clearpendingPayments = Notarization::where('status', 'pending')->where('parent_profile_id', ParentProfile::getParentId())->delete();
                    $clearpendingPayments = NotarizationPayment::where('status', 'pending')->where('parent_profile_id', ParentProfile::getParentId())->delete();
                    $parent_profile_id = ParentProfile::getParentId();
                    $transcript_doc_total = json_encode($request->get('transcript_doc'));
                    $confirmation_doc_total = json_encode($request->get('confirmation_doc'));
                    $custom_doc_total = json_encode($request->get('custom_doc'));
                    $notarizationDetails = Notarization::create([
                        'parent_profile_id' => $parent_profile_id,
                        'additional_message' => $request['message'],
                        'postage_option' => 'Notarization & Apostille',
                        'first_name' => $request['first_name'],
                        'last_name' => $request['last_name'],
                        'street' => $request['street'],
                        'city' => $request['city'],
                        'state' => $request['state'],
                        'zip_code' => $request['zip_code'],
                        'country' => $request['country_name'],
                        'apostille_country' =>  $request['apostille_country'],
                        'transcript_doc' => $transcript_doc_total,
                        'confirmation_doc' => $confirmation_doc_total,
                        'custom_doc' => $custom_doc_total,
                    ]);
                    // $orderPostageData = OrderPostage::create([
                    //     'parent_profile_id' => ParentProfile::getParentId(),
                    //     'amount' =>  $request->get('postage_charges'),
                    //     'paying_for' => 'postage',
                    //     'type_of_payment' => '',
                    //     'status' => 'pending'
                    // ]);
                    $amount = $request->get('apostille_due') + $request->get('notarization_due') + $request->get('postage_charges');
                    $notarizationData = NotarizationPayment::create([
                        'parent_profile_id' => ParentProfile::getParentId(),
                        'notarization_id' => $notarizationDetails->id,
                        // 'order_postages_id' => $orderPostageData->id,
                        'amount' =>   $amount,
                        'pay_for' => 'notarization',
                        'type_of_payment' => '',
                        'status' => 'pending'
                    ]);
                    if (!Cart::where('item_id', $notarizationDetails->id)->where('item_type', 'notarization')->exists()) {
                        Cart::create([
                            'item_type' => 'notarization',
                            'item_id' => $notarizationDetails->id,
                            'parent_profile_id' => $parent_profile_id,
                        ]);
                    }
                    break;
                case 'custom_letter':
                    $clearpendingPayments = CustomLetterPayment::where('status', 'pending')->where('parent_profile_id', ParentProfile::getParentId())->delete();
                    $amount = FeesInfo::getFeeAmount('custom_letter') * $request->get('quantity');
                    $customletterPaymentsData = CustomLetterPayment::create([
                        'parent_profile_id' => ParentProfile::getParentId(),
                        'amount' => $amount,
                        'paying_for' => 'custom_letter',
                        'type_of_payment' => 'Custom Letter',
                        'status' => 'pending',
                    ]);
                    $parentId = $customletterPaymentsData->parent_profile_id;
                    $parent_profile_id = ParentProfile::getParentId();
                    if (!Cart::where('item_id', $parent_profile_id)->where('item_type', 'custom_letter')->exists()) {
                        Cart::create([
                            'item_type' => 'custom_letter',
                            'item_id' => $parent_profile_id,
                            'parent_profile_id' => $parent_profile_id,
                        ]);
                    }
                    break;
                case 'order_consultation':
                    $clearpendingPayments = OrderPersonalConsultation::where('status', 'pending')->where('parent_profile_id', ParentProfile::getParentId())->delete();
                    $amount = $request->get('amount_due');
                    $orderConsultancyData = OrderPersonalConsultation::create([
                        'parent_profile_id' => ParentProfile::getParentId(),
                        'preferred_language' => $request->get('preferred_language'),
                        'en_call_type' => $request->get('en_call_type'),
                        'sp_call_type' => $request->get('sp_call_type'),
                        'amount' =>   $amount,
                        'consulting_about' => $request->get('consulting_about'),
                        'paying_for' => $request->get('type'),
                        'type_of_payment' => 'Order personal Consltation',
                        'status' => 'pending',
                    ]);
                    $parent_profile_id = ParentProfile::getParentId();
                    if (!Cart::where('item_id', $parent_profile_id)->where('item_type', 'order_consultation')->exists()) {
                        Cart::create([
                            'item_type' => 'order_consultation',
                            'item_id' => $parent_profile_id,
                            'parent_profile_id' => $parent_profile_id,
                        ]);
                    }
                    break;
                default:
                    break;
            }
            DB::commit();
            return redirect('/cart');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();

            return redirect()->back();
        }
    }

    public function delete($id)
    {
        if (Cart::where('id', $id)->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Item removed successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to remove item']);
        }
    }
}
