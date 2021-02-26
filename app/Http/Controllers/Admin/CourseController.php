<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParentProfile;
use App\Models\User;
use App\Models\Course;
use App\Models\Subject;
use App\Models\TranscriptK8;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {

        $courses = Course::all();
        return view('admin.transcript.view-courses', compact('courses'));
    }

    protected function store(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $subject = Subject::create([
                'courses_id' => $id,
                'subject_name' => $request['subject_name'],
                'transcript_period' => $request['grade'],
                'status' => 0,
            ]);
            DB::commit();
            $notification = [
                'message' => 'New Address for TransferWise is Added Successfully!',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        } catch (\Exception $e) {
            DB::rollBack();
            $notification = [
                'message' => 'Missing Information!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }
    public function edit($id)
    {
        $coursename = Course::find($id);
        $subjects = Subject::where('courses_id', $id)
            ->where('status', 0)
            ->get();
        return view('admin.transcript.edit-courses', compact('subjects', 'coursename', 'id'));
    }

    public function editSubject($id)
    {
        $name = Subject::find($id);
        return view('admin.transcript.edit-subject', compact('name'));
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::find($id);
        $subject->subject_name = $request->get('subject_name');
        $subject->transcript_period = $request->get('grade');
        $subject->status = 0;
        $subject->save();
        $notification = [
            'message' => 'Subject Info Updated!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        $notification = [
            'message' => 'Record is Deleted Successfully!',
            'alert-type' => 'warning',
        ];
        Subject::where('id', $id)->delete();

        return redirect()->back()->with($notification);
    }
    public function otherSubjects($id)
    {
        $coursename = Course::find($id);
        $subjects = Subject::where('courses_id', $id)
            ->where('status', 1)
            ->get();
        return view('admin.transcript.add-other-subject', compact('coursename', 'subjects'));
    }
    public function addSubjects($subject_id)
    {
        $subject = Subject::find($subject_id);
        $subject->status = 0;
        $subject->save();
        $notification = [
            'message' => 'Subject Added Successfully!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
    public function deleteSubjects($subject_id)
    {
        Subject::find($subject_id)->delete();
        $notification = [
            'message' => 'Subject Deleted Successfully!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
    public function deleteSchool($transcript_id)
    {
        $transcriptDetails = TranscriptK8::find($transcript_id)->delete();
        $notification = [
            'message' => 'School Record Deleted Successfully!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
}
