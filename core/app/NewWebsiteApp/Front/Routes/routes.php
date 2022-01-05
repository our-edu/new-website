<?php

declare(strict_types = 1);

Route::group(['namespace'=>'\App\AutomaticPaymentApp\Front\Controllers'], function () {
    Route::get('/', function () {
        return view('Front.index');
    })->name('home');
});
