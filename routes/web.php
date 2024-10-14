<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'homepage']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'about']);
});

Route::get('/recipes', function () {
    return view('recipes', ['title' => 'recipes']);
});

Route::get('/faq', function () {
    return view('faq', ['title' => 'faq']);
});

Route::get('/login', function () {
    return view('login', ['title' => 'login']);
});

Route::get('/register', function () {
    return view('register', ['title' => 'register']);
});
