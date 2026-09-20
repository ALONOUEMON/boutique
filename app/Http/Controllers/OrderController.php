<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function create(): View
    {
        return view('order.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $user = auth()->user();

        $cartItems = CartItem::with('product')
            ->where('user_id', $user->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Votre panier est vide.');
        }

        $total = 0;

        foreach ($cartItems as $item) {
            if (!$item->product) {
                continue;
            }

            $total += $item->product->price * $item->quantity;
        }

        if ($total <= 0) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Votre panier ne contient aucun produit valide.');
        }

        $order = DB::transaction(function () use ($user, $cartItems, $total) {

            $order = Order::create([
                'user_id' => $user->id,
                'total' => $total,
                'status' => 'pending',
            ]);

            foreach ($cartItems as $item) {

                if (!$item->product) {
                    continue;
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            CartItem::where('user_id', $user->id)->delete();

            return $order;
        });

        return redirect()
            ->route('order.success', $order);
    }

    public function success(Order $order): View
    {
        abort_unless(
            $order->user_id === auth()->id(),
            403
        );

        $order->load('items.product');

        return view('order.success', compact('order'));
    }

    public function history(): View
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('order.history', compact('orders'));
    }
}