<?php

namespace App\Http\Service\Api\V1;

use App\Http\Service\ServiceInterface;
use App\Repository\Api\V1\RoleRepository;
use App\Repository\Api\V1\UserEmailRepository;

class RoleService  implements ServiceInterface {

    private static $instance;

    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getRepository()
    {
        return RoleRepository::getInstance();
    }

    public function create(int $userId , ?string $role)
    {
       return $this->getRepository()->create($userId,$role);
    }

}
