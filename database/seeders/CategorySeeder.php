<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Categoryseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'vegan food',
            'slug' => 'vegan-food',
            'color' => 'green'
        ]);

        Category::create([
            'name' => 'meat product',
            'slug' => 'meat-product',
            'color' => 'red'
        ]);

        Category::create([
            'name' => 'seafood',
            'slug' => 'seafood',
            'color' => 'orange'
        ]);

        Category::create([
            'name' => 'dairy product',
            'slug' => 'dairy-product',
            'color' => 'blue'
        ]);
    }
}
