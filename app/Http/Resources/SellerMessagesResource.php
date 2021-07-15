<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class SellerMessagesResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "message" => $this->message,
            "sender_avatar" =>  "/img/user.png",
            "sent_at" => Carbon::parse($this->created_at)->diffForHumans(),
            "incoming" => $this->sender != auth()->user()->id,
            "outgoing" => $this->sender == auth()->user()->id
        ];
    }
}
