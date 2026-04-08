@extends('partials.master')
@section('content')

<div class="container mt-4">
    <h3 class="mb-3 text-primary">Category Edit </h3>

    <div class="card shadow-sm border-0" style="max-width:600px;">
        <div class="card-body p-0">

<form action="{{ route('category.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="category_name" value="{{ $category->category_name }}" class="form-control">

    <input type="text" name="description" value="{{ $category->description }}" class="form-control"><br>

    <select name="status" class="form-control">
        <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select><br>

    <button type="submit" class="btn btn-primary">Update</button>
</form>

        </div>
    </div>
</div>


@endsection