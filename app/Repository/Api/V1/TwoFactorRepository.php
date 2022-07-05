<?php

namespace App\Repository\Api\V1;

use App\Models\TwoFactor;
use \App\Repository\AbstractRepository;

class TwoFactorRepository extends \App\Repository\AbstractRepository
{
    private static $instance;

    /**
     * @return TwoFactorRepository
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
        return TwoFactor::class;
    }

    /**
     * @param int $userId
     * @param string $ip
     * @return mixed
     */
    public function getByUserIdAndIp(int $userId , string $ip)
    {
        return $this->startCondition()::where('userId',$userId)->where('ip' , $ip)->first();
    }
}
