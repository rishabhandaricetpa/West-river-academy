<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Config;
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
            case 'banktransfer':
                $type = 'banktransfer';
                return view('admin.EditableEmail.edit-email', compact('type'));
            case 'transcript_approved':
                $type = 'transcript_approved';
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


            $legends = array();

            $pattern = '/{{/';
            $replacement = '$0 ';
            $replace =   preg_replace($pattern, $replacement, $data['content']);
            $email_contents = explode(' ', $replace);
            foreach ($email_contents as $email_content) {

                if (strlen($email_content) > 0  && $email_content[0] === '$') {
                    $legends[] = $email_content;
                }
            }

            $existing_legends = Config::get('constants.enrollment_variables');
            if ($legends == $existing_legends) {

                $filePath = base_path('resources/views/mail/enrollment-confirmation.blade.php');
                echo file_put_contents($filePath, $replace);
                $notification = [
                    'message' => 'Email Edited Successfully',
                    'alert-type' => 'success',
                ];
                return back()->with($notification);
            } else {
                $notification = [
                    'message' => 'Undefined variable is used . Please Check the mail again',
                    'alert-type' => 'error',
                ];
                return redirect()->back()->with($notification);
            }
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
        } elseif ($type == 'banktransfer') {
            $filePath = base_path('resources/views/mail/bankinfo.blade.php');
            echo file_put_contents($filePath, $data);
            return redirect()->back();
        } elseif ($type == 'transcript_approved') {
            $filePath = base_path('resources/views/mail/transcriptMail.blade.php');
            echo file_put_contents($filePath, $data);
            return redirect()->back();
        }
    }
}
