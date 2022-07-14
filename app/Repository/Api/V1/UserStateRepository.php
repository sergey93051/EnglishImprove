<?php

namespace App\Repository\Api\V1;

use App\Models\UserState;
use App\Repository\AbstractRepository;

class UserStateRepository extends AbstractRepository
{
    private static $instance;

    /**
     * @return UserStateRepository
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
        return UserState::class;
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function getByUserId(int $userId)
    {
        return $this->startCondition()::where('userId' , $userId)->first();
    }

    /**
     * @param int $userId
     * @param string $value
     */
    public function update(int $userId , string $value)
    {
       $userStatus = $this->getByUserId($userId);
       $userStatus->state = $value ;

       $userStatus->update();

       return $userStatus;
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function create(int $userId)
    {
        return $this->startCondition()::create(['userId' => $userId , 'state' => 'online']);
    }

}
