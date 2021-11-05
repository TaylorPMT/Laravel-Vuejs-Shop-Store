<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'api',
    'namespace' => 'CMS\Category\Http\Controllers',

], function () {
    Route::prefix('admin/category')->group(function () {
    });
});
