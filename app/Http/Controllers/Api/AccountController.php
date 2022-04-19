<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Support\Facades\ApiResponse;
use App\Support\Services\UserService;
use App\Http\Requests\Api\RegisterNewUserRequest;

class AccountController extends Controller
{
    public function register(RegisterNewUserRequest $request, UserService $userService)
    {
        return DB::transaction(function () use ($request, $userService) {

            $user = $userService
                ->setRequest($request)
                ->storeUserDetails()
                ->getModel();

            return ApiResponse::withLog($user, null, 'Registration')
                ->setMessage('User register successfully!')
                ->setOkStatusCode()
                ->toSuccessJson();
        });
    }
}
