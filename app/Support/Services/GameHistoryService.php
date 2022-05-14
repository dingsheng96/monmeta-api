<?php

namespace App\Support\Services;

use App\Models\Nft;
use App\Models\Game;
use App\Helpers\Status;
use App\Models\GameHistory;
use App\Support\Services\BaseService;

class GameHistoryService extends BaseService
{
    public function __construct()
    {
        parent::__construct(GameHistory::class);
    }

    public function store()
    {
        $game = Game::firstOrCreate(
            ['uuid' => $this->request->get('gameId')],
            [
                'uuid' => $this->request->get('gameId'),
                'name' => $this->request->get('gameName')
            ]
        );

        $nft = Nft::firstOrCreate(
            [
                'user_id' => $this->request->user()->id,
                'token_id' => $this->request->get('nftId'),
                'status' => Status::STATUS_ACTIVE
            ],
            [
                'user_id' => $this->request->user()->id,
                'token_id' => $this->request->get('nftId'),
                'status' => Status::STATUS_ACTIVE
            ]
        );

        return $this->model->create([
            'game_id' => $game->id,
            'nft_id' => $nft->id,
            'room_id' => $this->request->get('roomId'),
            'game_season_id' => $this->request->get('gameSeasonId'),
            'points' => $this->request->get('points'),
            'started_at' => $this->request->get('startedAt'),
            'ended_at' => $this->request->get('endedAt'),
            'position' => $this->request->get('position'),
        ]);
    }

    public function getUserRanking(Nft $nft): string
    {
        $ranking = GameHistory::selectRaw('nft_id, ROUND(((SUM(points)/COUNT(*)) * 100), 2) AS winning_rate, SUM(duration) AS total_durations')
            ->when(!empty($this->request->get('gameSeasonId')), fn ($query) => $query->where('game_season_id', $this->request->get('gameSeasonId')))
            ->groupBy('nft_id')
            ->orderByDesc('winning_rate')
            ->orderByDesc('total_durations')
            ->get()
            ->search(function ($item, $key) use ($nft) {
                return $item->nft_id == $nft->id;
            });

        if (!$ranking) {
            return "N/A";
        }

        $ranking += 1;

        $ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');

        if (($ranking % 100) >= 11 && ($ranking % 100) <= 13) {
            return $ranking . 'th';
        }

        return $ranking . $ends[$ranking % 10];
    }

    public function getUserSeasonScore(Nft $nft): int
    {
        return (int) GameHistory::selectRaw('nft_id, SUM(points) AS total_game_points')
            ->where('nft_id', $nft->id)
            ->when(!empty($this->request->get('gameSeasonId')), fn ($query) => $query->where('game_season_id', $this->request->get('gameSeasonId')))
            ->groupBy('nft_id')
            ->value('total_game_points');
    }
}
