@extends('layouts.app')

@section('content')
    <h1>Create Recipe</h1>

    <form action="{{ route('recipes.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}">
            @error('title')<div>{{ $message }}</div>@enderror
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
            @error('description')<div>{{ $message }}</div>@enderror
        </div>

        <div>
            <label for="ingredients">Ingredients:</label>
            <textarea name="ingredients" id="ingredients">{{ old('ingredients') }}</textarea>
            @error('ingredients')<div>{{ $message }}</div>@enderror
        </div>

        <div>
            <label for="category_id">Category:</label>
            <select name="category_id" id="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')<div>{{ $message }}</div>@enderror
        </div>

        <button type="submit">Create Recipe</button>
    </form>
@endsection
