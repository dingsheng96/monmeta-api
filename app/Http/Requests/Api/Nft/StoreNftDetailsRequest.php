<?php

namespace App\Http\Requests\Api\Nft;

use Illuminate\Foundation\Http\FormRequest;

class StoreNftDetailsRequest extends FormRequest
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
                'required', 'string'
            ],
            'stars' => [
                'nullable', 'numeric', 'min:1'
            ],
            'chain' => [
                'nullable', 'string'
            ]
        ];
    }
}
