<?php

use Illuminate\Support\Facades\Route;


Route::name('frontend.')->group(function () {
    Route::group([
        'namespace' => 'CMS\Frontend\Http\Controllers',
    ], function () {
        Route::get('/', 'HomeController@home')->name('home');
        Route::get('gallery', 'HomeController@gallery')->name('gallery');
        Route::get('intro', 'HomeController@intro')->name('intro');
        Route::get('category/{url}', 'HomeController@category')->name('product.category');
    });
});

Route::get('news-list', function () {
    return view('Frontend.pages.news.list');
});
Route::get('news-detail', function () {
    return view('Frontend.pages.news.detail');
});

Route::get('product-detail', function () {
    return view('Frontend.pages.product.detail');
});
Route::get('contact', function () {
    return view('Frontend.pages.contact.contact');
});