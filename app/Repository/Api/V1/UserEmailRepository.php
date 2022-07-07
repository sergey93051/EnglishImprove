<?php

namespace App\Repository\Api\V1;

use App\Models\UserEmail;
use App\Repository\AbstractRepository;
use Carbon\Carbon;

class UserEmailRepository extends AbstractRepository
{

    private static $instance;

    /**
     * @return UserEmailRepository
     */
    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
       return UserEmail::class;
    }

    /**
     * @param int $userId
     * @param string $email
     * @return mixed
     */
    public function create(int $userId , string $email)
    {
        $hash = getRandomString(40);

        return $this->startCondition()::create(['userId' => $userId ,
            'email' => $email , 'email_verify_hash' => $hash ]);
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function getByEmail(string $email)
    {
        return $this->startCondition()::where('email', $email)->first();
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function getUserEmailsByUserId(int $userId)
    {
        return $this->startCondition()::where('userId',$userId)->get();
    }

    /**
     * @param string $hash
     * @return bool
     */
    public function verifyAccount(string $hash)
    {
        $userByVerifyHash = $this->getUserByVerifyHash($hash);

        if(!$userByVerifyHash)
        {
            return false ;
        }

        $userByVerifyHash->email_verify_hash=null;
        $userByVerifyHash->email_verified_at=Carbon::now();

        $userByVerifyHash->update();

        return true ;
    }

    /**
     * @param string $hash
     * @return mixed
     */
    public function getUserByVerifyHash(string $hash)
    {
        return $this->startCondition()::where('email_verify_hash',$hash)->first();
    }

    /**
     * @param int $userId
     * @return string
     */
    public function createVerifyToken(string $email)
    {
        $hash = getRandomString(40);


        $userEmail = $this->getByEmail($email);
        $userEmail->email_verify_hash=$hash;
        $userEmail->update();

        return $hash;
    }

}
