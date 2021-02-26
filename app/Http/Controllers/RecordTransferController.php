<?php

namespace App\Http\Controllers;

use App\Models\ParentProfile;
use App\Models\RecordTransfer;
use Illuminate\Http\Request;

class RecordTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($parentId)
    {
        $students = ParentProfile::find($parentId)->studentProfile()->get();
        return view('recordTransfer.studentDetails', compact('students'));
    }

    public function sendRecordRequest($student_id)
    {
        return view('previous-school', compact('student_id'));
    }
}
