<?php

namespace App\Http\Service\Api\V1;

use App\Http\Service\ServiceInterface;
use App\Jobs\SendHashMailJob;
use App\Models\TwoFactor;
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

    /**
     * @param int $userId
     * @param string $ip
     * @return string
     */
    public function getHashByUserIdAndIp(int $userId , string $ip):string
    {
        $twoFactorCollection = $this->getRepository()->getByUserIdAndIp($userId , $ip );

        if(!$twoFactorCollection)
        {
            return $this->getRepository()->create($userId, $ip);
        }

        if($twoFactorCollection->secret)
        {
            return $this->getRepository()->updateSecret($userId ,$ip);
        }

        return false;

    }

    /**
     * @param $email
     * @param $hash
     * @return void
     */
    public function sendHashMailForConfirmIp($email , $hash)
    {
        SendHashMailJob::dispatch($email,$hash)->delay(3);
    }

    /**
     * @param string $code
     * @return mixed
     */
    public function verifyCode(string $code)
    {
        return $this->getRepository()->verifyCode($code);
    }

    public function checkEmailMatch(string $code , string $email)
    {
       return $this->getRepository()->checkEmailMatch($code , $email);
    }

    /**
     * @return void
     */
    public function removeTwoFaIpConfirm()
    {
        $this->getRepository()->removeTwoFaIpConfirm();
    }
}
