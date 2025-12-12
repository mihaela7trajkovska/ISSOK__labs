@extends('layouts.app')

@section('content')
    <h1>Edit Recipe</h1>

    <form action="{{ route('recipes.update', $recipe) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="{{ old('title', $recipe->title) }}">
            @error('title')<div>{{ $message }}</div>@enderror
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description">{{ old('description', $recipe->description) }}</textarea>
            @error('description')<div>{{ $message }}</div>@enderror
        </div>

        <div>
            <label for="ingredients">Ingredients:</label>
            <textarea name="ingredients" id="ingredients">{{ old('ingredients', $recipe->ingredients) }}</textarea>
            @error('ingredients')<div>{{ $message }}</div>@enderror
        </div>

        <div>
            <label for="category_id">Category:</label>
            <select name="category_id" id="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $recipe->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')<div>{{ $message }}</div>@enderror
        </div>

        <button type="submit">Update Recipe</button>
    </form>
@endsection
