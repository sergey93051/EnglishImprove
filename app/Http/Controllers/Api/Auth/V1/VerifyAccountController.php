<?php

namespace App\Http\Controllers\Api\Auth\V1;

use App\Http\Controllers\Controller;
use App\Http\Service\Api\UserService;

class VerifyAccountController extends Controller{

    public function __invoke($hash)
    {
        if(!UserService::getInstance()->verifyAccount($hash))
        {
            return redirect()->to('https://google.com');
        }

        return redirect()->to('https://google.com');
    }


}
