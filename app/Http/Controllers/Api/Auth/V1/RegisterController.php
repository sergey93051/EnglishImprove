<?php

namespace App\Http\Controllers\Api\Auth\V1;

use App\Events\UserRegister;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\V1\RegisterRequest;
use App\Http\Service\Api\UserInformationService;
use App\Jobs\VerifyAccountJob;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        try {
            $user = $request->register();
            $token = $user->createToken($request->email)->plainTextToken;

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
