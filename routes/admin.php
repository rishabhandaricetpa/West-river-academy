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


Route::group(
    ['namespace' => 'admin'],
    function () {
        Route::get('logout', function () {
            Auth::guard('admin')->logout();
            return redirect('/admin/login');
        })->name('admin.logout');
    }
);
Route::get('view', 'ParentController@index')->name('view.parent');
Route::get('edit/{id}', 'ParentController@edit')->name('parent.edit');
Route::post('update/parent/{id}', 'ParentController@update')->name('parent.update');
Route::get('delete/parent/{id}', 'ParentController@destroy')->name('parent.delete');

Route::get('view-student', 'StudentProfileController@index')->name('view-student');
Route::get('edit-student/{id}', 'StudentProfileController@edit')->name('edit-student');
Route::post('update/{id}', 'StudentProfileController@update')->name('edit-student.update');
Route::get('delete/{id}', 'StudentProfileController@destroy')->name('delete.student');
Route::get('deactive/{id}', 'Auth\RegisterController@dactive')->name('deactive.student');

Route::get('coupon', 'CouponController@index')->name('view.coupon');
Route::get('coupon/create', 'CouponController@create')->name('create.coupon');
Route::get('coupon/{id}/edit', 'CouponController@edit')->name('edit.coupon');
Route::post('coupon', 'CouponController@store')->name('store.coupon');
Route::get('coupon/data', 'CouponController@dataTable')->name('coupons.dt');
Route::get('coupon/generate', 'CouponController@getCode')->name('coupons.generate');



