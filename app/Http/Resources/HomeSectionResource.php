<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeSectionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "discount" => $this->discount ? true : false,
            "discount_end_date" => $this->discount_time ? Carbon::parse($this->discount_time)->toDateString() : null,
            "discount_end_time" => $this->discount_time ? Carbon::parse($this->discount_time)->toTimeString() : null,
            "products" => $this->products->count(),
            "created_at" => $this->created_at->toDateString()
        ];
    }
}
