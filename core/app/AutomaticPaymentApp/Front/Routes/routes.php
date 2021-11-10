<?php

Route::group(['namespace'=>'\App\AutomaticPaymentApp\Front\Controllers'],function (){
    Route::get('/', function () {
        return view('welcome')->with(['loginEnabled'=>false,'registerEnabled'=>false]);
    });
    Route::post('/','FrontController@searchNationalId')->name('searchNationalId');
});
