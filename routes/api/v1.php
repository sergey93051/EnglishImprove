<?php

use \Illuminate\Support\Facades\Route;

Route::post('register',\App\Http\Controllers\Api\Auth\V1\RegisterController::class);
Route::post('login',\App\Http\Controllers\Api\Auth\V1\LoginController::class);

Route::get('verify_account/{hash}',
    \App\Http\Controllers\Api\Auth\V1\VerifyAccountController::class)
    ->name('verify_account');



