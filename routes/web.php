<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});
Route::group([
    'namespace' => '\App\Http\Controllers\Admin',
    'prefix' => '',
], function () {
    Route::any('login', 'AuthController@login')->name('login');
});
Route::get('log', function () {
    Log::build([
        'driver' => 'single',
        'path' => storage_path('logs/custom.log'),
      ])->info('log----------:'.json_encode(request()->all()));

})->name('log');
Route::get('admin/{path}', '\CMS\Admin\Http\Controllers\AdminController@path');

// Route::get('{path}','\CMS\Admin\Http\Controllers\AdminController@path');
