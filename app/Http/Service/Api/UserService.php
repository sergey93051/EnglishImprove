<?php

namespace App\Http\Service\Api;

use App\Http\Service\ServiceInterface;
use App\Repository\Api\UserRepository;

class UserService extends BaseService implements ServiceInterface {

    protected static $instance;

    public function getRepository()
    {
        return UserRepository::getInstance();
    }

    public function register($request)
    {
       return $this->getRepository()->create($request->only(['email','password']));
    }

    public function verifyAccount(string $hash)
    {
       return $this->getRepository()->verifyAccount($hash);
    }



}
