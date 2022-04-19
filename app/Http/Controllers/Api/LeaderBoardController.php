<?php

namespace App\Http\Controllers\Api;

use App\Models\Nft;
use App\Models\GameHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Support\Facades\ApiResponse;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\LeaderBoardResource;
use App\Http\Requests\Api\LeaderBoardRequest;

class LeaderBoardController extends Controller
{
    public function index(LeaderBoardRequest $request)
    {
        $leaderBoard = GameHistory::query()
            ->with('nft', function ($query) {
                $query->with('tiers');
            })
            ->selectRaw('nft_id, COUNT(*) AS total_game_counts, SUM(points) AS total_game_points, ROUND(((SUM(points)/COUNT(*)) * 100), 2) AS winning_rate, SUM(duration) AS total_durations')
            ->when(!empty($request->get('gameSeasonId')), fn ($query) => $query->where('game_season_id', $request->get('gameSeasonId')))
            ->groupBy('nft_id')
            ->orderByDesc('winning_rate')
            ->orderByDesc('total_durations')
            ->paginate($request->get('count'), ['*'], 'page', $request->get('page'))
            ->withQueryString();

        return ApiResponse::withLog(new GameHistory(), null, 'Leaderboard')
            ->setOkStatusCode()
            ->setData(LeaderBoardResource::collection($leaderBoard)->toArray($request))
            ->setPagination((new PaginationResource($leaderBoard))->toArray($request))
            ->toSuccessJson();
    }
}
