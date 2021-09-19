<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['as' => 'api.'], function () {
    Route::group(['middleware' => ['auth:api']], function () {
        Route::group(['prefix' => 'parent', 'as' => 'parent.',
            'middleware' => 'type:parent'
        ], function () {
//            require base_path('app/CommunicationAPP/Questions/Parent/Routes/api.php');
        });

        Route::group(['prefix' => 'employee', 'as' => 'employee.',
            'middleware' => 'type:employee'
        ], function () {
            require base_path('app/CommunicationApp/Announcements/Employee/Routes/api.php');
            require base_path('app/CommunicationApp/Questions/Employee/Routes/api.php');
        });
    });
});
