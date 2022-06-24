<?php

namespace App\Repository\Api;

use App\Models\User;
use App\Repository\AbstractRepository;

class UserRepository extends AbstractRepository{
    protected static $instance;

    protected function getModelClass(): string
    {
       return User::class;
    }

    public function create(array $params):User
    {
        return $this->startCondition()::create($params);
    }
}
