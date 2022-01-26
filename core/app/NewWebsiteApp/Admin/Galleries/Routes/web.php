<?php

declare(strict_types = 1);

Route::group(['prefix' => 'galleries','namespace' => '\App\NewWebsiteApp\Admin\Galleries\Controllers'], function () {
    Route::get('/', 'GalleriesController@index')->name('galleries.index');

    Route::get('/create', 'GalleriesController@create');
    Route::post('/create', 'GalleriesController@store');

    Route::get('/view/{id}', 'GalleriesController@show')->name('galleries.show');

    Route::get('/edit/{id}', 'GalleriesController@edit');
    Route::put('/edit/{id}', 'GalleriesController@update');

    Route::delete('/delete/{id}', 'GalleriesController@destroy')->name('galleries.delete');
});
