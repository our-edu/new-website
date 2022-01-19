<?php

declare(strict_types = 1);

Route::group(['namespace'=>'\App\NewWebsiteApp\Front\Controllers'], function () {

    Route::get('/', 'FrontController@getIndex')->name('home');
    Route::get('/books', 'FrontController@books')->name('books');
    Route::get('/articles', 'FrontController@articles')->name('articles');
    Route::get('/profile', 'FrontController@profile')->name('profile');
    Route::get('/activities', 'FrontController@activities')->name('activities');
    Route::get('/contact_us', 'FrontController@contact')->name('contact_us');
    Route::get('/gallery', 'FrontController@gallery')->name('gallery');
    Route::get('/videos', 'FrontController@videos')->name('videos');

});
