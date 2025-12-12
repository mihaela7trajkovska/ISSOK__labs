<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::query()->with('category');

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $recipes = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('recipes.index', compact('recipes', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('recipes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|min:50',
            'ingredients' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        Recipe::create($request->all());

        return redirect()->route('recipes.index')
            ->with('success', 'Recipe created.');
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        $categories = Category::all();
        return view('recipes.edit', compact('recipe', 'categories'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|min:50',
            'ingredients' => 'required',
            'category_id' => 'required|exists:categories,id'
        ]);

        $recipe->update($request->all());

        return redirect()->route('recipes.index')
            ->with('success', 'Recipe updated.');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->route('recipes.index')
            ->with('success', 'Recipe deleted.');
    }
}
