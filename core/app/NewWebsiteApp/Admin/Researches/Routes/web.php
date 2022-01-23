<?php

Route::group(['prefix' => 'researches','namespace' => '\App\NewWebsiteApp\Admin\Researches\Controllers'], function () {
    Route::get('/', 'ResearchesController@index')->name('researches.index');

    Route::get('/create', 'ResearchesController@create');
    Route::post('/create', 'ResearchesController@store');

    Route::get('/view/{id}', 'ResearchesController@show')->name('researches.show');

    Route::get('/edit/{id}', 'ResearchesController@edit');
    Route::put('/edit/{id}', 'ResearchesController@update');

    Route::delete('/delete/{id}', 'ResearchesController@destroy')->name('researches.delete');
});
