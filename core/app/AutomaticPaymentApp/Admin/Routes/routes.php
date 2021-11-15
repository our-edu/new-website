<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\AutomaticPaymentApp\Admin\Controllers'], function () {
    Route::get('parents', 'AdminController@index')->name('parents.index');
    Route::get('transactions', 'AdminController@indexTransactions')->name('transactions.index');
    Route::post('import', 'AdminController@import')->name('import');
    Route::get('parents/import', 'AdminController@importView')->name('import.view');
    Route::get('export', 'AdminController@export')->name('export');
});
