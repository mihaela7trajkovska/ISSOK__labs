@extends('layouts.app')

@section('content')
    <h1>Category: {{ $category->name }}</h1>

    <h3>Recipes in this category</h3>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Title</th>
            <th>Ingredients</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($recipes as $recipe)
            <tr>
                <td><a href="{{ route('recipes.show', $recipe) }}">{{ $recipe->title }}</a></td>
                <td>{{ Str::limit($recipe->ingredients, 40) }}</td>
                <td>
                    <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3">No recipes found.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $recipes->links() }}

    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to Categories</a>
@endsection
