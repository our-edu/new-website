<?php

Route::group(['prefix' => 'videos','namespace' => '\App\NewWebsiteApp\Admin\Videos\Controllers'], function () {
    Route::get('/', 'VideosController@index')->name('videos.index');

    Route::get('/create', 'VideosController@create');
    Route::post('/create', 'VideosController@store');

    Route::get('/view/{id}', 'VideosController@show')->name('videos.show');

    Route::get('/edit/{id}', 'VideosController@edit');
    Route::put('/edit/{id}', 'VideosController@update');

    Route::delete('/delete/{id}', 'VideosController@destroy')->name('videos.delete');
});
