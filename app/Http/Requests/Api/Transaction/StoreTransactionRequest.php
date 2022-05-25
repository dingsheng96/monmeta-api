<?php

namespace App\Http\Requests\Api\Transaction;

use App\Models\Transaction;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'transactionHash' => [
                'required', 'string'
            ],
            'type' => [
                'required', 'string'
            ],
            'gameSeasonId' => [
                'nullable', 'string',
                'required_if:type,' . Transaction::TYPE_PURCHASE_TICKET
            ],
            'nftId' => [
                'nullable', 'string',
                'required_if:type,' . Transaction::TYPE_PURCHASE_NFT
            ],
            'mspcValue' => [
                'required',
            ],
            'usdtValue' => [
                'required',
            ],
            'chain' => [
                'nullable', 'string'
            ]
        ];
    }
}
