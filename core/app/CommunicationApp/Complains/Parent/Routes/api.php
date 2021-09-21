<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\CommunicationApp\Complains\Parent\Controllers'], function () {
    Route::apiResource('complains', 'ComplainsController')->except(['update','destroy']);
});
