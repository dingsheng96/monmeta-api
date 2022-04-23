<?php

namespace App\Http\Requests\Api\Transaction;

use App\Helpers\Status;
use App\Models\Transaction;
use Illuminate\Validation\Rule;
use App\Traits\FormRequest\HasPagination;
use Illuminate\Foundation\Http\FormRequest;

class TransactionListRequest extends FormRequest
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
            'fromDate' => [
                'nullable', 'date'
            ],
            'toDate' => [
                'nullable', 'date'
            ],
            'gameSeasonId' => [
                'nullable', 'string',
                Rule::exists(Transaction::class, 'game_season_id')
                    ->whereNull('deleted_at')
            ],
            'transactionHash' => [
                'nullable', 'string',
                Rule::exists(Transaction::class, 'hash_id')
                    ->whereNull('deleted_at')
            ],
            'transactionType' => [
                'nullable', 'string',
                Rule::in((new Transaction())->getTransactionType())
            ],
            'status' => [
                'nullable', 'string',
                Rule::in((new Status())->getTransactionStatus())
            ]
        ];
    }
}
