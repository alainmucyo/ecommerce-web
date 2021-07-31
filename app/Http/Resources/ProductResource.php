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
            "images" => $this->images,
            "price_usa" => $this->price_usa,
            "max_price_usa" => $this->max_price_usa?:0,
            "min_price_usa" => $this->min_price_usa?:0,
            "price_dirham" => $this->price_dirham,
            "max_price_dirham" => $this->max_price_dirham?:0,
            "min_price_dirham" => $this->min_price_dirham?:0,
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
