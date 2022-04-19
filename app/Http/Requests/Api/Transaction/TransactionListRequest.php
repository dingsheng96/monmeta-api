<?php

namespace App\Http\Requests\Api\Transaction;

use App\Models\Nft;
use App\Models\User;
use App\Helpers\Status;
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
        ];
    }
}
