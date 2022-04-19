<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'gameHistoryId' => $this->uuid,
            'gameName' => $this->game->name,
            'roomId' => $this->room_id,
            'gameSeasonId' => $this->game_season_id,
            'points' => strval($this->points),
            'position' => strval($this->position),
            'startedAt' => $this->started_at,
            'endedAt' => $this->ended_at,
            'duration' => $this->formatted_duration
        ];
    }
}
