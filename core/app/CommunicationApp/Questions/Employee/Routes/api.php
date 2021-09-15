<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\CommunicationApp\Questions\Employee\Controllers'], function () {
    Route::apiResource('questions', 'QuestionsController');
});
