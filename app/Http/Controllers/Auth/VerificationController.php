<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\EmailVerification;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VerificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('throttle:30,1');
    }

    public function showResendForm()
    {
        return view('auth.resend');
    }

    public function verify(Request $request, User $user)
    {
        if (!$request->hasValidSignature()) {
            alert()->error('Invalid verification link. Please request a new one.');

            return redirect()->route('verification.request');
        }

        if ($user->hasVerifiedEmail()) {
            $message = 'Your email address is already verified.';
        } else {
            $user->setEmailAsVerified();
            $user->save();
            $message = 'Email address verified successfully.';
        }

        alert()->success($message);

        return redirect('/login');
    }

    public function resend(Request $request)
    {
        $this->validate($request, [
            'email' => [
                'bail', 'required', 'string', 'email', Rule::exists('users', 'email')->where(function ($query) {
                    /* @var Builder $query */
                    $query->whereNull('email_verified_at');
                }),
            ],
        ]);

        $user = User::query()
            ->where('email', $request->get('email'))->first();

        $user->notify(new EmailVerification());

        alert()->success('Email sent successfully. Check your inbox.');

        return redirect()->route('login');
    }
}
