<?php

use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', 'HomeController@index')->name('home');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Register
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Reset Password
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Confirm Password
Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

Route::group(['middleware' => 'auth'], function () {

    Route::group(
        ['namespace' => 'admin'],
        function () {
            Route::get('logout', function () {
                Auth::guard('admin')->logout();
                return redirect('/admin/login');
            })->name('admin.logout');
            Route::get('/payments-invoice', function () {
                return view('admin/paymentsInvoice/payment');
            });
        }
    );

    // Crud for parent profile
    Route::get('view', 'ParentController@index')->name('view.parent');
    Route::get('edit/{id}', 'ParentController@edit')->name('parent.edit');
    Route::post('update/parent/{id}', 'ParentController@update')->name('parent.update');
    Route::get('delete/parent/{id}', 'ParentController@destroy')->name('parent.delete');

    // Crud for student profile
    Route::get('view-student', 'StudentProfileController@index')->name('view-student');
    Route::get('edit-student/{id}', 'StudentProfileController@edit')->name('edit-student');
    Route::post('update/{id}', 'StudentProfileController@update')->name('edit-student.update');
    Route::get('delete/{id}', 'StudentProfileController@destroy')->name('delete.student');
    Route::get('deactive/{id}', 'Auth\RegisterController@dactive')->name('deactive.student');

    // Crud for student enrollment period and payment
    Route::get('edit-periods/{id}', 'StudentProfileController@editPeriods')->name('edit-periods.update');
    Route::get('payments', 'PaymentController@view')->name('payments');
    Route::get('edit-payment/{id}', 'PaymentController@edit')->name('edit.student.payment');
    Route::post('update-payment/{id}', 'PaymentController@update')->name('update-payment');
    Route::get('edit-payment-status/{id}', 'PaymentController@editPaymentStatus')->name('edit.payment.status');


    // edit for payment address for - moneygram,banktransfer & transferwise
    Route::get('/payment-address', 'PaymentAddressController@index');
    Route::get('edit-banktransfer/{id}', 'PaymentAddressController@edit')->name('banktransfer.edit');
    Route::get('edit-transferwise/{id}', 'PaymentAddressController@editTransferWise')->name('transferwise.edit');
    Route::get('edit-moneygram/{id}', 'PaymentAddressController@editMoneyGram')->name('moneygram.edit');

    //update
    Route::post('update/transferwise/{id}', 'PaymentAddressController@updateTransferwise')->name('transferwise.update');
    Route::post('update/moneygram/{id}', 'PaymentAddressController@updateMoneytransfer')->name('moneygram.update');
    Route::post('update/banktransfer/{id}', 'PaymentAddressController@update')->name('banktransfer.update');

    Route::post('/moneygram', 'PaymentAddressController@storeMoneygram')->name('create.moneygram');
    Route::post('/transferwise', 'PaymentAddressController@storeTransferwise')->name('create.transferwise');
    Route::post('/banktransfer', 'PaymentAddressController@storeBanktransfer')->name('create.banktransfer');
    //delete
    Route::get('delete/moneygram/{id}', 'PaymentAddressController@destroyMoneyGramAddress')->name('delete.moneygramAddress');
    Route::get('delete/transferwise/{id}', 'PaymentAddressController@destroyTransferwiseAddress')->name('delete.transferwiseAddress');
    Route::get('delete/banktransfer/{id}', 'PaymentAddressController@destroyBanktransferAddress')->name('delete.banktransferAddress');
});
