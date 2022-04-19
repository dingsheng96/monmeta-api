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
use App\Http\Requests\Api\GameHistory\GameHistoryListRequest;
use App\Http\Requests\Api\GameHistory\StoreGameHistoryRequest;

class GameHistoryController extends Controller
{
    public function index(GameHistoryListRequest $request)
    {
        $gameHistories = GameHistory::query()
            ->with(['game', 'nft'])
            ->when(!empty($request->get('gameId')), fn ($query) => $query->where('game_id', $request->get('gameId')))
            ->when(!empty($request->get('roomId')), fn ($query) => $query->where('room_id', $request->get('roomId')))
            ->when(!empty($request->get('gameSeasonId')), fn ($query) => $query->where('game_season_id', $request->get('gameSeasonId')))
            ->when(!empty($request->get('fromDate')), fn ($query) => $query->whereDate('started_at', '>=', $request->get('fromDate')))
            ->when(!empty($request->get('toDate')), fn ($query) => $query->whereDate('ended_at', '<=', $request->get('toDate')))
            ->when(!empty($request->get('nftId')), function ($query) use ($request) {
                $query->whereHas('nft', fn ($query) => $query->where('token_id', $request->get('nftId')));
            })
            ->orderByDesc('ended_at')
            ->paginate($request->get('count'), ['*'], 'page', $request->get('page'))
            ->withQueryString();

        return ApiResponse::withLog(new GameHistory(), null, 'Game histories')
            ->setOkStatusCode()
            ->setData(GameHistoryResource::collection($gameHistories)->toArray($request))
            ->setPagination((new PaginationResource($gameHistories))->toArray($request))
            ->toSuccessJson();
    }

    public function store(StoreGameHistoryRequest $request, GameHistoryService $gameHistoryService)
    {
        return DB::transaction(function () use ($request, $gameHistoryService) {

            $gameHistory = $gameHistoryService
                ->setRequest($request)
                ->store();

            return ApiResponse::withLog($gameHistory, $request->user(), 'Game history', 'create')
                ->setOkStatusCode()
                ->setData((new GameHistoryResource($gameHistory))->toArray($request))
                ->toSuccessJson();
        });
    }
}
