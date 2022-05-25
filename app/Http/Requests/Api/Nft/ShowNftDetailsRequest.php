<?php

namespace App\Http\Requests\Api\Nft;

use App\Models\Nft;
use App\Models\GameHistory;
use Illuminate\Validation\Rule;
use App\Traits\FormRequest\HasPagination;
use Illuminate\Foundation\Http\FormRequest;

class ShowNftDetailsRequest extends FormRequest
{
    use HasPagination;

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
        return $this->paginationRule() + [
            'nftId' => [
                'nullable', 'string',
                Rule::exists(Nft::class, 'token_id')
                    ->where('user_id', $this->user()->id)
                    ->whereNull('deleted_at')
            ],
            'gameSeasonId' => [
                'nullable', 'string',
                Rule::exists(GameHistory::class, 'game_season_id')
                    ->whereNull('deleted_at')
            ],
            'chain' => [
                'nullable', 'string'
            ]
        ];
    }
}
