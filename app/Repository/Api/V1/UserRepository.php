<?php

namespace App\Repository\Api\V1;

use App\Models\User;
use App\Repository\AbstractRepository;
use Carbon\Carbon;

class UserRepository extends AbstractRepository
{
    private static $instance;

    /**
     * @return UserRepository
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


}
