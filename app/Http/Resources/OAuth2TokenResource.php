<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OAuth2TokenResource extends JsonResource
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
            'requireRegister' => is_null($this->username),
            'accessToken' => $this->createToken("{$this->wallet_id}'s Token")->accessToken,
            'user' => (new UserResource($this->load('nationality')))->toArray($request)
        ];
    }
}
