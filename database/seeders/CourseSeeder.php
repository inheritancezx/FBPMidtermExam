<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create([
            'name' => 'appetizer',
        ]);

        Course::create([
            'name' => 'main',
        ]);

        Course::create([
            'name' => 'dessert',
        ]);

        Course::create([
            'name' => 'side',
        ]);
    }
}
