<?php

namespace App\Repository\Api;

use App\Models\Role;
use App\Repository\AbstractRepository;

class RoleRepository extends AbstractRepository{
    protected static $instance;

    protected function getModelClass(): string
    {
        return Role::class;
    }

    public function create(int $userId , ?string $role)
    {
        return $this->startCondition()::create(['userId' => $userId , 'role' => $role]);
    }
}
