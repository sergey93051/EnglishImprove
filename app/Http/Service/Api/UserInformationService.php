<?php

namespace App\Http\Service\Api;

use App\Http\Service\ServiceInterface;
use App\Repository\Api\UserInformationRepository;

class UserInformationService implements ServiceInterface
{
    private static $instance;

    /**
     * @return UserInformationService
     */
    public static function getInstance():UserInformationService
    {
        if(self::$instance=== null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @return UserInformationRepository
     */
    public function getRepository():UserInformationRepository
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
