<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\CommunicationApp\Complains\Employee\Controllers'], function () {
    Route::apiResource('complains', 'ComplainsController')->except(['update','store','destroy']);
    Route::put('complains/{complain}/resolve', 'ComplainsController@resolve')->name('complains.resolve');
});
