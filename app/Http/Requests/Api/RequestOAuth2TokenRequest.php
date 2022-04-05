<?php

namespace App\Http\Requests\Api;

use App\Models\User;
use App\Traits\FormRequest\HasApiResponse;
use Illuminate\Foundation\Http\FormRequest;

class RequestOAuth2TokenRequest extends FormRequest
{
    use HasApiResponse;

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
        return [
            'walletId' => [
                'required',
                'string',
                'exists:' . User::class . ',wallet_id'
            ]
        ];
    }
}
