<?php

namespace App\Http\Requests\Api\GameHistory;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;

class StoreGameHistoryRequest extends FormRequest
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
            'gameId' => [
                'required'
            ],
            'gameName' => [
                'required'
            ],
            'points' => [
                'required', 'integer'
            ],
            'startedAt' => [
                'required', 'date', 'before:endedAt'
            ],
            'endedAt' => [
                'required', 'date', 'after:startedAt'
            ],
            'roomId' => [
                'required'
            ],
            'gameSeasonId' => [
                'required'
            ],
            'position' => [
                'required', 'integer'
            ]
        ];
    }
}
