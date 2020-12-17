<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ParentProfile;
use App\Models\User;
use App\Models\Country;
use App\Notifications\EmailVerification;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:strict', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function showRegistrationForm()
    {
        $country_list=  Country::select('country')
                        ->orderBy('country')
                        ->get();
       return view('auth.register')->with('country_list',$country_list);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $parent =  ParentProfile::create([
            'user_id' => $user->id,
            'p1_first_name' => $data['name'],
            'p1_middle_name' => $data['nick_name'],
            'p1_last_name' => $data['last_name'],
            'p1_email' => $data['email'],
            'p1_cell_phone' => $data['cell_phone'],
            'p1_home_phone' => $data['home_phone'],
            'p2_first_name' => $data['p2_name'],
            'p2_middle_name' => $data['p2_nickname'],
            'p2_email' => $data['p2_email'],
            'p2_cell_phone' => $data['p2_cellphone'],
            'p2_home_phone' => $data['p2_homephone'],
            'street_address' => $data['street_address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip_code' => $data['zip_code'],
            'country' => $data['country'],
            'reference' => $data['refrence'],
            'immunized' => 'non immunized',
        ]);
        $parent->save();
        return $user;
    }
        /**
     * The user has been registered.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function registered(Request $request, User $user)
    {
        // Prevent auto-login after registration
        $this->guard()->logout();
        $request->session()->invalidate();
        $user->notify(new EmailVerification());

        alert()->success('Please check your email inbox for verification.');

        //return redirect()->route('verify.email');
        return view('SignIn/verify-email', compact('user'));
    }
    /**
     * show country list to parent profile dropdown
     */
}
