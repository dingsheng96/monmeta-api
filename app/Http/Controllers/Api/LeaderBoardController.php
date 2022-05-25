<?php

namespace App\Http\Controllers\Api;

use App\Models\GameHistory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Support\Facades\ApiResponse;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\LeaderBoardResource;
use App\Http\Requests\Api\LeaderBoardRequest;

class LeaderBoardController extends Controller
{
    public function index(LeaderBoardRequest $request)
    {
        $leaderBoard = DB::table(app(GameHistory::class)->getTable() . ' AS main')
            ->selectRaw('nft_id, MIN(duration) as best_lap, COUNT(*) AS total_game_counts, SUM(points) AS total_game_points, SUM(duration) AS total_durations,ROUND(((SELECT COUNT(*) FROM ' . app(GameHistory::class)->getTable() . ' WHERE position = 1 AND nft_id = main.nft_id)/COUNT(*) * 100), 2) AS winning_rate')
            ->when(!empty($request->get('gameSeasonId')), fn ($query) => $query->where('game_season_id', $request->get('gameSeasonId')))
            ->whereNull('deleted_at')
            ->groupBy('nft_id')
            ->orderByDesc('total_game_points')
            ->orderBy('total_durations')
            ->orderByDesc('winning_rate')
            ->paginate($request->get('itemsCount'), ['*'], 'page', $request->get('page'))
            ->withQueryString();

        return ApiResponse::withLog(new GameHistory(), null, 'Leaderboard')
            ->setOkStatusCode()
            ->setData(LeaderBoardResource::collection($leaderBoard)->toArray($request))
            ->setPagination((new PaginationResource($leaderBoard))->toArray($request))
            ->toSuccessJson();
    }
}
