<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\CommunicationApp\Complains\Employee\Controllers'], function () {
    Route::apiResource('complains', 'ComplainsController');
});
