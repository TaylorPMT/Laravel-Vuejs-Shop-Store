<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'CMS\Frontend\Http\Controllers',
    'prefix' => 'api'
], function () {
    Route::get('site-search', 'SearchController@search')->name('search');
});