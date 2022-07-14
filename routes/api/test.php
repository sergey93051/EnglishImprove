<?php

use Illuminate\Support\Facades\Route;

    Route::post('delete-user', [\App\Http\Controllers\Api\V1\Test\Auth\TestAuthController::class,'deleteUser']);

