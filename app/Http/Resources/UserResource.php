<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'walletId' => $this->wallet_id,
            'userName' => $this->username,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'email' => $this->email,
            'contactNo' => $this->contact_no,
            'nationality' => $this->nationality->name,
            'personalIdType' => $this->personal_id_type,
            'personalIdNo' => $this->personal_id_no
        ];

        if ($this->relationLoaded('transactions')) {
            $data += [
                'usdt' => [
                    'totalPrizes' => $this->formatted_usdt_total_prizes,
                    'totalBuyIn' => $this->formatted_usdt_total_buy_in,
                    'profitLoss' => $this->formatted_usdt_profit_loss
                ],
                'mspc' => [
                    'totalPrizes' => $this->formatted_mspc_total_prizes,
                    'totalBuyIn' => $this->formatted_mspc_total_buy_in,
                    'profitLoss' => $this->formatted_mspc_profit_loss
                ]
            ];
        }

        return $data;
    }
}
