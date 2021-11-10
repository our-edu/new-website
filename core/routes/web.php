<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group([
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function () {
    //Front Routes goes here
    require base_path('app/AutomaticPaymentApp/Front/Routes/routes.php');
    });
Route::group(['prefix'=>'admin'],function(){
    Auth::routes();
    //Admin Routes goes here
    Route::group(['middleware'=>'auth'],function(){
        require base_path('app/AutomaticPaymentApp/Admin/Routes/routes.php');
    });
});


