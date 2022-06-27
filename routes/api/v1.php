<?php

use \Illuminate\Support\Facades\Route;

Route::post('register',\App\Http\Controllers\Api\Auth\V1\RegisterController::class);
Route::post('login',\App\Http\Controllers\Api\Auth\V1\LoginController::class);


Route::get('verify_account/{hash}',
    [\App\Http\Controllers\Api\Auth\V1\VerifyAccountController::class,'verifyAccount'])
    ->name('verify_account');

Route::middleware('auth:sanctum')->group(function (){
    Route::post('verify_account' ,[\App\Http\Controllers\Api\Auth\V1\VerifyAccountController::class,
        'sendResetToken']);
});



