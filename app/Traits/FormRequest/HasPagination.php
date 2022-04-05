<?php

namespace App\Traits\FormRequest;

trait HasPagination
{
    public function paginationRule(): array
    {
        return [
            'page' => [
                'required', 'integer', 'regex:/^[1-9]\d*$/'
            ]
        ];
    }
}
