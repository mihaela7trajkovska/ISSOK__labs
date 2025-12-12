@extends('layouts.app')

@section('content')
    <h1>{{ isset($category) ? 'Edit' : 'Create' }} Category</h1>

    <form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}" method="POST">
        @csrf
        @if(isset($category)) @method('PUT') @endif

        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}">
            @error('name')<div>{{ $message }}</div>@enderror
        </div>

        <button type="submit">{{ isset($category) ? 'Update' : 'Create' }}</button>
    </form>
@endsection
