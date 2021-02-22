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
        Route::get('/cart', function () {
            return view('cart');
        });

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

        //working blades by frontend
        Route::get('bankinfo', function () {
            return view('mail/bankinfo');
        });

        Route::get('/transcript-wizard-dashboard', function () {
            return view('transcript-wizard-dashboard');
        });

        Route::get('/purchase-transcript', function () {
            return view('purchase-transcript');
        });

        Route::get('/transcript-wizard-grade', function () {
            return view('transcript-wizard-grade');
        });

        Route::get('/transcript-pdf', function () {
            return view('transcript-pdf');
        });

        Route::get('/reviewstudent', function () {
            return view('reviewstudent');
        });

        Route::get('/graduation-2', function () {
            return view('graduation-2');
        });

        Route::get('/transcript-wizard', function () {
            return view('transcript-wizard');
        });

        Route::get('/graduation-app', function () {
            return view('graduation-app');
        });

        Route::get('/graduation-app-grade', function () {
            return view('graduation-app-grade');
        });

        Route::get('/app-approve', function () {
            return view('app-approve');
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
    Route::get('display-student/{id}', 'TranscriptController@displayStudent')->name('display.studentProfile');
    Route::post('student-grade/{id}', 'TranscriptController@viewEnrollment')->name('update.studentProfile');
    Route::post('enroll-year', 'TranscriptController@storeEnrollmentYear')->name('transcript.enrollment_year');
    Route::post('transcript-grade/{id}', 'TranscriptController@storeGrade')->name('transcript.grade');
    Route::post('english-course/{id}', 'TranscriptController@storeYear')->name('transcript.enrollment_year');

    //Transcript K-8 Cources

    //english course
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

    Route::get('download-transcript', function () {
        return view('transcript/download-transcript');
    })->name('download.transcript');
    Route::get('generate-transcript/{id}', 'TranscriptController@genrateTranscript')->name('genrate.transcript');

    Route::get('new-grade/{student_id}/{transcript_id}', function () {
        return view('transcript/dashboard-another-languages');
    })->name('new-grade');

    Route::get('another-grade/{student_id}', 'Courses\AnotherCourseController@anotherGrade');
    Route::post('another-grade/{student_id}', 'Courses\AnotherCourseController@storeAnotherGrade')->name('another.grade');
    Route::get('students-transcript/{student_id}', function () {
        return view('transcript-wizard-dashboard');
    })->name('student.transcript');

    //another grade enrollment_year
    Route::get('another-level/{student_id}', 'TranscriptController@viewAnotherEnrollment')->name('another.level');
});
