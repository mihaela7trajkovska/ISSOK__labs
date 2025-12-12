@extends('layouts.app')

@section('content')
    <h1>{{ $recipe->title }}</h1>

    <p><strong>Category:</strong> {{ $recipe->category->name }}</p>
    <p><strong>Description:</strong> {{ $recipe->description }}</p>
    <p><strong>Ingredients:</strong> {{ $recipe->ingredients }}</p>

    <a href="{{ route('recipes.edit', $recipe) }}" class="btn btn-primary">Edit</a>

    <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" style="display:inline;">
        @csrf @method('DELETE')
        <button class="btn btn-danger" onclick="return confirm('Delete?')">Delete</button>
    </form>

    <a href="{{ route('recipes.index') }}" class="btn btn-secondary">Back to list</a>
@endsection
