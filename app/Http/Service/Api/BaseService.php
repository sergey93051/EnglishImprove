<?php

namespace App\Http\Service\Api;

class BaseService{

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
