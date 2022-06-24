<?php

namespace App\Http\Controllers\Api\Auth\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\V1\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __invoke(LoginRequest $request)
    {
        $isLogged =Auth::attempt($request->only(['email','password']));

        if(!$isLogged)
        {
            response()->json(['success' => false]);
        }

        $user = Auth::user();
        $token=$user->createToken($user->email)->plainTextToken;

        return response()->json(['success' => true ,'token' => $token ]);
    }

}
