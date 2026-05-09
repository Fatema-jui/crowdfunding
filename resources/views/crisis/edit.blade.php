@extends('partials.master')
@section('content')

<div class="container mt-4">
    <h3 class="mb-3 text-primary">Edit Crisis </h3>

    <div class="card shadow-sm border-0" style="max-width:600px;">
        <div class="card-body p-0">

       <form action="{{ route('crisis.update', $crisis->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="text" name="crisis_title" value="{{ $crisis->crisis_title}}" class="form-control"><br>
            <input type="number" name="category_id" value="{{ $crisis->category_id }}" class="form-control"><br>
            <input type="text" name="description" value="{{ $crisis->description }}" class="form-control"><br>
            <input type="number" name="target_amount" value="{{ $crisis->target_amount }}" class="form-control"><br>
            <input type="date" name="deadline_date" value="{{ $crisis->deadline_date}}" class="form-control"><br>
            <input type="text" name="location" value="{{ $crisis->location}}" class="form-control"><br>
            <input type="file" name="image" value="{{ $crisis->image }}" class="form-control"><br>
            <input type="number" name="number" value="{{ $crisis->number}}" class="form-control"><br>
            <select name="status" class="form-control">
                <option value="active" {{ $crisis->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $crisis->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select><br>

            <br>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        </div>
    </div>
</div>
@endsection