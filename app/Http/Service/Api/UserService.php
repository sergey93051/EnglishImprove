<?php

namespace App\Http\Service\Api;

use App\Http\Service\ServiceInterface;
use App\Repository\Api\UserRepository;

class UserService extends BaseService implements ServiceInterface {

    protected static $instance;

    /**
     * @return UserRepository
     */
    public function getRepository():UserRepository
    {
        return UserRepository::getInstance();
    }

    /**
     * @param $request
     * @return \App\Models\User
     */
    public function register($request)
    {
       return $this->getRepository()->create($request->only(['email','password']));
    }

    /**
     * @param string $hash
     * @return void
     */
    public function verifyAccount(string $hash):void
    {
        $this->getRepository()->verifyAccount($hash);
    }

    /***
     * @param int $userId
     * @return string
     */
    public function sendResetToken(int $userId)
    {
         return $this->getRepository()->createVerifyToken($userId);
    }

}
