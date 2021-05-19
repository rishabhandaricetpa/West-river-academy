<?php

namespace App\Http\Controllers;

use App\Mail\GraduationApproved;
use App\Models\Country;
use App\Models\FeesInfo;
use App\Models\Graduation;
use App\Models\GraduationDetail;
use App\Models\GraduationPayment;
use App\Models\ParentProfile;
use App\Models\StudentProfile;
use App\Models\Notification;
use Auth;
use App\Models\Dashboard;
use App\Models\UploadDocuments;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Storage;
use Str;

class GraduationController extends Controller
{
    public function index()
    {
        $parent_id = ParentProfile::getParentId();
        $students = StudentProfile::select('id', 'first_name', 'last_name', 'gender')
            ->selectRaw('DATE(d_o_b) as dob')
            ->where('parent_profile_id', $parent_id)
            ->with('graduation')
            ->get();

        return view('graduation.index', compact('students'));
    }

    public function gradutaionApplication(Request $request)
    {
        $student_id = $request->query('student');
        $student = StudentProfile::whereId($student_id)->where('parent_profile_id', ParentProfile::getParentId())->with('graduation')->first();

        if ($student === null) {
            return redirect()->back()->with([
                'message' => 'Student not found!',
                'alert-type' => 'error',
            ]);
        } elseif ($student->graduation !== null) {
            return redirect()->back()->with([
                'message' => 'Graduation is already applied for this student!',
                'alert-type' => 'error',
            ]);
        }

        return view('graduation.application', compact('student'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $inputs = $request->all();

            $fee = FeesInfo::getFeeAmount('graduation');

            $data = [
                'parent_profile_id' => ParentProfile::getParentId(),
                'student_profile_id' => $inputs['student_id'],
                'grade_9_info' => $inputs['grade_nine_option'] === 'other' ? $inputs['grade_nine_other'] : $inputs['grade_nine_option'],
                'grade_10_info' => $inputs['grade_ten_option'] === 'other' ? $inputs['grade_ten_other'] : $inputs['grade_ten_option'],
                'grade_11_info' => $inputs['grade_eleven_option'] === 'other' ? $inputs['grade_eleven_other'] : $inputs['grade_eleven_option'],
                'status' => 'pending',
            ];
            StudentProfile::whereId($inputs['student_id'])->update(['email' => $inputs['email']]);
            $graduation = Graduation::create($data);
            GraduationPayment::updateOrInsert(['graduation_id' => $graduation->id], ['amount' => $fee]);
            GraduationDetail::updateOrInsert(['graduation_id' => $graduation->id], []);
            $studentName = StudentProfile::whereId($inputs['student_id'])->first();
            Dashboard::create([
                'student_profile_id' => $request->student_id,
                'linked_to' => $graduation->id,
                'related_to' => 'graduation_record_received',
                'is_archieved' => 0,
                'notes' =>  $studentName->fullname,
                'created_date' => \Carbon\Carbon::now()->format('M d Y'),
            ]);
            DB::commit();

            if ($request->expectsJson()) {
                return response()->json(['status' => 'success', 'message' => 'Record added successfully']);
            }
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();

            if ($request->expectsJson()) {
                return response()->json(['status' => 'error', 'message' => 'Failed to add record']);
            }
        }
    }

    public function update(Request $request, $id)
    {

        try {
            DB::beginTransaction();
            $inputs = $request->all();

            $graduation = Graduation::whereId($id);
            $student_id = $graduation->pluck('student_profile_id')->first();
            $parent_id = $graduation->pluck('parent_profile_id')->first();
            $old_status = $graduation->pluck('status')->first();
            $graduation->update(['status' => $inputs['status']]);

            if ($inputs['status'] === 'approved' && $inputs['status'] != $old_status) {
                $data = $graduation->with(['parent', 'student'])->first();
                if ($data->parent->p1_email) {
                    $graduation_fee = FeesInfo::getFeeAmount('graduation');

                    if ($data->apostille_country) {
                        $apostille_fee = FeesInfo::getFeeAmount('apostille');
                        $total_fee = $graduation_fee + $apostille_fee;
                        $message = 'final transcript and Apostille.';
                    } else {
                        $total_fee = $graduation_fee;
                        $message = 'and final transcript.';
                    }

                    $data->total_fee = $total_fee;
                    $data->message = $message;

                    Notification::create(['parent_profile_id' => $parent_id, 'content' => 'Your application for graduation has been approved!', 'type' => 'graduation_approved', 'read' => 'false']);

                    Mail::to($data->parent->p1_email)->send(new GraduationApproved($data));
                }
            }

            unset($inputs['_method']);
            unset($inputs['_token']);
            unset($inputs['status']);

            //  GraduationDetail::where('graduation_id', $id)->update($inputs);
            GraduationDetail::where('graduation_id', $id)->update(
                [
                    'project' => $inputs['project'],
                    'diploma' => $inputs['diploma'],
                    'transcript' => $inputs['transcript'],
                    'situation' => $inputs['situation'],
                    'record_received' => $inputs['record_received'],
                    'grad_date' =>  \Carbon\Carbon::parse($inputs['grad_date'])->format('Y/m/d'),
                    'notes' => $inputs['notes'],
                ]

            );
            // upload documents
            $cover = $request->file('file');
            if ($request->file('file')) {
                foreach ($request->file as $cover) {
                    $extension = $cover->getClientOriginalExtension();
                    $path = Str::random(40) . '.' . $extension;
                    Storage::put(UploadDocuments::UPLOAD_DIR . '/' . $path,  File::get($cover));

                    $uploadDocument = new UploadDocuments();
                    $uploadDocument->student_profile_id = $student_id;
                    $uploadDocument->parent_profile_id = $parent_id;
                    $uploadDocument->original_filename = $cover->getClientOriginalName();
                    $uploadDocument->is_upload_to_student = 1;
                    $uploadDocument->filename = $path;
                    $uploadDocument->save();
                }
            }
            DB::commit();

            return redirect()->route('admin.view.graduation')->with([
                'message' => 'Details updated successfully!',
                'alert-type' => 'success',
            ]);
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();

            return redirect()->back()->with([
                'message' => 'Failed to update details!',
                'alert-type' => 'error',
            ]);
        }
    }

    public function graduations()
    {
        return view('admin.graduation.view');
    }

    public function dataTable()
    {
        return datatables(Graduation::with(['details', 'student', 'parent'])->latest()->get())->toJson();
    }

    public function edit(Request $request, $id)
    {
        $graduation = Graduation::whereId($id)->with(['details', 'student', 'parent'])->first();
        return view('admin.graduation.edit', compact('graduation'));
    }

    public function purchase(Request $request, $id)
    {
        $student = StudentProfile::whereId($id)->with(['graduationAddress', 'graduation', 'graduationPayment', 'parentProfile'])->first();
        $countries = Country::select('country')->where('country', '!=', 'United States')->get();
        $apostille_fee = FeesInfo::getFeeAmount('apostille');
        $graduation_fee = FeesInfo::getFeeAmount('graduation');

        return view('graduation.purchase', compact('student', 'countries', 'apostille_fee', 'graduation_fee'));
    }
}
