<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        Category::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    public function edit(Category $category): View
    {
        $products = Product::orderBy('name')->get();

        $category->load('products');

        return view(
            'admin.categories.edit',
            compact('category', 'products')
        );
    }

    public function update(
        Request $request,
        Category $category
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'product_ids' => ['nullable', 'array'],
            'product_ids.*' => ['exists:products,id'],
        ]);

        $productIds = $validated['product_ids'] ?? [];

        unset($validated['product_ids']);

        $category->update($validated);

        $category->products()->sync($productIds);

        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Catégorie et produits associés mis à jour avec succès.'
            );
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->products()->detach();

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Catégorie supprimée avec succès.');
    }
}