<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Events\VerifyAccountEvent;
use App\Http\Controllers\Controller;
use App\Http\Service\Api\V1\UserEmailService;

class VerifyAccountController extends Controller{

    /**
     * @param $hash
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verifyAccount($hash)
    {
        UserEmailService::getInstance()->verifyAccount($hash);

        return redirect('/login');
    }

    /**
     * @return bool[]
     */
    public function sendResetToken()
    {
        $email = request()->user()->currentAccessToken()->name;

        $hash = UserEmailService::getInstance()->sendResetToken($email);

        event(new VerifyAccountEvent($email,$hash));

        return ['success' => true];
    }

    /**
     * @return bool[]
     */
    public function checkVerified()
    {
        $email = request()->user()->currentAccessToken()->name;
        $checkVerified = !!UserEmailService::getInstance()->getByEmail($email)->email_verified_at;

        return ['email_verified' => $checkVerified , 'email' => $email];
    }

}
