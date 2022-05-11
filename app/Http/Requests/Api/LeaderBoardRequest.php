<?php

namespace App\Http\Requests\Api;

use App\Models\GameHistory;
use Illuminate\Validation\Rule;
use App\Traits\FormRequest\HasPagination;
use Illuminate\Foundation\Http\FormRequest;

class LeaderBoardRequest extends FormRequest
{
    use HasPagination;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->paginationRule() + [
            'gameId' => [
                'nullable', 'string',
                'exists:' . Game::class . ',uuid'
            ],
            'gameSeasonId' => [
                'nullable', 'string',
                Rule::exists(GameHistory::class, 'game_season_id')
                    ->whereNull('deleted_at')
            ]
        ];
    }
}
