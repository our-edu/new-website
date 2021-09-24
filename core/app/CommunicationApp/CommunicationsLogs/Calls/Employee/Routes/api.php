<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\CommunicationApp\CommunicationsLogs\Calls\Employee\Controllers'], function () {
    Route::apiResource('calls', 'CallsController');
});
