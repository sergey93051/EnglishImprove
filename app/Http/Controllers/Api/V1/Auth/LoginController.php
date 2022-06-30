<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Service\Api\V1\UserEmailService;
use App\Http\Service\Api\V1\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function __invoke(LoginRequest $request , UserEmailService $userEmailService)
    {
        $userEmail = $userEmailService->getByEmail($request->email);
        $user =UserService::getInstance()->getById($userEmail->userId);

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['success' => false],400);
        }

        Auth::login($user);

        $token=$user->createToken($request->email)->plainTextToken;

        return response()->json(['success' => true ,'token' => $token ,
            'email_verified' => !!$user->email_verified_at
        ]);
    }

}
