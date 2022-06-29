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
    Route::get('get-information',[\App\Http\Controllers\Api\Auth\V1\UserInformationController::class,'get']);

    Route::put('update-information',[\App\Http\Controllers\Api\Auth\V1\UserInformationController::class,'updatePersonalInformation']);

    Route::get('check-verified',[\App\Http\Controllers\Api\Auth\V1\VerifyAccountController::class,'checkVerified']);

});




