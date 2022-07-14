<?php

namespace App\Http\Service\Api\V1;

use App\Http\Service\ServiceInterface;
use App\Repository\Api\V1\UserStateRepository;

class UserStateService implements ServiceInterface
{

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
     * @return UserStateRepository
     */
    public function getRepository()
    {
        return UserStateRepository::getInstance();
    }

    /**
     * @param int $userId
     * @param string $value
     */
    public function update(int $userId ,string $value)
    {
       return $this->getRepository()->update($userId, $value);
    }

    public function getByUserId(int $userId)
    {
        return $this->getRepository()->getByUserId($userId);
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function create(int $userId)
    {
       return $this->getRepository()->create($userId);
    }
}
