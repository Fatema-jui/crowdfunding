@extends('partials.master')
@section('content')

<h2>Create Category Form</h2>

<form action="{{ route('crisis.category.submit') }}"  method="post">
@csrf
    <div class="form-group">
        <label for="category_name" class="form-label">Category Name:</label>
        <input name="category_name" type="text" class="form-control" id="category_name" placeholder="Enter Category Name..">
    </div><br>

    <div class="form-group">
        <label for="description" class="form-label">Description:</label>
        <input name="description" type="text" class="form-control" id="description" placeholder="Enter Description here..">
    </div><br>

    <div class="form-group">
        <label for="image" class="form-label">Image:</label>
        <input  name="image" type="file" class="form-control" placeholder="Enter Image..">
    </div><br>

    <div class="form-group">
        <label for="status" class="form-label">Status:</label>
        <select name="status" class="form-control" id="status">
            <option value="">--Select Status--</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div><br>


    <button type="submit" class="btn btn-primary">Submit</button>

</form>

@endsection