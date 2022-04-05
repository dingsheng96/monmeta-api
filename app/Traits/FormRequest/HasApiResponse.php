<?php

namespace App\Traits\FormRequest;

use App\Support\Facades\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

trait HasApiResponse
{
    protected function failedValidation(Validator $validator)
    {
        $validation = new ValidationException($validator);

        throw new HttpResponseException(
            ApiResponse::setUnprocessableEntityStatusCode()
                ->setError($validation->errors())
                ->toFailJson()
        );

        parent::failedValidation($validator);
    }
}
