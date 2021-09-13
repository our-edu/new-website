<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\BoilerplateApp\Applications\Employee\Controllers'], function () {
    Route::resource('applications', 'ApplicationController')->only(['index', 'show']);
    Route::get('applications/{childApplication}/details', 'ApplicationController@details')->name('applications.details');
    //Route::put('applications/{application}/pendingInterview', 'ApplicationController@interviewStatus')->name('applications.interviewStatus');
    //Route::put('applications/{application}/pendingHard', 'ApplicationController@hardCopyStatus')->name('applications.hardCopyStatus');
    //Route::put('applications/{application}/pendingPayment', 'ApplicationController@paymentStatus')->name('applications.paymentStatus');
    //Route::put('applications/{application}/return', 'ApplicationController@returnStatus')->name('applications.return');
   // Route::put('applications/{application}/accept', 'ApplicationController@acceptStatus')->name('applications.accept');
    Route::put('applications/{application}/reject', 'ApplicationController@rejectStatus')->name('applications.reject');
});
