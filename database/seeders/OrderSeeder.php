<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $user = User::first(); // premier utilisateur

        $order = Order::create([
            'user_id' => $user->id,
            'total' => 1499.98,
            'status' => 'paid',
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => 1,
            'quantity' => 1,
            'price' => 799.99,
        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => 2,
            'quantity' => 1,
            'price' => 699.99,
        ]);
    }
}
