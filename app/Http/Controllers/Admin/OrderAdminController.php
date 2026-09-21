<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderAdminController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('user')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function create(): View
    {
        $users = User::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        return view(
            'admin.orders.create',
            compact('users', 'products')
        );
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => [
                'required',
                'exists:users,id',
            ],
            'status' => [
                'required',
                'in:pending,paid,shipped,cancelled',
            ],
            'products' => [
                'required',
                'array',
                'min:1',
            ],
            'products.*.id' => [
                'required',
                'exists:products,id',
            ],
            'products.*.quantity' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        $order = DB::transaction(function () use ($validated) {

            $total = 0;

            $products = Product::whereIn(
                'id',
                collect($validated['products'])
                    ->pluck('id')
                    ->filter()
                    ->values()
            )->get()->keyBy('id');

            foreach ($validated['products'] as $item) {
                $product = $products->get($item['id']);

                if (!$product) {
                    continue;
                }

                if ($item['quantity'] > $product->stock) {
                    abort(
                        422,
                        "Le stock du produit {$product->name} est insuffisant."
                    );
                }

                $total += $product->price * $item['quantity'];
            }

            if ($total <= 0) {
                abort(422, 'La commande doit contenir au moins un produit.');
            }

            $order = Order::create([
                'user_id' => $validated['user_id'],
                'total' => $total,
                'status' => $validated['status'],
            ]);

            foreach ($validated['products'] as $item) {
                $product = $products->get($item['id']);

                if (!$product) {
                    continue;
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ]);
            }

            return $order;
        });

        return redirect()
            ->route('admin.orders.show', $order)
            ->with(
                'success',
                'Commande créée avec succès.'
            );
    }

    public function show(Order $order): View
    {
        $order->load([
            'user',
            'items.product',
        ]);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(
        Request $request,
        Order $order
    ): RedirectResponse {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,paid,shipped,cancelled',
            ],
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        return back()->with(
            'success',
            'Statut de la commande mis à jour avec succès.'
        );
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with(
                'success',
                'Commande supprimée avec succès.'
            );
    }
}