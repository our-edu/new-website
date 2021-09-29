<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\CommunicationApp\Complains\Employee\Controllers'], function () {
    Route::apiResource('complains', 'ComplainsController')->except(['update','store','destroy']);
    Route::group(['prefix' => 'complains', 'as' => 'complains.'], function () {
        Route::get('index/export', 'ComplainsController@export')->name('index.export');
        Route::put('{complain}/resolve', 'ComplainsController@resolve')->name('resolve');
    });
});
