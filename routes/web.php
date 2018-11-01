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


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

Auth::routes();


Route::get('/test', function () {
    return view('welcome');
});
Route::get('/', function () {
    if (Auth::check()) {
        return Redirect::to('/admin-home');
    }
    return view('pages.login.login');
});


Route::get('/login', function () {
    return view('pages.login.login');
});
Route::post('/login-check', 'HomeController@doLogin');
Route::get('/logout', 'HomeController@doLogout');
Route::get('/admin-home', 'AdminController@home');
Route::any('/sms/excel/send', 'AdminController@sendSms');
Route::any('/sms/single/send', 'AdminController@sendToSingle');
Route::any('/sms/multiple/send', 'AdminController@sendToMany');

//Report
Route::get('/report/sms', 'AdminController@statistics');
Route::get('/report/recharge', 'RechargeController@show');

//Rechatge
Route::get('/recharge/process', 'RechargeController@index');
Route::any('/recharge/make', 'RechargeController@create');