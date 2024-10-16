<?php

use App\Models\Food;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RegisterController;
use App\Models\Recipe;

Route::middleware(['guest'])->group(function() {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register',[RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'create']);
    Route::post('/login', [LoginController::class, 'store']);
});

Route::get('/', function () {
    return view('home', ['foods' => $foods=Food::latest()->limit(4)->get()]);
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/recipes', function () {
        return view('recipes', ['foods' => $foods=Food::filter(request(['search', 'category', 'course']))->latest()->paginate(12)->withQueryString(), 
        'courses' => $courses=Course::latest()->get()]);
    });  

    Route::get('/recipes/{food:slug}', function (Food $food) {
        return view('recipe', ['food' => $food]);
    });

    Route::get('/profile', function () {
        return view('profile', ['recipes' => $recipes=Recipe::latest()->get()]);
    })->name('profile');

    Route::get('/profile/{recipe:slug}', function (Recipe $recipe) {
        return view('Myrecipe', ['recipe' => $recipe]);
    });

    Route::post('/recipe/store',[RecipeController::class,'store'])->name('recipe.store');
    Route::delete('/recipe/{id}', [RecipeController::class, 'destroy'])->name('recipe.destroy');
});

Route::post('/logout',[LoginController::class,'destroy']);
