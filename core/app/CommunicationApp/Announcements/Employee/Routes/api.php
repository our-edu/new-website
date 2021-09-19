<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\CommunicationApp\Announcements\Employee\Controllers'], function () {
    Route::resource('announcements', 'AnnouncementsController')->except(['create', 'edit']);
});
