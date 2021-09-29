<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\CommunicationApp\CommunicationsLogs\Visits\Employee\Controllers'], function () {
    Route::apiResource('visits', 'VisitsController');
    Route::group(['prefix' => 'visits', 'as' => 'visits.'], function () {
        Route::get('index/export', 'VisitsController@export')->name('index.export');
    });
});
