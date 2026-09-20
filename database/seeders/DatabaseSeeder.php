<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        fwrite(STDERR, "\n>>> DATABASESEEDER EXECUTE <<<\n");

        $this->call([
            AdminSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            OrderSeeder::class,
        ]);

        fwrite(STDERR, "\n>>> DATABASESEEDER TERMINE <<<\n");
    }
}