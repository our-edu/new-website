<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\CommunicationApp\Announcements\Employee\Controllers'], function () {
    Route::resource('announcements', 'AnnouncementsController')->except(['create', 'edit']);
    Route::group(['prefix' => 'announcements', 'as' => 'announcements.'], function () {
        Route::get('index/filters', 'AnnouncementsController@indexFilters')->name('index.filters');
        Route::get('index/export', 'AnnouncementsController@export')->name('index.export');
    });
});
