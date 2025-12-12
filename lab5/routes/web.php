<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecipeController;

Route::resource('categories', CategoryController::class);
Route::resource('recipes', RecipeController::class);

Route::get('/', fn() => redirect()->route('recipes.index'));
