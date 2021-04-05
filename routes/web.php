<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Notification;

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

    Route::group(['middleware' => ['auth', 'active_user']], function () {
        Route::get('/welcome-video', function () {
            return view('welcome-video');
        });

        Route::get('/reviewstudent/{id}', 'StudentController@reviewStudent')->name('reviewstudent');

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

        Route::get('edit/address/{id}', 'ParentController@address')->name('edit.address');
        Route::post('/cart-billing', 'ParentController@saveaddress')->name('billing.address');

        Route::get('generate-pdf/{student_id}', 'PDFController@generatePDF')->name('genrate.confirmition');
        // admin dashboard

        Route::get('previous-school', function () {
            return view('previous-school');
        }); 
        Route::get('order-postage', function () {
            return view('frontendpages.order-postage');
        }); 

        Route::get('college-info', function () {
            return view('frontendpages.college-info');
        });

        Route::get('college-info', function () {
            return view('frontendpages.college-info');
        });

        Route::get('notification', function () {
            return Notification::getParentNotifications();
        })->name('notification.get');
    });

    //Paypal Payment
    Route::get('payment', function () {
        return view('paywithpaypal');
    })->name('paywithpaypal');
    Route::post('paypal', 'PaymentMethod\PaypalPaymentController@postPaymentWithpaypal');
    Route::get('status', 'PaymentMethod\PaypalPaymentController@getPaymentStatus')->name('status');
    Route::get('payment/{id}', 'StudentController@paypalorderReview')->name('paypal.order');
    Route::get('thankyou', function () {
        return view('Billing.thankyou-paypal');
    })->name('thankyou.paypal');
    //Stripe Payment

    Route::get('/stripe-payment/{id}', 'StudentController@stripeorderReview')->name('edit.stripe');
    Route::post('/stripe-payment', 'PaymentMethod\StripeController@handlePost')->name('stripe.payment');
    Route::get('paymentinfo', function () {
        return view('Billing/paymentsuccess');
    })->name('payment.info');

    //Money-order
    Route::get('/money-order', 'PaymentMethod\MoneyOrderController@index')->name('money.order');
    Route::get('/money-order/{id}', 'StudentController@moneyorderReview');
    Route::get('moneyorder-email/{amount}', 'PaymentMethod\MoneyOrderController@index')->name('moneyorder-email');

    //Bank Transfer
    Route::get('order-review', function () {
        return view('Billing/order-review');
    })->name('order.review');
    Route::get('order-review/{id}', 'StudentController@orderReview');
    Route::get('bankTransfer/{amount}', 'PaymentMethod\BankTranferController@index')->name('bank.transfer');
    Route::get('/bank-transfer', 'ParentController@getBankTransferDetails');

    //Money Gram
    Route::get('/money-gram', 'PaymentMethod\MoneyGramController@index')->name('money.gram');
    Route::get('/money-gram/{id}', 'StudentController@moneygramReview');
    Route::get('moneygram-email/{amount}', 'PaymentMethod\MoneyGramController@index')->name('moneygram-email');
    Route::get('/moneygram-transfer', 'ParentController@getMoneyGramDetails');

    Route::get('/coupon/apply/{code}', 'Admin\CouponController@applyCoupon')->name('coupon.apply');
    Route::get('/coupon/remove', 'Admin\CouponController@removeAppliedCoupon')->name('coupon.remove');

    Route::get('/mysettings', 'ParentController@mysettings')->name('mysetting');
    Route::get('/editaccount/{id}', 'ParentController@editmysettings');
    Route::post('/updateaccount/{id}', 'ParentController@updatemysettings')->name('update.account');
    Route::get('/reset', function () {
        return view('MyAccounts/resetpassword');
    })->name('reset.password');
    Route::post('reset/{id}', 'ParentController@updatePassword')->name('account-pass.update');

    Route::get('/viewConfirmation/{student_id}', 'StudentController@confirmationpage')->name('view.confirm');

    //fees and services
    Route::get('fees', 'FeeStructureController@viewdata')->name('fees');

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

    Route::get('student-transcript/{student_id}', 'TranscriptController@purchaseNew')->name('transcript.studentInfo');
    Route::get('create-transcript/{transcript_id}/{student_id}', 'TranscriptController@createTranscript')->name('transcript.create');
    Route::get('viewall-transcript/{student_id}', 'TranscriptController@getAllTranscript')->name('transcript.viewall');


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

    Route::get('custom-payments', 'PaymentMethod\CustomPaymentsController@index')->name('custom.payment');
    Route::get('admin/custom-payments/{id}', 'PaymentMethod\CustomPaymentsController@edit')->name('edit.custompayment');
    Route::post('update/custom-payments/{id}', 'PaymentMethod\CustomPaymentsController@updateCustomPayments')->name('update.custompayment');
    Route::get('delete/custom-payments/{id}', 'PaymentMethod\CustomPaymentsController@destroyCustomPayments')->name('delete.custompayment');


    Route::get('download-transcript/{transcrip_id}/{student_id}', 'TranscriptController@downlaodTranscript')->name('download.transcript');
    Route::get('edit-transcript/{transcrip_id}/{student_id}', 'TranscriptController@editApprovedTranscript')->name('edit.transcript');

    Route::get('fetchfile/{transcrip_id}/{student_id}', 'TranscriptController@fetchfile')->name('fetch.transcript');
    Route::get('preview-transcript/{student_id}/{trans_id}', 'TranscriptController@previewTranscript')->name('preview.transcript');

    Route::get('new-grade/{student_id}/{transcript_id}', function () {
        return view('transcript/dashboard-another-languages');
    })->name('new-grade');

    Route::get('choose-another/{student_id}/{trans_id}', 'Courses\AnotherCourseController@anotherGrade')->name('choose.another');
    Route::get('another-grade/{student_id}/{trans_id}', 'Courses\AnotherCourseController@storeAnotherGrade')->name('another.grade');
    Route::post('another/required', 'Courses\AnotherCourseController@anotherGradeRequired')->name('another.grade.requirement');

    Route::get('all-course/{transcript_id}/{student_id}', 'TranscriptController@displayAllCourse')->name('displayAllCourse');
    Route::post('transcript/purchase/{id}', 'TranscriptController@purchase')->name('transcript.purchase');

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
    Route::get('record/request/{student_id}/{parent_id}', 'RecordTransferController@sendRecordRequest')->name('record.send');
    Route::post('record/save/{student_id}/{parent_id}', 'RecordTransferController@storeRecordRequest')->name('record.store');
    Route::get('record/edit/{id}', 'RecordTransferController@editRecordRequest')->name('edit.record');
    Route::post('record/edit/update/{id}', 'RecordTransferController@updateStoreRecordRequest')->name('edit.record.store');
    Route::get('notarization', 'NotarizationController@index')->name('notarization');
    Route::post('notarization/save', 'NotarizationController@store')->name('notarization.save');


    Route::post('assign/dashboard', 'Admin\DashboardController@assignRecord')->name('dashboard.update');
    Route::post('update/dashboard', 'Admin\DashboardController@updateDashboard');
    //order Postage
    Route::get('orderpostage', function () {
        return view('orderPostage/purchase_postage');
    });
    Route::get('custom-letter', 'PaymentMethod\CustomLetterController@index')->name('custom.letter');

    // transcript 9-12

    Route::get('select/country/{student_id}/{transcript_id}', 'TranscriptController\Transcript9to12@selectCountry')->name('selecting.country');
    Route::post('select/grade/{student_id}', 'TranscriptController\Transcript9to12@selectGrade')->name('select.grade');
    Route::post('select/enrollmentyear/{student_id}', 'TranscriptController\Transcript9to12@enrollSchool')->name('enrollSchool');
    Route::post('choose/apcourse/{student_id}', 'TranscriptController\Transcript9to12@enrollYear')->name('select.apCourse');
    Route::post('apCourses/{student_id}', 'TranscriptController\Transcript9to12@apCourses')->name('apCourse');
    Route::get('preview-transcript9_12/{student_id}/{trans_id}', 'TranscriptController\Transcript9to12@previewTranscript')->name('preview.transcript9_12');

    // ap course
    Route::post('apcourse/store', 'TranscriptController\Transcript9to12@storeApCourses')->name('apCourse.store');
    // transcript courses

    // english course
    Route::get('english-transcript/{student_id}/{transcript_id}', 'TranscriptCourses\EnglishCourse@index')->name('english.transcript.course');
    Route::post('english-transcript', 'TranscriptCourses\EnglishCourse@store')->name('english-transcript.store');

    //mathematics course
    Route::get('mathematics-transcript/{student_id}/{transcript_id}', 'TranscriptCourses\MathematicsCourse@index')->name('maths.transcript.course');
    Route::post('maths-transcript', 'TranscriptCourses\MathematicsCourse@store')->name('maths-transcript.store');

    // histroy 
    Route::get('socialStudies/{student_id}/{transcript_id}', 'TranscriptCourses\SocialStudiesCourse@index')->name('socialScience.transcript.course');
    Route::post('social-studies-store', 'TranscriptCourses\SocialStudiesCourse@store')->name('socialStudies-transcript.store');

    //science
    Route::get('science-transcript/{student_id}/{transcript_id}', 'TranscriptCourses\ScienceCourse@index')->name('socialScience.transcript.course');
    Route::post('science-transcript', 'TranscriptCourses\ScienceCourse@store')->name('science-transcript.store');

    //physical education
    Route::get('physicalEducation-transcript/{student_id}/{transcript_id}', 'TranscriptCourses\PhysicalEducationCourse@index')->name('physcialEducation.transcript.course');
    Route::post('physicalEducation', 'TranscriptCourses\PhysicalEducationCourse@store')->name('physicalEducation-transcript.store');

    //health course
    Route::get('healthCourse-transcript/{student_id}/{transcript_id}', 'TranscriptCourses\HealthCourse@index')->name('healthCourse-transcript');
    Route::post('health-store', 'TranscriptCourses\HealthCourse@store')->name('healthEducation-transcript.store');

    //foreign course 
    Route::get('/foreignCourse-transcript/{student_id}/{transcript_id}', 'TranscriptCourses\ForeignCourse@index')->name('foreignCourse-transcript');
    Route::post('foreignCourse', 'TranscriptCourses\ForeignCourse@store')->name('foreign-transcript.store');

    //another courses
    Route::get('/anotherCourse-transcript/{student_id}/{transcript_id}', 'TranscriptCourses\AnotherCourse@index')->name('anotherCourse-transcript');
    Route::post('anotherCourse', 'TranscriptCourses\AnotherCourse@store')->name('another-transcript.store');

    // another grade
    Route::get('another-grade-transcript/{student_id}/{trans_id}/{transcript9_12id}', 'TranscriptController\Transcript9to12@anotherGrade')->name('another.transcript.grade');
    Route::post('all-students-grades', 'TranscriptController\Transcript9to12@getAnotherGradeStatus')->name('another-transcript9_12.required');

    // student college information

    Route::post('student-college/{student_id}', 'TranscriptController\CollegeController@addCollege')->name('collegeDetails');
    Route::post('college-course', 'TranscriptController\CollegeController@store')->name('collegeCourse.store');

    // display all courses
    Route::get('display-all-grades/{student_id}/{transcript_id}', 'TranscriptController\Transcript9to12@displayAllGrades')->name('display.grades');

    //operation - delete and edit in transript 9-12
    Route::get('delete/school-transcript/{transcript_id}', 'TranscriptController\Transcript9to12@deleteSchool')->name('delete.transcript.school');
    //Route::get('course-details/{transcript_id}/{student_id}', 'TranscriptController\Transcript9to12@displayAllCourse')->name('displayCourseDetails');

    //show specific course details

    Route::get('display-course-details/{transcript_id}/{student_id}', 'TranscriptController\Transcript9to12@showCourseDetails')->name('showCourseDetails');

    // edit course

    //english edit transcript
    Route::get('edit-transcript-english/{student_id}/{transcript_id}', 'EditTranscript9_12Courses\EditCourse@editEnglish')->name('edit.englishTranscriptCourse');
    Route::post('edit-transcript-english', 'EditTranscript9_12Courses\EditCourse@storeEnglish')->name('editEnglishTranscriptCourse.store');

    //mathematics edit transcript
    Route::get('edit-mathematics-transcript/{student_id}/{transcript_id}', 'EditTranscript9_12Courses\EditCourse@editMathematics')->name('edit.mathematicsTranscriptCourse');
    Route::post('edit-mathematics-transcript', 'EditTranscript9_12Courses\EditCourse@storeMathematics')->name('editMathematicsTranscriptCourse.store');

    //social science 
    Route::get('edit-socialScience-transcript/{student_id}/{transcript_id}', 'EditTranscript9_12Courses\EditCourse@editSocialScience')->name('edit.SocialScienceTranscriptCourse');
    Route::post('edit-socialScience-transcript', 'EditTranscript9_12Courses\EditCourse@storeSocialScience')->name('editSocialScienceTranscriptCourse.store');

    //science 
    Route::get('edit-science-transcript/{student_id}/{transcript_id}', 'EditTranscript9_12Courses\EditCourse@editScience')->name('edit.ScienceTranscriptCourse');
    Route::post('edit-science-transcript', 'EditTranscript9_12Courses\EditCourse@storeScience')->name('editScienceTranscriptCourse.store');

    //physical Education
    Route::get('edit-physicalEducation-transcript/{student_id}/{transcript_id}', 'EditTranscript9_12Courses\EditCourse@editPhysicalEducation')->name('edit.PhysicalEducationTranscriptCourse');
    Route::post('edit-physicalEducation-transcript', 'EditTranscript9_12Courses\EditCourse@storePhysicalEducation')->name('editPhysicalEducationTranscriptCourse.store');
    //health edit transcript
    Route::get('edit-health-transcript/{student_id}/{transcript_id}', 'EditTranscript9_12Courses\EditCourse@editHealth')->name('edit.healthTranscriptCourse');
    Route::post('edit-health-transcript', 'EditTranscript9_12Courses\EditCourse@storeHealth')->name('editHealthTranscriptCourse.store');

    //Foreign language edit transcript
    Route::get('edit-foreign-transcript/{student_id}/{transcript_id}', 'EditTranscript9_12Courses\EditCourse@editForeign')->name('edit.foreignTranscriptCourse');
    Route::post('edit-foreign-transcript', 'EditTranscript9_12Courses\EditCourse@storeForeign')->name('editForeignTranscriptCourse.store');

    //elective edit transcript
    Route::get('edit-elective-transcript/{student_id}/{transcript_id}', 'EditTranscript9_12Courses\EditCourse@editElective')->name('edit.electiveTranscriptCourse');
    Route::post('edit-elective-transcript', 'EditTranscript9_12Courses\EditCourse@storeElective')->name('editElectiveTranscriptCourse.store');
});
