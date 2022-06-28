<?php

namespace App\Http\Service\Api;

use App\Http\Service\ServiceInterface;
use App\Repository\Api\RoleRepository;

class RoleService extends BaseService implements ServiceInterface {

    protected static $instance;

    public function getRepository()
    {
        return RoleRepository::getInstance();
    }

    public function create(int $userId , ?string $role)
    {
       return $this->getRepository()->create($userId,$role);
    }

}
