<?php

namespace App\Http\Controllers\Api\Auth\V1;

use App\Events\VerifyAccountEvent;
use App\Http\Controllers\Controller;
use App\Http\Service\Api\UserService;
use Illuminate\Support\Facades\Auth;

class VerifyAccountController extends Controller{

    public function verifyAccount($hash)
    {
        UserService::getInstance()->verifyAccount($hash);

        return redirect('/login');
    }

    public function sendResetToken()
    {
        $id = Auth::user()->id;
        $hash = UserService::getInstance()->sendResetToken($id);

        event(new VerifyAccountEvent(Auth::user()->email,$hash));

        return ['success' => true];
    }


}
