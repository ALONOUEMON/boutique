<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'PC Portable Lenovo',
                'price' => 799.99,
                'description' => 'Un excellent PC pour le travail.',
                'stock' => 10,
                'image' => null,
                'categories' => [1]
            ],
            [
                'name' => 'iPhone 14',
                'price' => 999.99,
                'description' => 'Smartphone haut de gamme.',
                'stock' => 15,
                'image' => null,
                'categories' => [2]
            ],
            [
                'name' => 'PlayStation 5',
                'price' => 549.99,
                'description' => 'Console nouvelle génération.',
                'stock' => 5,
                'image' => null,
                'categories' => [3]
            ],
        ];

        foreach ($products as $p) {
            $product = Product::create([
                'name' => $p['name'],
                'price' => $p['price'],
                'description' => $p['description'],
                'stock' => $p['stock'],
                'image' => $p['image'],
            ]);

            $product->categories()->attach($p['categories']);
        }
    }
}
