<?php

namespace App\Traits\FormRequest;

trait HasPagination
{
    public function paginationRule()
    {
        return [
            'page' => [
                'required', 'integer', 'gt:0'
            ],
            'itemsCount' => [
                'required', 'integer', 'gte:4'
            ]
        ];
    }
}
