<?php
Route::group(
    ['namespace' => '\App\CommunicationApp\Questions\Employee\Controllers'],function(){
    Route::apiResource('questions','QuestionsController');

});