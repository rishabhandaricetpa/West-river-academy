<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome');


Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');

    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

    Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

    Route::get('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::get('email/resend', 'Auth\VerificationController@showResendForm')->name('verification.request');
    Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    Route::get('/enroll',function(){
        return view('enrollstudent');
    });
    Route::get('/welcome-video',function(){
        return view('welcome-video');
    });
    Route::get('/reviewstudent',function(){
        return view('reviewstudent');
    });
    Route::get('/dashboard-transcript-finished',function(){
        return view('dashboard-transcript-finished');
    });
    Route::get('/dashboard-transcript-filling',function(){
        return view('dashboard-transcript-filling');
    });
    Route::get('/select-courses',function(){
        return view('select-courses');
    });
    Route::get('/transcript-united-states',function(){
        return view('transcript-united-states');
    });
    Route::get('/transcript-select-country',function(){
        return view('transcript-select-country');
    });
    Route::get('/year-grade',function(){
        return view('year-grade');
    });
    Route::get('/year-grade1',function(){
        return view('year-grade1');
    });
    Route::get('/Ap-courses',function(){
        return view('Ap-courses');
    });
    Route::get('/select-language-arts',function(){
        return view('select-language-arts');
    });
    Route::get('/select-grade',function(){
        return view('select-grade');
    });
    Route::get('/transcript-united-states1',function(){
        return view('transcript-united-states1');
    });
    Route::get('/download-transcript',function(){
        return view('download-transcript');
    });
    Route::get('/dashboard-transcript-filling1',function(){
        return view('dashboard-transcript-filling1');
    });
    Route::get('/dashboard-languages',function(){
        return view('dashboard-languages');
    });
    Route::get('/dashboard-transcript-filling2',function(){
        return view('dashboard-transcript-filling2');
    });
    Route::get('/dashboard-another-languages',function(){
        return view('dashboard-another-languages');
    });
    Route::get('/dashboard-transcript',function(){
        return view('dashboard-transcript');
    });
    Route::get('/cart',function(){
        return view('cart');
    });

    Route::get('/cart-billing',function(){
        return view('cart-billing');
    });
    Route::post('/enroll', 'StudentController@create')->name('enroll');

    // dashboard screen and verify email message
    Route::get('/verify-email/{email}', function () {
        return view('SignIn/verify-email');
    })->name('verify.email');
    Route::get('/dashboard', function () {
        return view('SignIn/dashboard');
    })->name('dashboard');
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/login');
    });
    Route::get('admin-dashboard', function () {
        return view('admin.app');
    })->name('admin.admindashboard');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('home');