<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Support\Facades\ApiResponse;
use App\Support\Services\GameHistoryService;
use App\Http\Requests\Api\StoreGameHistoryRequest;

class GameController extends Controller
{
    public function storeGameHistory(StoreGameHistoryRequest $request, GameHistoryService $gameHistoryService)
    {
        return DB::transaction(function () use ($request, $gameHistoryService) {

            $gameHistoryService
                ->withApiLog('Store Game History', $request->user())
                ->setRequest($request)
                ->store();

            return ApiResponse::setOkStatusCode()
                ->toSuccessJson();
        });
    }
}
