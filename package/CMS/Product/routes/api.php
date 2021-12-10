<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'api',
    'namespace' => 'CMS\Product\Http\Controllers',

], function () {
    Route::prefix('admin/product')->group(function () {
        Route::group(['middleware' => 'admin:api'], function () {
            Route::get('list', 'ProductController@list');
            Route::get('show/{id}', 'ProductController@show');
            Route::delete('delete/{id}', 'ProductController@delete');
            Route::put('update/{id}', 'ProductController@update');
            Route::post('create', 'ProductController@create');
        });
    });
});