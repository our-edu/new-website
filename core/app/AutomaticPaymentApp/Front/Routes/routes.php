<?php

Route::group(['namespace'=>'\App\AutomaticPaymentApp\Front\Controllers'],function (){
    Route::get('/', function () {
        return view('welcome')->with(['loginEnabled'=>false,'registerEnabled'=>false]);
    });
    Route::post('/','FrontController@searchNationalId')->name('searchNationalId');
    Route::get('/due_payment/{national_id}','FrontController@getPaymentView')->name('getPaymentView');
    Route::post('/due_payment_form/','FrontController@getPaymentForm')->name('getPaymentForm');
});
