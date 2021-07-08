<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "price" => $this->price,
            "min_price" => $this->min_price?:0,
            "max_price" => $this->max_price?:0,
            "client_max" => $this->client_max,
            "sizes" => json_decode($this->sizes),
            "seller" => $this->seller,
            "description" => $this->description,
            "categories" => $this->categories,
            "discount" => $this->discount,
            "home_section_id"=> (int)$this->home_section_id,
            "likes" => $this->likes->count(),
            "created_at" => $this->created_at->toDateString()
        ];
    }
}
