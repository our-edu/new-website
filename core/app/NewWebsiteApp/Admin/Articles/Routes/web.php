<?php

Route::group(['prefix' => 'articles','namespace' => '\App\NewWebsiteApp\Admin\Articles\Controllers'], function () {
    Route::get('/', 'ArticlesController@index')->name('articles.index');

    Route::get('/create', 'ArticlesController@create');
    Route::post('/create', 'ArticlesController@store');

    Route::get('/view/{id}', 'ArticlesController@show')->name('articles.show');

    Route::get('/edit/{id}', 'ArticlesController@edit');
    Route::put('/edit/{id}', 'ArticlesController@update');

    Route::delete('/delete/{id}', 'ArticlesController@destroy')->name('articles.delete');
});
