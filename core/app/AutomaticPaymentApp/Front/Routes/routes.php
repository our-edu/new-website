<?php

Route::group(['namespace'=>'\App\AutomaticPaymentApp\Front\Controllers'],function (){
    Route::get('/', function () {
        return view('welcome')->with(['loginEnabled'=>false,'registerEnabled'=>false]);
    });
    Route::post('/','FrontController@searchNationalId')->name('searchNationalId');
    Route::group(['prefix'=>'payment' ,'as'=>'payments'],function (){
        Route::get('/due_payment/{national_id}','FrontController@getPaymentView')->name('.getPaymentView');
        Route::post('/due_payment/{parentDue}','FrontController@getPaymentForm')->name('.getPaymentForm');
        Route::post('/process-return', 'FrontController@processReturn')->name('.processReturn');
    });

});
