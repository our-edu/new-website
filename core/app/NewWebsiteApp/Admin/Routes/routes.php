<?php

declare(strict_types = 1);

Route::get('/home', function () {
    return view('admin.index');
})->name('admin.home');
