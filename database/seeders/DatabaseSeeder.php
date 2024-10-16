<?php

namespace Database\Seeders;

use App\Models\Food;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call([CategorySeeder::class, CourseSeeder::class]);
        Food::factory(100)->recycle([
            Category::all(),
            Course::all()
        ])->create();
        
        // user seeds
        User::factory()->create([
            'name' => 'Skye',
            'email' => 'skye@recipe.com',
            'password' => Hash::make('password')
        ]);

        User::factory()->create([
            'name' => 'Cally',
            'email' => 'cally@reciepe.com',
            'password' => Hash::make('password')
        ]);

        // recipe seed 
        Recipe::create([
            'name' => 'Pempek Kapal selam',
            'course_id' => '2',
            'category_id' => '1',
            'slug' => 'pempek-kapal-selam',
            'est_price' => '14,000',
            'content' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
            Repellendus sed eum natus possimus praesentium ipsum quod ut. Laudantium ipsam quam, 
            aliquid aspernatur exercitationem esse voluptate, ea ducimus saepe incidunt alias.'
        ]);
    }
}
