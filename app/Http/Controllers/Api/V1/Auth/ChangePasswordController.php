<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\ChangePasswordRequest;
use App\Http\Service\Api\V1\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller{

    public function __invoke(ChangePasswordRequest $request)
    {
        if(!Hash::check($request->oldPassword,Auth::user()->password))
        {
            return response()->json(['success' => false ,
                'Message' => 'Old password is not correct'],422);
        }

        $userId = Auth::user()->id;

        UserService::getInstance()->changePassword($userId ,$request->password);

        return ['success' => true];

    }


}
