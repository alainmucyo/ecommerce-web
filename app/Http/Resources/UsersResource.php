<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "phone" => $this->phone,
            "address" => $this->address,
            "email" => $this->email,
            "role" => $this->roles->first()->name,
            "role_id" => $this->roles->first()->id,
            "status" => $this->status,
            "created_at" => $this->created_at->toDateString(),
        ];
    }
}
