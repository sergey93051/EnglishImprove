<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\UpdateTwoFaRequest;
use App\Http\Service\Api\V1\UserService;
use Illuminate\Support\Facades\Auth;

class TwoFaController extends Controller
{
    public function update(UpdateTwoFaRequest $request)
    {
        $userId = Auth::user()->id;

        $updateTwoFaState = UserService::getInstance()->updateTwoFaState($userId , $request->twoFa);

        return response()->json(['success' => !!$updateTwoFaState]);

    }
}
