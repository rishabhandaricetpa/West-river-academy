<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailEdits;
use App\Models\Testing;
use Config;
use DbView;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function getEmail($type)
    {
        $template = EmailEdits::where('type', $type)->first();
        $r =  $template->content;
        return view('admin.EditableEmail.edit-email', compact('type', 'r'));
    }
    public function getAllEmails()
    {
        return view('admin.EditableEmail.all-email');
    }
    public function savemail(Request $request, $type)
    {

        $existing_legends = Config::get("constants." . $type . "_variables");

        $legends = getLegends($request->get('email_body'));
        if ($legends['consts'] == $existing_legends) {
            EmailEdits::where('type', $type)->update([
                'content' => $legends['replace'],
                'type' => $type
            ]);
            // echo $content;
            $notification = [
                'message' => 'Email Edited Successfully',
                'alert-type' => 'success',
            ];
            return back()->with($notification);
        } else {
            $notification = [
                'message' => 'Email not Edited ',
                'alert-type' => 'error',
            ];
            return back()->with($notification);
        }
    }
}
