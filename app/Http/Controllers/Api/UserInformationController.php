<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\V1\UpdateUserInformationRequest;
use App\Http\Service\Api\UserInformationService;
use Illuminate\Support\Facades\Auth;

class UserInformationController extends Controller{

    public function get()
    {
        $userId = Auth::user()->id;

        return UserInformationService::getInstance()->get($userId);
    }

    public function updatePersonalInformation(UpdateUserInformationRequest $request)
    {
        $userId = Auth::user()->id;

        UserInformationService::getInstance()->updatePersonalInformation($request,$userId);

        return $this->get();
    }

}
