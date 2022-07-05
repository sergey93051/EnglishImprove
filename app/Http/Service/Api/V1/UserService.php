<?php

namespace App\Http\Service\Api\V1;

use App\Http\Service\ServiceInterface;
use App\Repository\Api\V1\UserRepository;

class UserService implements ServiceInterface {

    private static $instance;

    public static function getInstance()
    {
        if(self::$instance=== null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }


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
        $user = $this->getRepository()->create($request->only(['password']));

        $userEmail = UserEmailService::getInstance()->create($user->id , $request->email);
        $user->email  = $userEmail->email;
        $user->email_verify_hash  = $userEmail->email_verify_hash;

        return $user;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->getRepository()->getUser($id);
    }

    /**
     * @param int $userId
     * @param string $newPassword
     * @return void
     */
    public function changePassword(int $userId ,string $newPassword):void
    {
        $this->getRepository()->changePassword($userId ,$newPassword);
    }

}
