<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductImageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "slug"=>$this->slug,
            "price" => $this->price,
            "price_usa" => $this->price_usa,
            "client_max" => $this->client_max,
            "sizes" => json_decode($this->sizes),
            "seller" => $this->seller,
            "description" => $this->description,
            "categories" => $this->categories,
            "discount"=>$this->discount,
            "images" => $this->images,
        ];
    }
}
