<?php

namespace App\Http\Service\Api\V1;

use App\Http\Service\ServiceInterface;
use App\Repository\Api\V1\UserEmailRepository;

class UserEmailService implements ServiceInterface
{
    private static $instance;

    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @return UserEmailRepository
     */
    public function getRepository():UserEmailRepository
    {
       return UserEmailRepository::getInstance();
    }

    /**
     * @param int $userId
     * @param string $email
     * @return mixed
     */
    public function create(int $userId , string $email)
    {
       return $this->getRepository()->create($userId , $email);
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function getByEmail(string $email)
    {
        return  $this->getRepository()->getByEmail($email);
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function getUserEmailsByUserId(int $userId)
    {
       return $this->getRepository()->getUserEmailsByUserId($userId);
    }

    /**
     * @param string $hash
     * @return void
     */
    public function verifyAccount(string $hash)
    {
        $this->getRepository()->verifyAccount($hash);
    }

    /***
     * @param int $userId
     * @return string
     */
    public function sendResetToken(string $email)
    {
        return $this->getRepository()->createVerifyToken($email);
    }
}
