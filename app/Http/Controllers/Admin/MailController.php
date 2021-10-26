<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function getEmail($type)
    {

        switch ($type) {
            case 'enrollment':
                $type = 'enrollment';
                return view('admin.EditableEmail.edit-email', compact('type'));
            case 'record_transfer':
                $type = 'record_transfer';
                return view('admin.EditableEmail.edit-email', compact('type'));
            case 'graduation':
                $type = 'graduation';
                return view('admin.EditableEmail.edit-email', compact('type'));
        }
    }
    public function getAllEmails()
    {
        return view('admin.EditableEmail.all-email');
    }
    public function savemail(Request $request, $type)
    {
        if ($type == 'enrollment') {
            $data['content'] = $request->get('email_body');
            $filePath = base_path('resources/views/mail/enrollment-confirmation.blade.php');

            echo file_put_contents($filePath, $data);
            return redirect()->back();
        } elseif ($type == 'graduation') {
            $data['content'] = $request->get('email_body');
            $filePath = base_path('resources/views/mail/graduation-approved.blade.php');

            echo file_put_contents($filePath, $data);
            return redirect()->back();
        }

        //  return view('mail.enrollment-confirmation', $data);
    }
}
