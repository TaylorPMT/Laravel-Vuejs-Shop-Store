<?php

use Illuminate\Support\Facades\Route;

Route::get('', function () {
    return view('Frontend.pages.index.index');
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
Route::get('intro', function () {
    return view('Frontend.pages.intro.intro');
});
Route::get('gallery', function () {
    return view('Frontend.pages.gallery.gallery');
});