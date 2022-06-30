<?php

namespace App\Repository\Api\V1;

use App\Models\UserInformation;
use App\Repository\AbstractRepository;

class UserInformationRepository extends AbstractRepository
{

    private static $instance;

    /**
     * @return UserInformationRepository
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
        return UserInformation::class;
    }

    /**
     * @param int $userId
     * @return void
     */
    public function createEmptyUserInformation(int $userId):void
    {
        $newUserInformation = $this->startCondition();
        $newUserInformation->userId = $userId;
        $newUserInformation->save();

    }

    /**
     * @param int $userId
     */
    public function getInformationByUserId(int $userId)
    {
        return $this->startCondition()::where('userId',$userId)->first();
    }


    public function updatePersonalInformation($request , int $userId)
    {
        $userInformation = $this->getInformationByUserId($userId);
        $userInformation->update($request->only([
            'address','phone_code','phone','age','name'
        ]));

        return $this->getInformationByUserId($userId);
    }
}
