<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginByCodeRequest;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Service\Api\V1\UserEmailService;
use App\Http\Service\Api\V1\UserService;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function login(LoginRequest $request , UserEmailService $userEmailService)
    {
        $userEmail = $userEmailService->getByEmail($request->email);
        $user =UserService::getInstance()->getById($userEmail->userId);

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['success' => false],400);
        }

        if(!$user->twoFa)
        {
            return UserService::getInstance()->loginUser($user , $request->email);
        }

        $hashExists = UserService::getInstance()->twoFactorAuthentication($user->id ,$userEmail->email);

        if(!$hashExists)
        {
            return UserService::getInstance()->loginUser($user , $request->email);
        }

        return response()->json(['success' => false , 'response'=>'Please write code from mail'],406);

    }



    public function loginByCode(LoginByCodeRequest $request )
    {
       return UserService::getInstance()->loginByCode($request);
    }

}
