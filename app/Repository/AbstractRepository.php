<?php

namespace App\Repository;

abstract class AbstractRepository{

    protected $model;

    public function __construct()
    {
        $this->model = new ($this->getModelClass());
    }

    abstract protected function getModelClass():string;

   public function startCondition()
   {
       return clone $this->model;
   }

    public static function getInstance()
    {
        if(static::$instance===null  )
        {
            $class = get_called_class();
            static::$instance = new $class();
        }

        return static::$instance;
    }
}
