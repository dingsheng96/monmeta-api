<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Support\Facades\ApiResponse;
use App\Http\Resources\OAuth2TokenResource;
use App\Http\Requests\Api\RequestOAuth2TokenRequest;

class TokenController extends Controller
{
    public function giveOAuth2Token(RequestOAuth2TokenRequest $request)
    {
        $user = User::where('wallet_id', $request->input('walletId'))
            ->firstOrFail();

        return ApiResponse::setOkStatusCode()
            ->setData((new OAuth2TokenResource($user))->toArray($request))
            ->toSuccessJson();
    }
}
