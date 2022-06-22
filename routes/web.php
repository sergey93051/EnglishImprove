<?php

use Illuminate\Support\Facades\Route;

Route::get('{any}', function () {
    return view('home.layouts.app');
})->where('any', '.*');