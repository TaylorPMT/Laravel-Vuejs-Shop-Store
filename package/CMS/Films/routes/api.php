<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'api',
    'namespace' => 'CMS\Films\Http\Controllers',
], function () {
    Route::group(['prefix' => 'admin/film'], function () {
        Route::get('list', 'FilmController@list');
        Route::get('download/{id}','FilmController@download');
    });
});
