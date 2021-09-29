<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\CommunicationApp\Reports\Employee\Controllers','prefix'=>'reports','as'=>'reports'], function () {
    Route::get('/parent_activity', 'ReportsController@parentActivityList')->name('.parent_activity.index');
    Route::get('parent_activity/{parent_uuid}', 'ReportsController@parentActivityShow')->name('.parent_activity.show');
    Route::get('/parent_activity_export', 'ReportsController@parentActivityExport')->name('.parent_activity_export');
});
