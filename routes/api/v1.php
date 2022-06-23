<?php
use App\Http\Controllers\HomeController;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/sanctum/checkauth', function(){return true;})->middleware('auth:sanctum');
 
Route::post('/register',[RegisterController::class,'register']);

Route::get("/test",function(){
        return response()->json(['n'=>''],400);
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });





