<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentProfile;
use App\Models\UploadDocuments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use phpDocumentor\Reflection\Types\Self_;
use Storage;
use Str;
use Validator;

class UploadDocument extends Controller
{
    public function index()
    {
        return view('admin.uploadDocument.studentDocument');
    }
    public function dataTable()
    {
        return datatables(StudentProfile::with(['parentProfile', 'recordTransfers', 'graduation'])->get())->toJson();
    }
    public function editUpload($student_id)
    {
        $parentStudentData = StudentProfile::where('id', $student_id)->with('parentProfile')->first();
        return view('admin.uploadDocument.editDocument', compact('parentStudentData'));
    }
    public function storeUploadedDocument(Request $request)
    {
        request()->validate([
            'file' => 'required|max:2048'
        ]);
        $cover = $request->file('file');
        if ($request->file('file')) {
            foreach ($request->file as $cover) {
                $extension = $cover->getClientOriginalExtension();
                $path = Str::random(40) . '.' . $extension;
                Storage::put(UploadDocuments::UPLOAD_DIR . '/' . $path,  File::get($cover));

                $uploadDocument = new UploadDocuments();
                $uploadDocument->student_profile_id = $request->student_id;
                $uploadDocument->parent_profile_id = $request->parent_id;
                $uploadDocument->original_filename = $cover->getClientOriginalName();
                $uploadDocument->filename = $path;
                $uploadDocument->save();
            }
        }

        $notification = [
            'message' => 'Successfully uploaded Record!',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.upload.documents')->with($notification);
    }
    public function viewAllDocuments($student_id)
    {
        $uploadedDocuments = UploadDocuments::where('student_profile_id', $student_id)->get();
        return view('admin.uploadDocument.viewDocument', compact('uploadedDocuments'));
    }
    public function changeNameOfUploadedDocument($document_id)
    {
        $document = UploadDocuments::where('id', $document_id)->first();
        return view('admin.uploadDocument.changeDocumentName', compact('document'));
    }
    public function updateDocument(Request $request)
    {
        $uploadDocument = UploadDocuments::find($request->document_id);
        $uploadDocument->original_filename = $request->document_name;
        $uploadDocument->document_type = $request->document_type;
        if ($request->has('is_upload')) {
            $uploadDocument->is_upload_to_student = 1;
        } else {
            $uploadDocument->is_upload_to_student = 0;
        }
        $uploadDocument->save();
        $notification = [
            'message' => 'Successfully updated Record!',
            'alert-type' => 'success',
        ];

        return redirect()->route('admin.change.uploadDocument', $uploadDocument->student_profile_id)->with($notification);
    }
}
