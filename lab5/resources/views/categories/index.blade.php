@extends('layouts.app')

@section('content')
    <h1>Categories</h1>

    <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">New Category</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Recipes</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($categories as $category)
            <tr>
                <td><a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a></td>
                <td>{{ $category->recipes()->count() }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3">No categories found.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $categories->links() }}
@endsection
