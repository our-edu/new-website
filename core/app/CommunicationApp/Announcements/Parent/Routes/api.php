<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\CommunicationApp\Announcements\Parent\Controllers'], function () {
    Route::group(['prefix' => 'announcements', 'as' => 'announcements.'], function () {
        Route::get('web/view', 'AnnouncementsController@viewWeb')->name('web.view');
        Route::get('mobile/view', 'AnnouncementsController@viewMobile')->name('mobile.view');
    });
});
