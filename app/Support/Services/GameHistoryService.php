<?php

namespace App\Support\Services;

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
        $this->model->game_id = $this->request->input('gameId');
        $this->model->game_name = $this->request->input('gameName');
        $this->model->points = $this->request->input('points');
        $this->model->started_at = $this->request->input('startedAt');
        $this->model->ended_at = $this->request->input('endedAt');

        if ($this->model->isDirty()) {
            $this->request->user()
                ->gameHistories()
                ->save($this->model);
        }

        return $this;
    }
}
