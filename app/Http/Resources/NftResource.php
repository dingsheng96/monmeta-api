<?php

namespace App\Http\Resources;

use App\Support\Services\GameHistoryService;
use Illuminate\Http\Resources\Json\JsonResource;

class NftResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'nftId' => $this->token_id,
            'status' => $this->status,
            'image' => $this->image
        ];

        if ($this->relationLoaded('currentTier')) {
            $data += [
                'tier' => optional($this->currentTier->first())->name,
                'stars' => strval($this->current_stars_with_tier_stars)
            ];
        }

        if ($this->relationLoaded('gameHistories')) {

            $gameHistoryService = (new GameHistoryService())->setRequest($request);

            $data += [
                'totalScore' => strval($this->total_score),
                'bestScore' => strval($this->best_score),
                'worstScore' => strval($this->worst_score),
                'averageScore' => strval($this->average_score),
                'seasonScore' => strval($gameHistoryService->getUserSeasonScore($this->resource)),
                'totalPlayCount' => strval($this->total_play_count),
                'totalHoursPlayed' => strval($this->total_hours_played),
                'winningRate' => strval($this->winning_rate),
                'currentRanking' => strval($gameHistoryService->getUserRanking($this->resource))
            ];
        }

        if ($this->relationLoaded('user')) {
            $data += [
                'user' => (new UserResource($this->user))->toArray($request)
            ];
        }

        return $data;
    }
}
