<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\CommunicationApp\Events\Employee\Controllers'], function () {
    Route::resource('events', 'EventsController')->except(['show', 'create', 'edit']);
//    Route::group(['prefix' => 'events', 'as' => 'events.'], function () {
//        Route::get('index/filters', 'EventsController@indexFilters')->name('index.filters');
//        Route::get('index/export', 'EventsController@export')->name('index.export');
//        Route::get('show', 'EventsController@show')->name('show');
//    });
});
