<?php

namespace App\Repository\Api\V1;

use App\Models\TwoFactor;
use \App\Repository\AbstractRepository;
use Illuminate\Support\Facades\DB;
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

    /**
     * @param int $userId
     * @param string $ip
     * @return string (Return hash)
     */
    public function updateSecret(int $userId , string $ip):string
    {
        $twoFactorModel = $this->startCondition()::where('ip',$ip)->where('userId',$userId)->first();

        $secret = Str::random(6);
        $twoFactorModel->secret =$secret;

        $twoFactorModel->update();

        return $secret;
    }

    /**
     * @param string $code
     * @return mixed
     */
    public function verifyCode(string $code)
    {
        $twoFactorModel = $this->getByCode($code);
        $twoFactorModel->secret = null;

        $twoFactorModel->update();

        return $twoFactorModel;
    }

    /**
     * @param string $code
     * @return mixed
     */
    public function getByCode(string $code)
    {
        return $this->startCondition()::where('secret',$code)->first();
    }

    public function checkEmailMatch($code , $email)
    {
        $twoFactorModel = $this->getByCode($code)->load('emails');

        $emailsCollection = $twoFactorModel->emails()->get();

        return $emailsCollection->contains(function ($value, $key) use ($email) {
               return  $value->email ===$email;
        });
    }

    /**
     * @return void
     */
    public function removeTwoFaIpConfirm()
    {
        $carbon = \Carbon\Carbon::now()->subMinutes(5);

        $this->startCondition()::where('created_at','<' , $carbon)->whereNotNull('secret')->delete();
    }

}
