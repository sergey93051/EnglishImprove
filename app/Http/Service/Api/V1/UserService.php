<?php

namespace App\Http\Service\Api\V1;

use App\Http\Service\ServiceInterface;
use App\Models\TwoFactor;
use App\Models\User;
use App\Repository\Api\V1\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserService implements ServiceInterface {

    private static $instance;

    public static function getInstance()
    {
        if(self::$instance=== null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }


    /**
     * @return UserRepository
     */
    public function getRepository():UserRepository
    {
        return UserRepository::getInstance();
    }

    /**
     * @param $request
     * @return \App\Models\User
     */
    public function register($request)
    {
        $user = $this->getRepository()->create($request->only(['password']));

        $userEmail = UserEmailService::getInstance()->create($user->id , $request->email);
        $user->email  = $userEmail->email;
        $user->email_verify_hash  = $userEmail->email_verify_hash;

        return $user;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->getRepository()->getUser($id);
    }

    /**
     * @param int $userId
     * @param string $newPassword
     * @return void
     */
    public function changePassword(int $userId ,string $newPassword):void
    {
        $this->getRepository()->changePassword($userId ,$newPassword);
    }

    /**
     * @param int $userId
     * @param bool $state
     * @return mixed
     */
    public function updateTwoFaState(int $userId ,bool $state)
    {
        return $this->getRepository()->updateTwoFaState($userId  , $state );
    }

    /**
     * @param int $userId
     * @param string $email
     * @return bool
     */
    public function twoFactorAuthentication(int $userId ,string $email)
    {
        $hash= TwoFactorService::getInstance()->getHashByUserIdAndIp($userId , request()->ip());

        if(!$hash)
        {
            return false ;
        }

        TwoFactorService::getInstance()->sendHashMailForConfirmIp($email , $hash);

        return true;
    }


    public function loginByCode($request)
    {
        $code = $request->code;
        $email = $request->email;

        $checkEmailMatch = TwoFactorService::getInstance()->checkEmailMatch($code ,$email);

        if(!$checkEmailMatch)
        {
           return response()->json(['success' => false , 'message' => 'Mail not match'] , 400);
        }

        $twoFactorModel = TwoFactorService::getInstance()->verifyCode($code);

        $userId = $twoFactorModel->userId;

        $user = UserService::getInstance()->getById($userId);

       return UserService::getInstance()->loginUser($user , $email);

    }

    public function loginUser(User $user ,string $email  )
    {
        Auth::login($user);

        $token=$user->createToken($email)->plainTextToken;
        $emailVerifiedAt= UserEmailService::getInstance()->getByEmail($email)?->email_verified_at;

        return response()->json(['success' => true ,'token' => $token ,
            'email_verified' => !!$emailVerifiedAt
        ]);
    }

}
