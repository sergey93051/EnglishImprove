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

    /**
     * @param $userId
     * @param string $newPassword
     * @return void
     */
    public function changePassword($userId ,string $newPassword):void
    {
        $user = $this->getUser($userId);

        $user->password = $newPassword;

        $user->update();
    }

    /**
     * @param int $userId
     * @param bool $state
     * @return mixed
     */
    public function updateTwoFaState(int $userId , bool $state)
    {
        $user = $this->getUser($userId);
        $user->twoFa = $state;

       return $user->update();
    }

    /**
     * @param int $userId
     * @return void
     */
    public function deleteUser(int $userId)
    {
        $this->getUser($userId)->delete();
    }
}
