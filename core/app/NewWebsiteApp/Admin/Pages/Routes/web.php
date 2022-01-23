<?php

Route::group(['prefix' => 'pages','namespace' => '\App\NewWebsiteApp\Admin\Pages\Controllers'], function () {
    Route::get('/', 'PagesController@index')->name('pages.index');

    Route::get('/create', 'PagesController@create');
    Route::post('/create', 'PagesController@store');

    Route::get('/view/{id}', 'PagesController@show')->name('pages.show');

    Route::get('/edit/{id}', 'PagesController@edit');
    Route::put('/edit/{id}', 'PagesController@update');

    Route::delete('/delete/{id}', 'PagesController@destroy')->name('pages.delete');
});
