<?php

Route::group(['prefix' => 'articles','namespace' => '\App\NewWebsiteApp\Admin\Articles\Controllers'], function () {
    Route::get('/', 'ArticlesController@getIndex')->name('articles.index');

    Route::get('/create', 'ArticlesController@getCreate');
    Route::post('/create', 'ArticlesController@postCreate');

//    Route::get('/post/{id}', 'ArticlesController@show')->name('posts.show');
//
//    Route::get('/all-posts', 'ArticlesController@all')->name('posts.all');

    Route::get('/edit/{id}', 'ArticlesController@getEdit');
    Route::put('/edit/{id}', 'ArticlesController@postEdit');

    Route::delete('/delete/{id}', 'ArticlesController@getDelete')->name('articles.delete');
});
