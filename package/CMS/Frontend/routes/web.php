<?php

use Illuminate\Support\Facades\Route;


Route::name('frontend.')->group(function () {
    Route::group([
        'namespace' => 'CMS\Frontend\Http\Controllers',
    ], function () {
        Route::get('', 'HomeController@home')->name('home');
        Route::get('gallery', 'HomeController@home')->name('gallery');
        Route::get('intro', 'HomeController@home')->name('intro');
    });
});

Route::get('news-list', function () {
    return view('Frontend.pages.news.list');
});
Route::get('news-detail', function () {
    return view('Frontend.pages.news.detail');
});
Route::get('product-category', function () {
    return view('Frontend.pages.product.category');
});
Route::get('product-detail', function () {
    return view('Frontend.pages.product.detail');
});
Route::get('contact', function () {
    return view('Frontend.pages.contact.contact');
});