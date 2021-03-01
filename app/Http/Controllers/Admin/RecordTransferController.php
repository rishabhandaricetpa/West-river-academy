<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecordTransfer;

class RecordTransferController extends Controller
{

    public function index()
    {
        $schoolRecords = RecordTransfer::all();
        return view('admin.recordTransfer.adminRecord', compact('schoolRecords'));
    }
}
