<?php

namespace App\Repository\Api;

use App\Models\User;
use App\Repository\AbstractRepository;
use Carbon\Carbon;

class UserRepository extends AbstractRepository
{
    protected static $instance;

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
       return User::class;
    }

    public function getUser(int $userId)
    {
        return $this->startCondition()::find($userId);
    }

    /**
     * @param array $params
     * @return User
     */
    public function create(array $params):User
    {
        $params['email_verify_hash'] = getRandomString(40);
        return $this->startCondition()::create($params);
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
    public function createVerifyToken(int $userId)
    {
        $hash = getRandomString(40);

        $user = $this->getUser($userId);
        $user->email_verify_hash=$hash;
        $user->update();

        return $hash;
    }
}
