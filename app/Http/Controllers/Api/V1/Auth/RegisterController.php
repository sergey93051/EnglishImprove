<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Events\UserRegister;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Service\Api\V1\TwoFactorService;
use App\Http\Service\Api\V1\UserInformationService;
use App\Models\UserEmail;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        try {
            $user = $request->register();
            $token = $user->createToken($user->email)->plainTextToken;

            UserInformationService::getInstance()->createEmptyUserInformation($user->id);

        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage() ,
                'success' => false] , 401);
        }

        event(new UserRegister($user->email,$user->email_verify_hash));

        return response()->json(['token' => $token , 'success' => true ,
            'email_verified' => false] ,201);
    }

}
