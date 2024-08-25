<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'username' => $this->username,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'biography' => $this->biography,
            'activation_code' => $this->activation_code,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
