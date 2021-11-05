<?php

use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'admin',
    'namespace' => 'CMS\Admin\Http\Controllers',
], function () {
    Route::get('dashboard', 'AuthController@dashboard');
    Route::get('sidebar', 'AuthController@sidebar');


});


// Route::get('/admin/{path}','\CMS\Admin\Http\Controllers\AdminController@path')->where('path', '([A-z\d\-\/_.]+)');
