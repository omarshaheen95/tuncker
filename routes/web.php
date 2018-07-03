<?php

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


Route::group(['prefix' => LaravelLocalization::setLocale() ], function () {

  Route::get('/', function () {
    return view('welcome');
  });
});
Route::group(['prefix' => LaravelLocalization::setLocale().'/admin'], function () {
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');

});

Route::group(['prefix' => LaravelLocalization::setLocale().'/school'], function () {
  Route::get('/login', 'SchoolAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'SchoolAuth\LoginController@login');
  Route::post('/logout', 'SchoolAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'SchoolAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'SchoolAuth\RegisterController@register');

  Route::post('/password/email', 'SchoolAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'SchoolAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'SchoolAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'SchoolAuth\ResetPasswordController@showResetForm');
});

Route::group(['prefix' => LaravelLocalization::setLocale().'/teacher'], function () {
  Route::get('/login', 'TeacherAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'TeacherAuth\LoginController@login');
  Route::post('/logout', 'TeacherAuth\LoginController@logout')->name('logout');

  Route::post('/password/email', 'TeacherAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'TeacherAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'TeacherAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'TeacherAuth\ResetPasswordController@showResetForm');
});
