<?php

declare(strict_types = 1);

Route::group(['prefix' => 'look-up', 'as' => 'lookUp.',
    'namespace' => '\App\CommunicationApp\LookUp\Controllers\Api'], function () {
        Route::get('/employee/branches/roles', 'LookUpController@getEmployeeBranchesRoles')->name('employee.branches.roles');
    });
