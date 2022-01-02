<?php

    Route::group(['prefix' => 'contact_us','namespace' => '\App\NewWebsiteApp\Admin\ContactUs\Controllers'], function () {

    Route::get('/', 'ContactUsController@index')->name('ContactUs');
    Route::get('/view/{id}', 'ContactUsController@show')->name('ContactUs.show');
    Route::delete('/delete/{id}', 'ContactUsController@destroy')
        ->name('contactUs.delete');
});
