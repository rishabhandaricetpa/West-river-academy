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

    Route::get('/reviewstudent/{id}',  'StudentController@reviewStudent')->name('reviewstudent');
    Route::get('/cart', function () {
        return view('cart');
    });
   

    //enroll student
    Route::get('/enroll-student', 'StudentController@index')->middleware('auth');
    Route::post('/enroll-student', 'StudentController@store')->middleware('auth')->name('enroll.student');
    Route::post('/update-student/{id}', 'StudentController@update')->name('update.student');
<<<<<<< HEAD
    Route::get('/reviewstudent/{id}',  'StudentController@reviewStudent')->name('reviewstudent');
=======
    Route::get('/reviewstudents',  'StudentController@reviewStudent')->name('reviewstudent');
>>>>>>> local-dev
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
    Route::post('/cart-billing', 'StudentController@saveaddress')->middleware('auth')->name('billing.address');


    //Paypal Payment
    Route::get('payment', function () {
        return view('paywithpaypal');
    })->name('paywithpaypal');
    Route::post('paypal', 'PaypalPaymentController@postPaymentWithpaypal');
    Route::get('status', 'PaypalPaymentController@getPaymentStatus')->name('status');
    Route::get('payment/{id}', 'StudentController@paypalorderReview')->name('paypal.order');

    //Stripe Payment
    Route::get('/stripe-payment', 'StripeController@index')->name('stripe.payment');
    Route::get('/stripe-payment/{id}', 'StudentController@stripeorderReview')->name('edit.stripe');
    Route::post('/stripe-payment', 'StripeController@handlePost')->name('stripe.payment');
    Route::get('paymentinfo',function () {
        return view('paywithpaypal');
    })->name('payment.info');
    //Invoice
    Route::get('/invoices', 'StripeController@invoices');
    Route::get('/invoice/{invoice_id}', 'StripeController@invoice');
    
    //Money-order
    Route::get('/money-order', 'MoneyOrderController@index')->name('money.order');
    Route::get('/money-order/{id}', 'StudentController@moneyorderReview');
    Route::get('moneyorder-email','MoneyOrderController@index');

    //Bank Transfer
    Route::get('order-review', function () {
        return view('Billing/order-review');
    })->name('order.review');
    Route::get('order-review/{id}', 'StudentController@orderReview');
    Route::get('bankTransfer','BankTranferController@index')->name('bank.transfer');
    Route::get('/bank-transfer', function () {
        return view('bank-transfer');
    });
   
});




