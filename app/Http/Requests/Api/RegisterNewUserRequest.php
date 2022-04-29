<?php

namespace App\Http\Requests\Api;

use App\Models\User;
use App\Models\Country;
use Illuminate\Validation\Rule;
use App\Rules\ValidatePersonalIdTypeFormat;
use Illuminate\Foundation\Http\FormRequest;

class RegisterNewUserRequest extends FormRequest
{
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
        $rules = [
            'walletId' => [
                'required', 'string'
            ],
            'userName' => [
                'required', 'string',
                Rule::unique(User::class, 'username')
                    ->whereNull('deleted_at')
            ],
            'firstName' => [
                'required', 'string'
            ],
            'lastName' => [
                'required', 'string'
            ],
            'email' => [
                'required', 'email'
            ],
            'contactNo' => [
                'required', 'string'
            ],
            'nationality' => [
                'required', 'string', 'exists:' . Country::class . ',code'
            ],
            'personalIdType' => [
                'required',
                'string',
                Rule::in(explode(',', Country::where('code', $this->get('nationality'))->value('personal_id_type')))
            ],
            'personalIdNo' => [
                'required',
                'string',
            ]
        ];

        if (!empty($this->get('personalIdType'))) {
            $rules['personalIdNo'] = array_merge($rules['personalIdNo'], [new ValidatePersonalIdTypeFormat($this->get('personalIdType'))]);
        }

        return $rules;
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation()
    {
        $this->merge([
            'nationality_id' => Country::where('code', $this->get('nationality'))->value('id')
        ]);
    }
}
