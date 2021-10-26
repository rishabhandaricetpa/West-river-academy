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
            case 'moneygram':
                $type = 'moneygram';
                return view('admin.EditableEmail.edit-email', compact('type'));
            case 'graduation':
                $type = 'graduation';
                return view('admin.EditableEmail.edit-email', compact('type'));
            case 'moneyorder':
                $type = 'moneyorder';
                return view('admin.EditableEmail.edit-email', compact('type'));
        }
    }
    public function getAllEmails()
    {
        return view('admin.EditableEmail.all-email');
    }
    public function savemail(Request $request, $type)
    {
        $data['content'] = $request->get('email_body');
        if ($type == 'enrollment') {
            $filePath = base_path('resources/views/mail/enrollment-confirmation.blade.php');
            echo file_put_contents($filePath, $data);
            return redirect()->back();
        } elseif ($type == 'graduation') {

            $filePath = base_path('resources/views/mail/graduation-approved.blade.php');
            echo file_put_contents($filePath, $data);
            return redirect()->back();
        } elseif ($type == 'moneygram') {
            $filePath = base_path('resources/views/mail/moneygram-email.blade.php');
            echo file_put_contents($filePath, $data);
            return redirect()->back();
        } elseif ($type == 'moneyorder') {
            $filePath = base_path('resources/views/mail/moneyordermail.blade.php');
            echo file_put_contents($filePath, $data);
            return redirect()->back();
        }

        //  return view('mail.enrollment-confirmation', $data);
    }
}
