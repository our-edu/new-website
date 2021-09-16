<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\CommunicationApp\Settings\Employee\Controllers'], function () {
    Route::apiResource('generalSettings','GeneralSettingsController')->except(['store','destroy']);
    Route::put('generalSettings/{id}/questionnaire', 'GeneralSettingsController@updateQuestionnaireStatus')->name('generalSettings.updateQuestionnaire');
});
