<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Informatique', 'description' => 'Ordinateurs, accessoires, composants'],
            ['name' => 'Smartphones', 'description' => 'Téléphones, accessoires'],
            ['name' => 'Gaming', 'description' => 'Consoles, jeux, accessoires'],
            ['name' => 'Maison', 'description' => 'Objets pour la maison'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
