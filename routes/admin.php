<?php

use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', 'HomeController@index')->name('home');

// Login
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
Route::get('view', 'ParentController@parentData')->name('view');
Route::get('view-student', 'StudentProfileController@index')->name('view-student');

Route::get('edit-student/{id}', 'StudentProfileController@edit')->name('edit-student');
Route::post('update/{id}', 'StudentProfileController@update')->name('edit-student.update');
Route::get('delete/{id}', 'StudentProfileController@destroy')->name('delete.student');



