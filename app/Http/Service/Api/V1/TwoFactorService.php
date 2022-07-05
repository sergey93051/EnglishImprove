<?php

namespace App\Http\Service\Api\V1;

use App\Http\Service\ServiceInterface;
use App\Repository\Api\V1\TwoFactorRepository;

class TwoFactorService implements ServiceInterface
{

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
        return TwoFactorRepository::getInstance();
    }

    public function getByUserIdAndIp(int $userId , string $ip)
    {
        $twoFactorCollection = $this->getRepository()->getByUserIdAndIp($userId , $ip );

        if($twoFactorCollection || $twoFactorCollection->secret )
        {

        }

        return $this->getRepository()->getByUserIdAndIp($userId , $ip );
    }
}
