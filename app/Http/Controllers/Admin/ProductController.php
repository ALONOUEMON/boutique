<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::with('categories')->latest()->get();

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'string', 'max:255'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_ids' => ['required', 'array', 'min:1'],
            'category_ids.*' => ['exists:categories,id'],
        ]);

        $categoryIds = $validated['category_ids'];

        unset($validated['category_ids']);

        $product = Product::create($validated);

        $product->categories()->sync($categoryIds);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit créé avec succès.');
    }

    public function show(Product $product): View
    {
        $product->load('categories');

        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        $categories = Category::orderBy('name')->get();

        $product->load('categories');

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'string', 'max:255'],
            'stock' => ['required', 'integer', 'min:0'],
            'category_ids' => ['required', 'array', 'min:1'],
            'category_ids.*' => ['exists:categories,id'],
        ]);

        $categoryIds = $validated['category_ids'];

        unset($validated['category_ids']);

        $product->update($validated);

        $product->categories()->sync($categoryIds);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit modifié avec succès.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->categories()->detach();

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produit supprimé avec succès.');
    }
}