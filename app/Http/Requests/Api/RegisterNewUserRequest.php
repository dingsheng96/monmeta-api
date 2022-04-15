<?php

namespace App\Http\Requests\Api;

use App\Models\User;
use App\Models\Country;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
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
        return Auth::guard('api')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
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
                'required', 'string', Rule::in(explode(',', Country::where('code', $this->get('nationality'))->value('personal_id_type')))
            ],
            'personalIdNo' => [
                'required', 'string', new ValidatePersonalIdTypeFormat($this->get('personalIdType'))
            ]
        ];
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation()
    {
        $this->request->set(
            'nationality',
            Country::where('code', $this->get('nationality'))->value('id')
        );
    }
}
