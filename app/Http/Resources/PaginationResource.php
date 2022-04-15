<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'meta' => [
                'totalPages' => $this->lastPage(),
                'totalItems' => $this->total(),
                'currentPage' => $this->currentPage(),
                'currentPageItems' => $this->count()
            ],
            'links' => [
                'currentPageUrl' => $this->url($this->currentPage()),
                'firstPageUrl' => $this->url(1),
                'nextPageUrl' => $this->nextPageUrl(),
                'previousPageUrl' => $this->previousPageUrl(),
                'lastPageUrl' => $this->url($this->lastPage()),
            ]
        ];
    }
}
