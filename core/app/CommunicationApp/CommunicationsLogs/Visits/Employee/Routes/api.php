<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\CommunicationApp\CommunicationsLogs\Visits\Employee\Controllers'], function () {
    Route::apiResource('visits', 'VisitsController');
});
