<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'api',
    'namespace' => 'CMS\News\Http\Controllers',

], function () {
    Route::prefix('admin/news/category')->group(function () {
        Route::group(['middleware' => 'admin:api'], function () {
            Route::get('list', 'NewsCategoryController@list');
            Route::get('show/{id}', 'NewsCategoryController@show');
            Route::delete('delete/{id}', 'NewsCategoryController@delete');
            Route::put('update/{id}', 'NewsCategoryController@update');
            Route::post('create', 'NewsCategoryController@create');
        });
    });
    Route::prefix('admin/news/detail')->group(function () {
        Route::group(['middleware' => 'admin:api'], function () {
            Route::get('list', 'NewsDetailController@list');
            Route::get('show/{id}', 'NewsDetailController@show');
            Route::delete('delete/{id}', 'NewsDetailController@delete');
            Route::put('update/{id}', 'NewsDetailController@update');
            Route::post('create', 'NewsDetailController@create');
        });
    });
});