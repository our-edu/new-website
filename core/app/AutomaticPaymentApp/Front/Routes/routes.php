<?php

Route::group(['namespace'=>'\App\AutomaticPaymentApp\Front\Controllers'],function (){
    Route::get('/', function () {
        return view('welcome');
    });
    Route::post('/','FrontController@searchNationalId')->name('searchNationalId');
});
