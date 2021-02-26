<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    Route::get('parentdata', 'ParentController@dataTable')->name('datatable.parent');
    Route::get('view', 'ParentController@index')->name('view.parent');
    Route::get('edit/{id}', 'ParentController@edit')->name('parent.edit');
    Route::post('update/parent/{id}', 'ParentController@update')->name('parent.update');
    Route::get('delete/parent/{id}', 'ParentController@destroy')->name('parent.delete');
    Route::get('view-student/{id}', 'StudentProfileController@studentInformation')->name('each.student');

    // Crud for student profile
    Route::get('student-data', 'StudentProfileController@dataTable')->name('datatable.student');
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
    //coupon Management
    Route::get('coupon', 'CouponController@index')->name('view.coupon');
    Route::get('coupon/create', 'CouponController@create')->name('create.coupon');
    Route::get('coupon/{id}/edit', 'CouponController@edit')->name('edit.coupon');
    Route::post('coupon', 'CouponController@store')->name('store.coupon');
    Route::put('coupon/{id}', 'CouponController@update')->name('update.coupon');
    Route::get('coupon/data', 'CouponController@dataTable')->name('coupons.dt');
    Route::get('coupon/generate', 'CouponController@getCode')->name('coupons.generate');
    //country date
    Route::get('/countryenrollments', 'CountryController@index')->name('country.display');
    Route::get('edit-country/{id}', 'CountryController@edit')->name('country.edit');
    Route::post('update/country/{id}', 'CountryController@update')->name('country.update');

    //graduation process 
    Route::get('graduations', '\App\Http\Controllers\GraduationController@graduations')->name('view.graduation');
    Route::get('graduations/data', '\App\Http\Controllers\GraduationController@dataTable')->name('graduation.dt');
    Route::get('graduations/{id}/edit', '\App\Http\Controllers\GraduationController@edit')->name('edit.graduation');
    Route::put('graduations/{id}', '\App\Http\Controllers\GraduationController@update')->name('update.graduation');

    //transcript
    Route::get('/manage-courses', 'CourseController@index')->name('manage.course');
    Route::get('edit-course/{id}', 'CourseController@edit')->name('edit.course');
    Route::get('edit-subject/{id}', 'CourseController@editSubject')->name('subject.edit');
    Route::post('update/subject/{id}', 'CourseController@update')->name('update.subject');
    Route::get('delete/subject/{id}', 'CourseController@destroy')->name('delete.subject');
    Route::post('/subject/{id}', 'CourseController@store')->name('create.subject');
    //transcript
    Route::get('/view/transcript', 'TranscriptController@index')->name('view.transcript');
    Route::get('edit-transcript/{id}', 'TranscriptController@edit')->name('edit.transcript');

    Route::get('file-upload', 'FileUploadController@fileUpload')->name('file.upload');
    Route::post('file-upload', 'FileUploadController@fileUploadPost')->name('file.upload.post');

    Route::get('view-pdf/{student_id}', 'TranscriptController@fetchfile')->name('view.pdf');
    Route::get('edit-subGrades/{subject_id}', 'TranscriptController@editSubGrades')->name('edit.subGrades');

    //genrate Unsigned Transcript for student
    Route::get('generate-transcript/{id}/{transcript_id}', 'TranscriptController@genrateTranscript')->name('genrate.transcript');
    Route::get('viewfull-transcript/{student_id}/{transcript_id}', 'TranscriptController@editTranscript')->name('viewfull.transcript');

    Route::get('other-subjects/{course_id}', 'CourseController@otherSubjects')->name('other.subjects');
    Route::get('add-other/{subject_id}', 'CourseController@addSubjects')->name('add.other');
    Route::get('delete/others/{subject_id}', 'CourseController@deleteSubjects')->name('delete.other');

    Route::get('delete/school/{transcript_id}', 'CourseController@deleteSchool')->name('deleteSchool');
});
