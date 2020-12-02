<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return mixed
     */
    protected function authenticated(Request $request, User $user)
    {
        if (!$user->hasVerifiedEmail()) {
            $this->guard()->logout();
            $request->session()->invalidate();

            alert()->error('Please verify your email first.');

            return redirect()->back()
                ->withInput($request->only($this->username()));
        }
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        // throw ValidationException::withMessages([
        //   $this->username() => [trans('auth.failed')],
        // ]);
        $errors = [$this->username() => trans('auth.failed')];

        // Load user from database
        $user = User::where($this->username(), $request->{$this->username()})->first();

        if ($user && !Hash::check($request->password, $user->password)) {
            $errors = ['password' => 'The provided password is incorrect'];
        }

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }
}
