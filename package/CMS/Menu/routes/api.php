<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'api',
    'namespace' => 'CMS\Menu\Http\Controllers',

], function () {
    Route::prefix('admin/menu')->group(function () {
        Route::group(['middleware' => 'admin:api'], function () {
            Route::get('list', 'MenuController@list');
            Route::get('show/{id}', 'MenuController@show');
            Route::delete('delete/{id}', 'MenuController@delete');
            Route::put('update/{id}', 'MenuController@update');
            Route::post('create', 'MenuController@create');
        });
    });
});