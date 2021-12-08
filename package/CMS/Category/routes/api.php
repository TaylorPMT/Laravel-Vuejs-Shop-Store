<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'api',
    'namespace' => 'CMS\Category\Http\Controllers',

], function () {
    Route::prefix('admin/category')->group(function () {
        Route::group(['middleware' => 'admin:api'], function () {
            Route::get('list', 'CategoryController@list');
            Route::get('show/{id}', 'CategoryController@show');
            Route::delete('delete/{id}', 'CategoryController@delete');
            Route::put('update/{id}', 'CategoryController@update');
            Route::post('create', 'CategoryController@create');
        });
    });
});