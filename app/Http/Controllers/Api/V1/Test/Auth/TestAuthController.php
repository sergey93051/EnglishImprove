<?php

namespace App\Http\Controllers\Api\V1\Test\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Test\RemoveUserTestRequest;
use App\Http\Service\Api\V1\UserEmailService;
use App\Http\Service\Api\V1\UserService;

class TestAuthController extends Controller
{
    public function deleteUser(RemoveUserTestRequest $request)
    {
        $userEmail = UserEmailService::getInstance()->getByEmail($request->email);
        $userId = $userEmail->userId;

        UserService::getInstance()->deleteUser($userId);
    }
}
