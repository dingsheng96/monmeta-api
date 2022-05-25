<?php

namespace App\Http\Resources;

use App\Models\Transaction;
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
        $data = [
            'transactionHash' => $this->hash_id,
            'status' => $this->status,
            'type' => $this->type,
            'gameSeasonId' => $this->game_season_id,
            'description' => $this->description,
            'transactionDate' => $this->transaction_date,
            'usdtValue' => $this->formatted_usdt,
            'mspcValue' => $this->formatted_mspc
        ];

        if ($this->type == Transaction::TYPE_PURCHASE_NFT && !empty($this->nft_id)) {
            $this->load('nft');
            $data = array_merge($data, (new NftResource($this->nft))->toArray($request));
        }

        return $data;
    }
}
