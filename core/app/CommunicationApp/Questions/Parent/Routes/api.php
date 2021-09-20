<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\CommunicationApp\Questions\Parent\Controllers'], function () {
    Route::get('questions', 'QuestionsController@index')->name('questions.index');
});
