<?php

namespace App\Http\Controllers\Api;

use App\Models\GameHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Support\Facades\ApiResponse;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\GameHistoryResource;
use App\Support\Services\GameHistoryService;
use App\Http\Requests\Api\StoreGameHistoryRequest;
use App\Http\Requests\Api\GameHistory\GameHistoryListRequest;

class GameHistoryController extends Controller
{
    public function index(GameHistoryListRequest $request)
    {
        $gameHistories = GameHistory::query()
            ->whereDate('started_at', '>=', $request->get('fromDate'))
            ->whereDate('ended_at', '<=', $request->get('toDate'))
            ->orderByDesc('ended_at')
            ->paginate(4, ['*'], 'page', $request->get('page'))
            ->withQueryString();

        return ApiResponse::withLog(new GameHistory())
            ->setOkStatusCode()
            ->setData(GameHistoryResource::collection($gameHistories)->toArray($request))
            ->setPagination((new PaginationResource($gameHistories))->toArray($request))
            ->toSuccessJson();
    }

    public function store(StoreGameHistoryRequest $request, GameHistoryService $gameHistoryService)
    {
        return DB::transaction(function () use ($request, $gameHistoryService) {

            $gameHistoryService
                ->setRequest($request)
                ->store();

            return ApiResponse::setOkStatusCode()
                ->toSuccessJson();
        });
    }
}
