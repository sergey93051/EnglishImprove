<?php

namespace App\Repository\Api\V1;

use App\Models\TwoFactor;
use \App\Repository\AbstractRepository;
use Illuminate\Support\Str;

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

    /**
     * @param int $userId
     * @param string $ip
     * @return string ( @return secret )
     */
    public function create(int $userId , string $ip):string
    {
        $secret = Str::random(6);

        $twoFactor = $this->startCondition();
        $twoFactor->ip = $ip;
        $twoFactor->userId = $userId;
        $twoFactor->secret = $secret;
        $twoFactor->save();

        return $secret;

    }
}
