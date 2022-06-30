<?php

namespace App\Http\Service\Api\V1;

use App\Http\Service\ServiceInterface;
use App\Repository\Api\V1\UserInformationRepository;

class UserInformationService implements ServiceInterface
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

    public function getRepository()
    {
        return UserInformationRepository::getInstance();
    }

    /**
     * @param int $userId
     * @return void
     */
    public function createEmptyUserInformation(int $userId):void
    {
        $this->getRepository()->createEmptyUserInformation($userId);
    }

    /**
     * @param int $userId
     */
    public function get(int $userId)
    {
        return $this->getRepository()->getInformationByUserId($userId);
    }

    public function updatePersonalInformation($request , int $userId)
    {
        return $this->getRepository()->updatePersonalInformation($request , $userId);
    }
}
