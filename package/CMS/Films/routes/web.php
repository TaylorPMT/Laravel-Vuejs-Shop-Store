<?php
use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'CMS\Films\Http\Controllers'],function(){
    Route::get('films',function(){
        dd('ok');
    });
});
