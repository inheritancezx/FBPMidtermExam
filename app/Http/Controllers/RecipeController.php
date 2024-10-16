<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RecipeController extends Controller {
    public function store(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255',
            'course' => 'required|string',
            'category' => 'required|string',
            'est_price' => 'required|string',
            'content' => 'required|string'  
        ]);
        
        $coursevar = $request->input('course'); 
        $courseId = Course::where('name', $coursevar)->first()->id;

        $categoryvar = $request->input('category'); 
        $categoryId = Category::where('name', $categoryvar)->first()->id;


        $name = $request->input('name');
        $course_id = $courseId;
        $category_id = $categoryId;
        $slug = Str::slug($name);
        $est_price = $request->input('est_price');
        $content = $request->input('content');

        // Create a new item in the database
        Recipe::create([
            'name' => $name,
            'course_id' => $course_id,
            'category_id' => $category_id,
            'slug' => $slug,
            'est_price' => $est_price,
            'content' => $content
        ]);

        // Redirect or return a response (optional)
        return redirect()->back()->with('success', 'Recipe added successfully!');
    }

    public function destroy($id) {
        $recipe = Recipe::findOrFail($id); // Find the recipe by its ID
        $recipe->delete(); // Delete the recipe
        return redirect()->route('profile')->with('success', 'Recipe deleted successfully!');
    }
}
