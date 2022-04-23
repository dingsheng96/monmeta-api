<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'transactionHash' => $this->hash_id,
            'status' => $this->status,
            'type' => $this->type,
            'gameSeasonId' => $this->game_season_id,
            'amount' => $this->formatted_amount,
            'currency' => $this->currency,
            'description' => $this->description,
            'transactionDate' => $this->transaction_date,
        ];
    }
}
