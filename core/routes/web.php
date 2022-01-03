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

require base_path('app/NewWebsiteApp/Front/Routes/routes.php');

Route::group(['prefix'=>'admin'], function () {
    Auth::routes(['register' => false]);
    //Admin Routes goes here
    Route::group(['middleware'=>'auth'], function () {
        require base_path('app/NewWebsiteApp/Admin/Routes/routes.php');
        require base_path('app/NewWebsiteApp/Admin/Articles/Routes/web.php');
        require base_path('app/NewWebsiteApp/Admin/ContactUs/Routes/web.php');
        require base_path('app/NewWebsiteApp/Admin/Books/Routes/web.php');
        require base_path('app/NewWebsiteApp/Admin/Events/Routes/web.php');
        require base_path('app/NewWebsiteApp/Admin/Videos/Routes/web.php');
        require base_path('app/NewWebsiteApp/Admin/Galleries/Routes/web.php');
    });
});
