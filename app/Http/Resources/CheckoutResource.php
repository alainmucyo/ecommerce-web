<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckoutResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "quantity" => $this->quantity,
            "price" => $this->price,
            "insurance" => $this->product->categories->first()->insurance,
            "product" => $this->product,
        ];
    }
}
