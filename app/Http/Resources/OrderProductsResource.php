<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "quantity" => $this->quantity,
            "price" => $this->price,
            "size" => $this->size,
            "product" => $this->product->title,
            "product_image" => $this->product->product_image,
            "insurance" => $this->insurance,
            "customer" => $this->customer,
            "delivery_fee" => $this->order->deliveryFee,
            "slug" => $this->product->slug,
            "image" => $this->product_image,
            "delivered" => $this->delivered,
            "delivered_at" => $this->delivered_at,
            "received" => $this->received,
            "received_at" => $this->received_at,
            "seller" => $this->seller
        ];
    }
}
