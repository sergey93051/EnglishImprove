<?php

namespace App\Repository;

use App\Models\UserInformation;

abstract class AbstractRepository{

    protected $model;
    private static $instance;

    public function __construct()
    {
        $this->model = new ($this->getModelClass());
    }

    abstract protected function getModelClass():string;

   public function startCondition()
   {
       return clone $this->model;
   }
}
