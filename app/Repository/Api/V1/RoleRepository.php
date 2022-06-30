<?php

namespace App\Repository\Api\V1;

use App\Models\Role;
use App\Repository\AbstractRepository;

class RoleRepository extends AbstractRepository{

    private static $instance;

    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function getModelClass(): string
    {
        return Role::class;
    }

    public function create(int $userId , ?string $role)
    {
        return $this->startCondition()::create(['userId' => $userId , 'role' => $role]);
    }
}
