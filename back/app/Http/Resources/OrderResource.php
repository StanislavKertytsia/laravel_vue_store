<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'userId' => $this->user_id,
            'city' => $this->city,
            'delivery' => $this->delivery,
            'products' => $this->products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'title' => $product->title,
                    'price' => $product->price,
                    'quantity' => $product->pivot->quantity,
                ];
            }),
            'total' => $this->total,
            'status' => $this->status,
            'createdAt' => $this->created_at->toDateTimeString(),
        ];
    }
}
