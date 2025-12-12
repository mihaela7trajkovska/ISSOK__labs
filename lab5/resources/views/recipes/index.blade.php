@extends('layouts.app')

@section('content')
    <h1>Recipes</h1>

    <form method="GET" class="row g-2 mb-3">
        <div class="col-auto">
            <input name="q" class="form-control" placeholder="Search title..." value="{{ request('q') }}">
        </div>
        <div class="col-auto">
            <select name="category_id" class="form-select">
                <option value="">All categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('category_id') == $cat->id)>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary">Filter</button>
        </div>
    </form>

    <a href="{{ route('recipes.create') }}" class="btn btn-success mb-3">New Recipe</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Ingredients</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($recipes as $recipe)
            <tr>
                <td><a href="{{ route('recipes.show', $recipe) }}">{{ $recipe->title }}</a></td>
                <td>{{ $recipe->category->name }}</td>
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
            <tr><td colspan="4">No recipes found.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $recipes->links() }}
@endsection
