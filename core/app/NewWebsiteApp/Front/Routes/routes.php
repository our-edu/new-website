<?php

declare(strict_types = 1);

Route::group(['namespace'=>'\App\NewWebsiteApp\Front\Controllers'], function () {

    Route::get('/', 'FrontController@getIndex')->name('home');
    Route::get('/books', 'FrontController@books')->name('books');
    Route::get('/articles', 'FrontController@articles')->name('articles');

});
