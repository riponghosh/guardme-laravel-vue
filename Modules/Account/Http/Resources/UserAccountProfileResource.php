<?php

namespace Modules\Account\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserAccountProfileResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'registeredAt' => $this->registered_date->format('Y-m-d'),
            'primaryRole' => new RoleResource($this->getPrimaryRole()),
            'token' => $this->api_token,
            'authType' => $this->metadata['auth_type'] ?? null
        ];
    }
}
