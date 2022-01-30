<?php

declare(strict_types = 1);

Route::group(['namespace'=>'\App\NewWebsiteApp\Front\Controllers'], function () {

    Route::get('/', 'FrontController@getIndex')->name('home');
    Route::get('/الكتب', 'FrontController@books')->name('books');
    Route::get('/مقالات', 'FrontController@articles')->name('articles');
    Route::get('/تفاصيل-المقال/{article}', 'FrontController@articleDetails')->name('article_details');
    Route::get('/تفاصيل-بحث/{research}', 'FrontController@researchesDetails')->name('research_details');
    Route::get('/تفاصيل-النشاط/{event}', 'FrontController@eventDetails')->name('event_details');
    Route::get('/الملف-الشخصي', 'FrontController@profile')->name('profile');
    Route::get('/أنشطة', 'FrontController@activities')->name('activities');
    Route::get('/اتصل-بنا', 'FrontController@contact')->name('contact_us');
    Route::get('/معرض-الصور', 'FrontController@gallery')->name('gallery');
    Route::get('/فيديوهات', 'FrontController@videos')->name('videos');
    Route::get('/الأبحاث', 'FrontController@researches')->name('researches');
    Route::post('/contactUs', 'FrontController@contactStore')->name('contact_us.store');
});
