<?php

namespace App\Services;

use App\Dto\Order\OrderDto;
use App\Interfaces\OrderInterface;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderService implements OrderInterface
{
    public function create(string $userId, OrderDto $dto)
    {
        return DB::transaction(function () use ($userId, $dto) {
            $order = Order::create([
                'user_id' => $userId,
                'city' => $dto->city,
                'delivery' => $dto->delivery,
                'total' => 0,
                'status' => 'pending',
            ]);

            $total = 0;

            foreach ($dto->products as $item) {
                $product = Product::where('id', $item['id'])->lockForUpdate()->firstOrFail();
                
                $quantity = $item['quantity'];

                if ($quantity > $product->stock) {
                    throw ValidationException::withMessages([
                        'quantity' => ["Requested quantity ({$quantity}) for product '{$product->title}' exceeds available stock ({$product->stock})."]
                    ]);
                }

                $order->products()->attach($product->id, ['quantity' => $quantity]);

                $product->decrement('stock', $quantity);

                $total += $product->price * $quantity;
            }

            $order->total = $total;
            $order->save();

            return $order;
        });
    }


}
