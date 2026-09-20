<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    // Afficher le panier
    public function index(Request $request): View
    {
        if (auth()->check()) {
            $items = CartItem::with('product')
                ->where('user_id', auth()->id())
                ->get();
        } else {
            $items = collect(
                json_decode($request->cookie('cart', '[]'), true)
            );
        }

        return view('cart.index', compact('items'));
    }

    // Ajouter au panier
    public function add(
        Request $request,
        Product $product
    ): RedirectResponse {
        $validated = $request->validate([
            'quantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $quantity = $validated['quantity'] ?? 1;

        if ($product->stock < $quantity) {
            return back()->with(
                'error',
                'La quantité demandée dépasse le stock disponible.'
            );
        }

        if (auth()->check()) {

            $item = CartItem::where('user_id', auth()->id())
                ->where('product_id', $product->id)
                ->first();

            if ($item) {

                $newQuantity = $item->quantity + $quantity;

                if ($newQuantity > $product->stock) {
                    return back()->with(
                        'error',
                        'La quantité demandée dépasse le stock disponible.'
                    );
                }

                $item->update([
                    'quantity' => $newQuantity,
                ]);

            } else {

                CartItem::create([
                    'user_id' => auth()->id(),
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                ]);
            }

            return back()->with(
                'success',
                'Produit ajouté au panier.'
            );
        }

        $cart = json_decode(
            $request->cookie('cart', '[]'),
            true
        );

        $found = false;

        foreach ($cart as &$item) {

            if ($item['product_id'] == $product->id) {

                $newQuantity = $item['quantity'] + $quantity;

                if ($newQuantity > $product->stock) {
                    return back()->with(
                        'error',
                        'La quantité demandée dépasse le stock disponible.'
                    );
                }

                $item['quantity'] = $newQuantity;
                $found = true;

                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'product_id' => $product->id,
                'quantity' => $quantity,
            ];
        }

        return back()
            ->with('success', 'Produit ajouté au panier.')
            ->cookie(
                'cart',
                json_encode($cart),
                60 * 24 * 7
            );
    }

    // Modifier la quantité
    public function update(
        Request $request,
        Product $product
    ): RedirectResponse {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $quantity = $validated['quantity'];

        if ($quantity > $product->stock) {
            return back()->with(
                'error',
                'La quantité demandée dépasse le stock disponible.'
            );
        }

        if (auth()->check()) {

            $item = CartItem::where('user_id', auth()->id())
                ->where('product_id', $product->id)
                ->first();

            if ($item) {
                $item->update([
                    'quantity' => $quantity,
                ]);
            }

            return back()->with(
                'success',
                'Quantité mise à jour.'
            );
        }

        $cart = json_decode(
            $request->cookie('cart', '[]'),
            true
        );

        foreach ($cart as &$item) {

            if ($item['product_id'] == $product->id) {
                $item['quantity'] = $quantity;
                break;
            }
        }

        return back()
            ->with('success', 'Quantité mise à jour.')
            ->cookie(
                'cart',
                json_encode($cart),
                60 * 24 * 7
            );
    }

    // Supprimer un produit du panier
    public function remove(
        Request $request,
        Product $product
    ): RedirectResponse {

        if (auth()->check()) {

            CartItem::where('user_id', auth()->id())
                ->where('product_id', $product->id)
                ->delete();

            return back()->with(
                'success',
                'Produit supprimé du panier.'
            );
        }

        $cart = json_decode(
            $request->cookie('cart', '[]'),
            true
        );

        $cart = array_filter(
            $cart,
            function ($item) use ($product) {
                return $item['product_id'] != $product->id;
            }
        );

        return back()
            ->with('success', 'Produit supprimé du panier.')
            ->cookie(
                'cart',
                json_encode(array_values($cart)),
                60 * 24 * 7
            );
    }
}