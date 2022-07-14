<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\StateUpdateRequest;
use App\Http\Service\Api\V1\UserStateService;
use Illuminate\Support\Facades\Auth;

class StateController extends Controller
{
    public function get()
    {
        $userId = Auth::user()->id;

        return UserStateService::getInstance()->getByUserId($userId);
    }

    public function update(StateUpdateRequest $request)
    {
        $userId = Auth::user()->id ;

        return UserStateService::getInstance()->update($userId , $request->state);
    }
}
