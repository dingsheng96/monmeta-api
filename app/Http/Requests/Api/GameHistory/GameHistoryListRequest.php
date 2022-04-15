<?php

namespace App\Http\Requests\Api\GameHistory;

use App\Models\Nft;
use App\Helpers\Status;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class GameHistoryListRequest extends FormRequest
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
            'nftId' => [
                'required', 'string',
                Rule::exists(Nft::class, 'token_id')
                    ->where('user_id', $this->user()->id)
                    ->where('status', Status::STATUS_ACTIVE)
                    ->whereNull('deleted_at')
            ],
            'fromDate' => [
                'required', 'date'
            ],
            'toDate' => [
                'required', 'date'
            ]
        ];
    }
}
