<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Support\Facades\ApiResponse;
use App\Support\Services\UserService;
use App\Http\Resources\OAuth2TokenResource;
use App\Http\Requests\Api\RequestOAuth2TokenRequest;

class TokenController extends Controller
{
    public function getOAuth2Token(RequestOAuth2TokenRequest $request, UserService $userService)
    {
        $user = $userService
            ->setRequest($request)
            ->setModel(User::firstOrNew(['wallet_id' => $request->get('walletId')]))
            ->checkUser()
            ->getModel();

        return ApiResponse::setOkStatusCode()
            ->setData((new OAuth2TokenResource($user))->toArray($request))
            ->toSuccessJson();
    }
}
