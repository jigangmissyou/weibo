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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'StaticPagesController@home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');
Route::get('/register', 'UserController@create')->name('register');
Route::resource('users', 'UserController');
Route::get('login', 'SessionController@create')->name('login');
Route::post('login','SessionController@store')->name('login');
Route::get('logout', 'SessionController@destroy')->name('logout');
Route::get('password/reset',  'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email',  'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/reset','Auth\ResetPasswordController@reset')->name('password.reset');
Route::get('register/confirm/{token}', 'UserController@confirmEmail')->name('confirm_email');
Route::resource('statuses', 'StatusesController', ['only'=>['store','destroy']]);
Route::get('users/{user}/followings', 'UserController@followings')->name('users.followings');
Route::get('users/{user}/follower','UserController@followers')->name('users.followers');  //显示用户的粉丝列表
Route::post('/users/followers/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('/users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');
