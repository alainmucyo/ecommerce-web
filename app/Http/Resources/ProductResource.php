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
            "client_max" => $this->client_max,
            "sizes" => json_decode($this->sizes),
            "images" => $this->images,
            "price_usa" => $this->price_usa,
            "price_dirham" => $this->price_dirham,
            "seller" => $this->seller,
            "description" => $this->description,
            "categories" => $this->categories,
            "discount" => $this->discount,
            "home_slider"=>$this->home_slider,
            "home_section_id"=> (int)$this->home_section_id,
            "likes" => $this->likes->count(),
            "created_at" => $this->created_at->toDateString()
        ];
    }
}
