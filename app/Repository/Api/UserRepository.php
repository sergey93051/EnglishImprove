<?php

namespace App\Repository\Api;

use App\Models\User;
use App\Repository\AbstractRepository;

class UserRepository extends AbstractRepository
{
    protected static $instance;

    protected function getModelClass(): string
    {
       return User::class;
    }

    public function create(array $params):User
    {
        $params['email_verify_hash'] = getRandomString(40);

        return $this->startCondition()::create($params);
    }

    public function verifyAccount(string $hash)
    {
        $userByVerifyHash = $this->getUserByVerifyHash($hash);

        if(!$userByVerifyHash)
        {
            return false ;
        }

        $userByVerifyHash->email_verify_hash=null;

        $userByVerifyHash->update();

        return true ;
    }


    public function getUserByVerifyHash(string $hash)
    {
        return $this->startCondition()::where('email_verify_hash',$hash)->first();
    }
}
