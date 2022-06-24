<?php

namespace App\Http\Controllers\Api\Auth\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\V1\RegisterRequest;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        try {
            $user = $request->register();
            $token = $user->createToken($request->email)->plainTextToken;

            return response()->json(['token' => $token , 'success' => true ,
                'email_verified' => false] ,201);

        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage() ,
                'success' => false] , 401);
        }
    }

}
