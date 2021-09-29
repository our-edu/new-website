<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\CommunicationApp\Reports\Employee\Controllers','prefix'=>'reports'], function () {
    Route::get('/parent_activity', 'ReportsController@parentActivity')->name('parent_activity');
    Route::get('/parent_activity_export', 'ReportsController@parentActivityExport')->name('parent_activity_export');
});
