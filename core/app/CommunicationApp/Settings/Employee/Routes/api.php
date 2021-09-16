<?php

declare(strict_types = 1);

Route::group(['namespace' => '\App\CommunicationApp\Settings\Employee\Controllers','as'=>'generalSettings'], function () {
    Route::get('generalSettings', 'GeneralSettingsController@index')->name('.index');
    Route::get('generalSettings/{generalSetting}', 'GeneralSettingsController@show')->name('.show');
    Route::put('generalSettings/{generalSetting}', 'GeneralSettingsController@update')->name('.update');
    Route::put('generalSettings/{generalSetting}/questionnaire', 'GeneralSettingsController@toggleQuestionnaireStatus')->name('.toggleQuestionnaire');

});
