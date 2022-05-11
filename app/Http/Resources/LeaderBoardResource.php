<?php

namespace App\Http\Resources;

use App\Models\Nft;
use App\Helpers\DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaderBoardResource extends JsonResource
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
            'nft' => (new NftResource(Nft::with(['tiers', 'currentTier'])->where('id', $this->nft_id)->first()))->toArray($request),
            'totalPoints' => strval($this->total_game_points),
            'totalGameCounts' => strval($this->total_game_counts),
            'winningRate' => strval($this->winning_rate) . '%',
            'totalDurations' => (new DateTime())->convertFromMillisecondsToReadable($this->total_durations),
            'bestLap' => (new DateTime())->convertFromMillisecondsToReadable($this->best_lap),
        ];
    }
}
