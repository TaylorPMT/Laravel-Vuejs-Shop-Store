<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'api',
    'namespace' => 'CMS\Category\Http\Controllers',

], function () {
    Route::prefix('admin/category')->group(function () {
        Route::group(['middleware' => 'admin:api'], function () {
            Route::get('list','CategoryController@list');
            Route::get('show','CategoryController@show');
            Route::get('delete','CategoryController@show');
        });
    });
});
