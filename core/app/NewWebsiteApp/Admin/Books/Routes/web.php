<?php

Route::group(['prefix' => 'books','namespace' => '\App\NewWebsiteApp\Admin\Books\Controllers'], function () {
    Route::get('/', 'BooksController@index')->name('books.index');

    Route::get('/create', 'BooksController@create');
    Route::post('/create', 'BooksController@store');
    Route::get('/edit/{id}', 'BooksController@edit');
    Route::put('/edit/{id}', 'BooksController@update');

    Route::delete('/delete/{id}', 'BooksController@destroy')->name('books.delete');
});
