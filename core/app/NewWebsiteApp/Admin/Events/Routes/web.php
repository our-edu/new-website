<?php

Route::group(['prefix' => 'events','namespace' => '\App\NewWebsiteApp\Admin\Events\Controllers'], function () {
    Route::get('/', 'EventsController@index')->name('events.index');

    Route::get('/create', 'EventsController@create');
    Route::post('/create', 'EventsController@store');
    Route::get('/view/{id}', 'EventsController@show')->name('events.show');
    Route::get('/edit/{id}', 'EventsController@edit');
    Route::put('/edit/{id}', 'EventsController@update');

    Route::delete('/delete/{id}', 'EventsController@destroy')->name('events.delete');
});
