<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
}