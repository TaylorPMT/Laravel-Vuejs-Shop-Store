<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'api',
    'namespace' => 'CMS\Page\Http\Controllers',

], function () {
    Route::prefix('admin')->group(function () {
        Route::group(['middleware' => 'admin:api'], function () {
            Route::group(['prefix' => 'block/page'], function () {
                Route::get('list', 'BlockController@getList');
                Route::get('show/{id}', 'BlockController@show');
                Route::put('update/{id}', 'BlockController@update');
                Route::get('config', 'BlockController@getBlockConfig');
                Route::post('create', 'BlockController@createBlock');
            });
        });
    });
});