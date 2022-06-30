<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\UpdateUserInformationRequest;
use App\Http\Service\Api\V1\UserInformationService;
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
