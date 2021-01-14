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
    Route::get('/welcome-video', function () {
        return view('welcome-video');
    });
    // admin dashboard
    Route::get('admin-dashboard', function () {
        return view('admin.home');
    })->name('admin.admindashboard');

    // Route::get('/dashboard-transcript-finished', function () {
    //     return view('dashboard-transcript-finished');
    // });
    // Route::get('/dashboard-transcript-filling', function () {
    //     return view('dashboard-transcript-filling');
    // });
    // Route::get('/download-transcript', function () {
    //     return view('download-transcript');
    // });
    // Route::get('/dashboard-transcript-filling1', function () {
    //     return view('dashboard-transcript-filling1');
    // });
    // Route::get('/dashboard-languages', function () {
    //     return view('dashboard-languages');
    // });
    // Route::get('/dashboard-transcript-filling2', function () {
    //     return view('dashboard-transcript-filling2');
    // });
    // Route::get('/dashboard-another-languages', function () {
    //     return view('dashboard-another-languages');
    // });
    // Route::get('/dashboard-transcript', function () {
    //     return view('dashboard-transcript');
    // });
    Route::get('/bank-transfer', function () {
        return view('bank-transfer');
    });

   
    Route::get('/reviewstudent/{id}',  'StudentController@reviewStudent')->name('reviewstudent');
    Route::get('/cart', function () {
        return view('cart');
    });
   

    //enroll student
    Route::get('/enroll-student', 'StudentController@index')->middleware('auth');
    Route::post('/enroll-student', 'StudentController@store')->middleware('auth')->name('enroll.student');
    Route::post('/update-student/{id}', 'StudentController@update')->name('update.student');
    Route::get('/reviewstudents',  'StudentController@reviewStudent')->name('reviewstudent');
    Route::get('/edit/{id}', 'StudentController@edit')->name('edit.student');
    Route::post('delete/{id}', 'StudentController@delete')->name('delete.student');

    // dashboard screen and verify email message
    Route::get('/verify-email/{email}', function () {
        return view('SignIn/verify-email');
    })->name('verify.email');
    Route::get('/dashboard', function () {
        return view('SignIn/dashboard');
    })->name('dashboard')->middleware('active_user');
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/login');
    });


    //working blades by frontend
    Route::get('/reviewstudent', function () {
        return view('reviewstudent');
    });
    
    Route::post('/cart', 'CartController@store')->middleware('auth')->name('add.cart');
    Route::delete('/cart/{id}', 'CartController@delete')->middleware('auth')->name('delete.cart');
    Route::get('/cart', 'CartController@index')->middleware('auth');

    
    // Route::get('/cart', 'StudentController@address')->name('billing.address');
    Route::get('edit/address/{id}', 'StudentController@address')->name('edit.address');
    // Route::get('/cart-billing', function () {
    //     return view('Billing/cart-billing');
    // });
    Route::post('/cart-billing', 'StudentController@saveaddress')->middleware('auth')->name('billing.address');


    //payment
    Route::get('payment', function () {
        return view('paywithpaypal');
    })->name('paywithpaypal');
    Route::post('paypal', 'PaymentController@postPaymentWithpaypal');
    Route::get('status', 'PaymentController@getPaymentStatus')->name('status');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('home');
//-----payments
Route::get('/stripe-payment', 'App\Http\Controllers\StripeController@index')->name('stripe.payment');
Route::post('/stripe-payment', [App\Http\Controllers\StripeController::class, 'handlePost'])->name('stripe.payment');
// Route::post('paymentinfo/{id}', 'App\Http\Controllers\StripeController@store')->name('payment.info');
Route::get('/money-order', 'App\Http\Controllers\MoneyOrderController@index')->name('money.order');
Route::get('bankTransfer','App\Http\Controllers\BankTranferController@index')->name('bank.transfer');


