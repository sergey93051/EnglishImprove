<?php

use Illuminate\Support\Facades\Route;

Route::post('register', \App\Http\Controllers\Api\V1\Auth\RegisterController::class);
Route::post('login', [\App\Http\Controllers\Api\V1\Auth\LoginController::class,'login']);
Route::post('login-by-code',[\App\Http\Controllers\Api\V1\Auth\LoginController::class,'loginByCode'])->middleware('throttle:5,1');

Route::get('verify_account/{hash}',
    [\App\Http\Controllers\Api\V1\Auth\VerifyAccountController::class,'verifyAccount'])
    ->name('verify_account');

Route::middleware('auth:sanctum')->group(function (){
    Route::post('logout', \App\Http\Controllers\Api\V1\Auth\LogoutController::class);
    Route::post('change-password', \App\Http\Controllers\Api\V1\Auth\ChangePasswordController::class);

    Route::get('check-auth',[\App\Http\Controllers\Api\V1\Auth\AuthController::class,'checkAuth']);

    Route::post('verify_account' ,[\App\Http\Controllers\Api\V1\Auth\VerifyAccountController::class,
        'sendResetToken']);

    Route::get('get-information',[\App\Http\Controllers\Api\V1\UserInformationController::class,'get']);
    Route::put('update-information',[\App\Http\Controllers\Api\V1\UserInformationController::class,'updatePersonalInformation']);

    Route::get('check-verified',[\App\Http\Controllers\Api\V1\Auth\VerifyAccountController::class,'checkVerified']);

    Route::put('update-2fa-state',[\App\Http\Controllers\Api\V1\Auth\TwoFaController::class, 'update']);

     });




