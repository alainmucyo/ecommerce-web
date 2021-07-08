<?php

namespace App\Http\Controllers;

use App\Chatbox;
use App\Http\Resources\CustomerChatList;
use App\Http\Resources\CustomerMessagesResource;
use App\Http\Resources\SellerChatList;
use App\Http\Resources\SellerMessagesResource;
use App\Order;
use App\OrderProduct;
use App\User;
use Illuminate\Http\Request;

class ChatboxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function customerChat()
    {
        $user_id = auth()->user()->id;
        Chatbox::where("status", 0)->where("customer_id", $user_id)->where("sender", "!=", $user_id)->update(["status" => 1]);

        return view("chatbox.index");
    }

    public function sellerChat()
    {
        $user_id = auth()->user()->id;
        Chatbox::where("status", 0)->where("seller_id", $user_id)->where("sender", "!=", $user_id)->update(["status" => 1]);
        return view("seller.chatbox.index");
    }


    public function chatList()
    {
        if (auth()->user()->hasRole("customer")) {

            $orders = Order::where("customer_id", auth()->user()->id)->pluck("id");
            $seller_ids = OrderProduct::whereIn("order_id", $orders)->distinct()->pluck("seller_id")->toArray();

            $message_seller_id = Chatbox::where("customer_id", auth()->user()->id)->whereNotIn("seller_id", $seller_ids)->distinct()->pluck("seller_id")->toArray();
            $new_seller_ids = array_merge($seller_ids, $message_seller_id);

            if ($req_seller_id = \request("seller_id")) {
                if ($req_seller_id != 0)
                    array_push($new_seller_ids, $req_seller_id);
            }
            $sellers = User::whereIn("id", $new_seller_ids)->get();
            return CustomerChatList::collection($sellers);
        } else {
            $order_ids = OrderProduct::where("seller_id", auth()->user()->id)->pluck("order_id");
            $customer_ids = Order::whereIn("id", $order_ids)->pluck("customer_id")->toArray();
            $message_customer_ids = Chatbox::where("seller_id", auth()->user()->id)->whereNotIn("customer_id", $customer_ids)->distinct()->pluck("customer_id")->toArray();
            $new_customer_ids = array_merge($customer_ids, $message_customer_ids);
            $customers = User::whereIn("id", $new_customer_ids)->get();
            return SellerChatList::collection($customers);
        }
    }

    public function getMessages($chatter_id)
    {
        if (auth()->user()->hasRole("customer")) {
            $messages = Chatbox::where("customer_id", auth()->user()->id)->where("seller_id", $chatter_id)->latest()->get();
            Chatbox::where("status", 0)->where("customer_id", auth()->user()->id)->where("seller_id", $chatter_id)->where("sender", "!=", auth()->user()->id)->update(["status" => 1]);
            return CustomerMessagesResource::collection($messages);
        } else {
            $messages = Chatbox::where("seller_id", auth()->user()->id)->where("customer_id", $chatter_id)->latest()->get();
            Chatbox::where("status", 0)->where("seller_id", auth()->user()->id)->where("customer_id", $chatter_id)->where("sender", "!=", auth()->user()->id)->update(["status" => 1]);
            return SellerMessagesResource::collection($messages);
        }
    }

    public function storeMessages(Request $request)
    {
        $request->validate([
            "message" => "required",
            "receiver_id" => "required"
        ]);

        if (auth()->user()->hasRole("customer")) {
            $chatbox = Chatbox::create([
                "customer_id" => auth()->user()->id,
                "seller_id" => $request['receiver_id'],
                "message" => $request['message'],
                "sender" => auth()->user()->id
            ]);
            return new CustomerMessagesResource($chatbox);
        } else {
            $chatbox = Chatbox::create([
                "seller_id" => auth()->user()->id,
                "customer_id" => $request['receiver_id'],
                "message" => $request['message'],
                "sender" => auth()->user()->id
            ]);
            return new CustomerMessagesResource($chatbox);
        }
    }


    public function show(Chatbox $chatbox)
    {
        //
    }

    public function edit(Chatbox $chatbox)
    {
        //
    }


    public function update(Request $request, Chatbox $chatbox)
    {
        //
    }

    public function destroy(Chatbox $chatbox)
    {
        //
    }
}
