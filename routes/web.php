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

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/welcome-video', function () {
            return view('welcome-video');
        });

        Route::get('/reviewstudent/{id}', 'StudentController@reviewStudent')->name('reviewstudent');
        // Route::get('/cart', function () {
        //     return view('cart');
        // });

        //enroll student
        Route::get('/enroll-student', 'StudentController@index');
        Route::post('/enroll-student', 'StudentController@store')->name('enroll.student');
        Route::post('/update-student/{id}', 'StudentController@update')->name('update.student');
        Route::get('/reviewstudents', 'StudentController@reviewStudent')->name('reviewstudent');
        Route::get('/edit/{id}', 'StudentController@edit')->name('edit.student');
        Route::post('delete/{id}', 'StudentController@deleteEnroll')->name('delete.enroll');

        // dashboard screen and verify email message
        Route::get('/verify-email/{email}', function () {
            return view('SignIn/verify-email');
        })->name('verify.email');
        // Route::get('/dashboard', function () {
        //     return view('SignIn/dashboard');
        // })->name('dashboard')->middleware('active_user');
        Route::get('/dashboard', 'StudentController@showstudents')->name('dashboard');

        Route::get('/logout', function () {
            Auth::logout();

            return redirect('/login');
        });

        Route::post('/cart', 'CartController@store')->name('add.cart');
        Route::delete('/cart/{id}', 'CartController@delete')->name('delete.cart');
        Route::get('/cart', 'CartController@index');

        // Route::get('/cart', 'StudentController@address')->name('billing.address');
        Route::get('edit/address/{id}', 'ParentController@address')->name('edit.address');
        Route::post('/cart-billing', 'ParentController@saveaddress')->name('billing.address');

        //Paypal Payment
        Route::get('payment', function () {
            return view('paywithpaypal');
        })->name('paywithpaypal');
        Route::post('paypal', 'PaymentMethod\PaypalPaymentController@postPaymentWithpaypal');
        Route::get('status', 'PaymentMethod\PaypalPaymentController@getPaymentStatus')->name('status');
        Route::get('payment/{id}', 'StudentController@paypalorderReview')->name('paypal.order');
        Route::get('thankyoupage', function () {
            return view('Billing/thankyou');
        })->name('thankyou.paypal');

        //Stripe Payment
        // Route::get('/stripe-payment', 'StripeController@index')->name('stripe.payment');
        Route::get('/stripe-payment/{id}', 'StudentController@stripeorderReview')->name('edit.stripe');
        Route::post('/stripe-payment', 'PaymentMethod\StripeController@handlePost')->name('stripe.payment');
        Route::get('paymentinfo', function () {
            return view('Billing/paymentsuccess');
        })->name('payment.info');

        //Money-order
        Route::get('/money-order', 'PaymentMethod\MoneyOrderController@index')->name('money.order');
        Route::get('/money-order/{id}', 'StudentController@moneyorderReview');
        Route::get('moneyorder-email', 'PaymentMethod\MoneyOrderController@index');

        //Bank Transfer
        Route::get('order-review', function () {
            return view('Billing/order-review');
        })->name('order.review');
        Route::get('order-review/{id}', 'StudentController@orderReview');
        Route::get('bankTransfer', 'PaymentMethod\BankTranferController@index')->name('bank.transfer');
        Route::get('/bank-transfer', 'ParentController@getBankTransferDetails');

        //Money Gram
        Route::get('/money-gram', 'PaymentMethod\MoneyGramController@index')->name('money.gram');
        Route::get('/money-gram/{id}', 'StudentController@moneygramReview');
        Route::get('moneygram-email', 'PaymentMethod\MoneyGramController@index');
        Route::get('/moneygram-transfer', 'ParentController@getMoneyGramDetails');

        Route::get('/mysettings/{id}', 'ParentController@mysettings');
        Route::get('/editaccount/{id}', 'ParentController@editmysettings');
        Route::post('/updateaccount/{id}', 'ParentController@updatemysettings')->name('update.account');
        Route::get('/reset', function () {
            return view('MyAccounts/resetpassword');
        })->name('reset.password');
        Route::post('reset/{id}', 'ParentController@updatePassword')->name('account-pass.update');
        // Route::get('/viewConfirmation/{id}', function () {
        //     return view('viewConfirmation');
        // })->name('view.confirm');
        Route::get('/viewConfirmation/{id}', 'StudentController@confirmationpage')->name('view.confirm');

        Route::get('generate-pdf/{id}', 'PDFController@generatePDF')->name('genrate.confirmition');
        // admin dashboard
        Route::get('admin/dashboard', function () {
            return view('admin.home');
        })->name('admin.admindashboard');
    });

    // Route::post('/cart', 'CartController@store')->name('add.cart');
    // Route::delete('/cart/{id}', 'CartController@delete')->name('delete.cart');
    // Route::get('/cart', 'CartController@index');


    // // Route::get('/cart', 'StudentController@address')->name('billing.address');
    // Route::get('edit/address/{id}', 'ParentController@address')->name('edit.address');
    // Route::post('/cart-billing', 'ParentController@saveaddress')->name('billing.address');


    //Paypal Payment
    Route::get('payment', function () {
        return view('paywithpaypal');
    })->name('paywithpaypal');
    Route::post('paypal', 'PaymentMethod\PaypalPaymentController@postPaymentWithpaypal');
    Route::get('status', 'PaymentMethod\PaypalPaymentController@getPaymentStatus')->name('status');
    Route::get('payment/{id}', 'StudentController@paypalorderReview')->name('paypal.order');

    //Stripe Payment
    // Route::get('/stripe-payment', 'StripeController@index')->name('stripe.payment');
    Route::get('/stripe-payment/{id}', 'StudentController@stripeorderReview')->name('edit.stripe');
    Route::post('/stripe-payment', 'PaymentMethod\StripeController@handlePost')->name('stripe.payment');
    Route::get('paymentinfo', function () {
        return view('Billing/paymentsuccess');
    })->name('payment.info');


    //Money-order
    Route::get('/money-order', 'PaymentMethod\MoneyOrderController@index')->name('money.order');
    Route::get('/money-order/{id}', 'StudentController@moneyorderReview');
    Route::get('moneyorder-email', 'PaymentMethod\MoneyOrderController@index');

    //Bank Transfer
    Route::get('order-review', function () {
        return view('Billing/order-review');
    })->name('order.review');
    Route::get('order-review/{id}', 'StudentController@orderReview');
    Route::get('bankTransfer', 'PaymentMethod\BankTranferController@index')->name('bank.transfer');
    Route::get('/bank-transfer', 'ParentController@getBankTransferDetails');


    //Money Gram
    Route::get('/money-gram', 'PaymentMethod\MoneyGramController@index')->name('money.gram');
    Route::get('/money-gram/{id}', 'StudentController@moneygramReview');
    Route::get('moneygram-email', 'PaymentMethod\MoneyGramController@index');
    Route::get('/moneygram-transfer', 'ParentController@getMoneyGramDetails');

    Route::get('/coupon/apply/{code}', 'Admin\CouponController@applyCoupon')->name('coupon.apply');
    Route::get('/coupon/remove', 'Admin\CouponController@removeAppliedCoupon')->name('coupon.remove');


    Route::get('/mysettings/{id}', 'ParentController@mysettings');
    Route::get('/editaccount/{id}', 'ParentController@editmysettings');
    Route::post('/updateaccount/{id}', 'ParentController@updatemysettings')->name('update.account');
    Route::get('/reset', function () {
        return view('MyAccounts/resetpassword');
    })->name('reset.password');
    Route::post('reset/{id}', 'ParentController@updatePassword')->name('account-pass.update');
    // Route::get('/viewConfirmation/{id}', function () {
    //     return view('viewConfirmation');
    // })->name('view.confirm');
    Route::get('/viewConfirmation/{id}', 'StudentController@confirmationpage')->name('view.confirm');

    Route::get('generate-pdf/{id}', 'PDFController@generatePDF')->name('genrate.confirmition');
    // admin dashboard
    // Route::get('admin-dashboard', function () {
    //     return view('admin.home');
    // })->name('admin.admindashboard');
    //Transcript K-8
    Route::get('order-transcript/{id}', 'TranscriptController@index')->name('order-transcript');
    Route::get('view-enrollment/{id}', 'TranscriptController@viewEnrollment')->name('view.enrollment');
    Route::post('year', 'TranscriptController@create')->name('year');

    // Graduation Process
    Route::get('graduation', 'GraduationController@index')->name('graduation.apply');
    Route::get('graduation-application', 'GraduationController@gradutaionApplication')->name('graduation.application');
    Route::post('graduation', 'GraduationController@store')->name('graduation.store');
    Route::get('graduation/purchase/{id}', 'GraduationController@purchase')->name('graduation.purchase');

    // Graduation Process ends

    Route::get('student-transcript/{id}', 'TranscriptController@viewStudent')->name('transcript.studentInfo');

    Route::post('notify-student/{id}', 'TranscriptController@notification')->name('notify.studentInfo');
    Route::get('display-student/{id}/{transcriptdata_id}', 'TranscriptController@displayStudent')->name('display.studentProfile');
    Route::post('student-grade/{id}', 'TranscriptController@viewEnrollment')->name('update.studentProfile');
    Route::post('transcript-grade/{id}', 'TranscriptController@storeGrade')->name('transcript.grade');
    //save year
    Route::post('updateYear/{student_id}/{transcript_id}', 'TranscriptController@storeYear')->name('update.enrollYear');
    // final-submission.blade
    Route::get('submit/{student_id}/{transcript_id}', 'TranscriptController@submitTranscript')->name('submit.transcript');

    Route::get('transcript-submitted', function () {
        return view('transcript/final-submission');
    })->name('transcript.submitted');
    //Transcript K-8 Cources

    Route::get('english-course/{id}/{transcript_id}', 'Courses\EnglishController@index')->name('english.course');

    Route::post('english-course', 'Courses\EnglishController@store')->name('englishCourse.store');

    //social studies
    Route::get('social-studies/{student_id}/{transcript_id}', 'Courses\SocialStudiesController@index')->name('social.studies');
    Route::post('/social-studies', 'Courses\SocialStudiesController@store')->name('socialStudiesCourse.store');

    //mathematics 
    Route::get('mathematics/{student_id}/{transcript_id}', 'Courses\MathsController@index')->name('mathematics');
    Route::post('mathematics', 'Courses\MathsController@store')->name('mathematics.store');

    //physical education
    Route::get('physical-education/{student_id}/{transcript_id}', 'Courses\PhysicalEducationController@index')->name('physical.education');
    Route::post('physical-education', 'Courses\PhysicalEducationController@store')->name('physicalEducation.store');


    //health
    Route::get('health/{student_id}/{transcript_id}', 'Courses\HealthController@index')->name('health');
    Route::post('/health', 'Courses\HealthController@store')->name('health.store');
    //foreign languages
    Route::get('foreign/{student_id}/{transcript_id}', 'Courses\ForeignController@index')->name('foreign');
    Route::post('/foreign', 'Courses\ForeignController@store')->name('foreign.store');

    //another
    Route::get('another/{student_id}/{transcript_id}', 'Courses\AnotherCourseController@index')->name('another');
    Route::post('/another', 'Courses\AnotherCourseController@store')->name('another.store');

    //science
    Route::get('science/{student_id}/{transcript_id}', 'Courses\ScienceController@index')->name('science');
    Route::post('science', 'Courses\ScienceController@store')->name('science.store');

    // Route::get('preview-transcript', function () {
    //     return view('transcript/preview-transcript');
    // })->name('preview.transcript');

    Route::get('download-transcript/{transcrip_id}/{student_id}', 'TranscriptController@downlaodTranscript')->name('download.transcript');

    Route::get('fetchfile/{transcrip_id}/{student_id}', 'TranscriptController@fetchfile')->name('fetch.transcript');
    Route::get('preview-transcript/{student_id}', 'TranscriptController@previewTranscript')->name('preview.transcript');

    Route::get('new-grade/{student_id}/{transcript_id}', function () {
        return view('transcript/dashboard-another-languages');
    })->name('new-grade');

    Route::get('choose-another/{student_id}', 'Courses\AnotherCourseController@anotherGrade')->name('choose.another');
    Route::get('another-grade/{student_id}', 'Courses\AnotherCourseController@storeAnotherGrade')->name('another.grade');


    //another grade enrollment_year
    // Route::get('another-level/{student_id}', 'TranscriptController@viewAnotherEnrollment')->name('another.level');


    Route::get('all-course/{transcript_id}/{student_id}', 'TranscriptController@displayAllCourse')->name('displayAllCourse');
    Route::post('transcript/purchase/{id}', 'TranscriptController@purchase')->name('transcript.purchase');

    // Route::get('purchase-transcript', function () {
    //     return view('transcript/purchase-transcript');
    // })->name('purchase.transcript');



    //edit courses

    Route::get('edit-english/{student_id}/{transcript_id}', 'EditCourses\EditCourse@editEnglish')->name('edit.englishCourse');
    Route::post('edit-english', 'EditCourses\EditCourse@storeEnglish')->name('editEnglishCourse.store');

    Route::get('edit-social-studies/{student_id}/{transcript_id}', 'EditCourses\EditCourse@editSocialStudies')->name('edit.socialStudies');
    Route::post('edit-social', 'EditCourses\EditCourse@storeSocial', 'EditCourses\EditCourse@storeSocialStudies')->name('editSocialCourse.store');

    Route::get('edit-math/{student_id}/{transcript_id}', 'EditCourses\EditCourse@editMaths')->name('edit.mathsCourse');
    Route::post('edit-maths', 'EditCourses\EditCourse@storeMaths', 'EditCourses\EditCourse@storeMaths')->name('editMathCourse.store');

    Route::get('edit-science/{student_id}/{transcript_id}', 'EditCourses\EditCourse@editScience')->name('edit.scienceCourse');
    Route::post('edit-science', 'EditCourses\EditCourse@storeScience', 'EditCourses\EditCourse@storeScience')->name('editScienceCourse.store');

    Route::get('edit-physical-education/{student_id}/{transcript_id}', 'EditCourses\EditCourse@editPhysicalEducation')->name('edit.editPhysicaEducationCourse');
    Route::post('edit-physical-education', 'EditCourses\EditCourse@storePhysicalEducation')->name('editPhysicaEducationCourse.store');

    Route::get('edit-health/{student_id}/{transcript_id}', 'EditCourses\EditCourse@editHealth')->name('edit.editHealthCourse');
    Route::post('edit-health', 'EditCourses\EditCourse@storeHealth')->name('editHealthCourse.store');

    Route::get('edit-foreign/{student_id}/{transcript_id}', 'EditCourses\EditCourse@editForeign')->name('edit.foreignCourse');
    Route::post('edit/foreign', 'EditCourses\EditCourse@storeForeign')->name('editForeign.store');

    Route::get('edit-another/{student_id}/{transcript_id}', 'EditCourses\EditCourse@editAnother')->name('edit.AnotherCourse');
    Route::post('/edit/another', 'EditCourses\EditCourse@storeAnother')->name('editAnother.store');

    //delete school
    Route::get('delete/school/{transcript_id}', 'TranscriptController@deleteSchool')->name('delete.school');

    //Record Transfer
    Route::get('record/transfer/{parent_id}', 'RecordTransferController@index')->name('record.transfer');
});
