<?php

namespace App\Http\Requests\Api\GameHistory;

use App\Models\Nft;
use App\Models\Game;
use App\Helpers\Status;
use App\Models\GameHistory;
use Illuminate\Validation\Rule;
use App\Traits\FormRequest\HasPagination;
use Illuminate\Foundation\Http\FormRequest;

class GameHistoryListRequest extends FormRequest
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
                'required', 'string',
                Rule::exists(Nft::class, 'token_id')
                    ->where('user_id', $this->user()->id)
                    ->where('status', Status::STATUS_ACTIVE)
                    ->whereNull('deleted_at')
            ],
            'gameId' => [
                'nullable', 'string',
                'exists:' . Game::class . ',uuid'
            ],
            'roomId' => [
                'nullable', 'string',
                'exists:' . GameHistory::class . ',room_id'
            ],
            'gameSeasonId' => [
                'nullable', 'string',
                'exists:' . GameHistory::class . ',game_season_id'
            ],
            'fromDate' => [
                'nullable', 'date'
            ],
            'toDate' => [
                'nullable', 'date'
            ],
        ];
    }
}
