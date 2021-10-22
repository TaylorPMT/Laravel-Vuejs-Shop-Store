<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'api',
    'namespace' => 'CMS\Admin\Http\Controllers',

], function () {
    Route::prefix('admin')->group(function () {
        Route::post('login', 'AuthController@postLogin');
        Route::group(['middleware' => 'admin:api'], function () {
            Route::get('config', 'AdminController@getSidebar');
            Route::get('logout', 'AuthController@logout');
            Route::get('info', 'AdminController@getInfo');
            Route::get('list', 'AdminController@getList');
        });
    });
});
