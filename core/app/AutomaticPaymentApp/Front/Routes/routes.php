<?php

declare(strict_types = 1);

Route::group(['namespace'=>'\App\AutomaticPaymentApp\Front\Controllers'], function () {
    Route::get('/', function () {
        return view('welcome')->with(['loginEnabled'=>true,'registerEnabled'=>true]);
    })->name('home');
    Route::post('/', 'FrontController@searchNationalId')->name('searchNationalId');
    Route::group(['prefix'=>'payment' ,'as'=>'payments'], function () {
        Route::get('/due_payment/{national_id}', 'FrontController@getPaymentView')->name('.getPaymentView');
        Route::post('/due_payment/', 'FrontController@getPaymentForm')->name('.getPaymentForm');
        Route::post('/process-return', 'FrontController@processReturn')->name('.processReturn');
        Route::get('/processpdf', 'FrontController@processReturnPdf')->name('.processReturnPdf');
    });
});
