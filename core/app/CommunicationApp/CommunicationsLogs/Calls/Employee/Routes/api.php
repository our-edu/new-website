<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\CommunicationApp\CommunicationsLogs\Calls\Employee\Controllers'], function () {
    Route::apiResource('calls', 'CallsController');
    Route::group(['prefix' => 'calls', 'as' => 'calls.'], function () {
        Route::get('index/export', 'CallsController@export')->name('index.export');
    });
});
