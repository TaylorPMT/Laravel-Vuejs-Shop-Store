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
        Route::get('product/{url}', 'HomeController@products')->name('product');
        Route::get('news/detail/{url}', 'HomeController@newDetail')->name('news.detail');
    });
});

Route::get('news-list', function () {
    return view('Frontend.pages.news.list');
});


Route::get('contact', function () {
    return view('Frontend.pages.contact.contact');
});