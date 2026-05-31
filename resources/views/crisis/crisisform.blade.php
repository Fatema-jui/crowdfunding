@extends('partials.master')
@section('content')
<h2> Create Crisis Form</h2>
<form action="{{ route('crisis.submit' )}}" method="post" enctype="multipart/form-data">

@csrf

    <div class="form-group">
        <label for="crisis_title" class="form-label">Crisis Title:</label>
        <input name="crisis_title" type="text" class="form-control" id="crisis_title" placeholder="Enter Crisis Title..">
    </div><br>

    <div class="form-group">
        <label for="select_category" class="form-label">Select Category:</label>
        <select name="category_id" class="form-control" id="select_category">
            <option value="">--Select Category--</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->category_name}}</option>
            @endforeach
        </select>
    </div><br>

    <div class="form-group">
        <label for="description" class="form-label">Description:</label>
        <textarea name="description" class="form-control" id="description" placeholder="Enter description.."></textarea>
    </div><br>

    <div class="form-group">
        <label for="amount" class="form-label">Target Amount:</label>
        <input name="target_amount" class="form-control" type="number" placeholder="Enter Target Amount..">
    </div><br>

    <div class="form-group">
        <label for="date" class="form-label">Deadline Date:</label>
        <input name="deadline" type="date" class="form-control" id="date" placeholder="Enter deadline Date..">
    </div><br>

    <div class="form-group">
        <label for="location" class="form-label">Location:</label>
        <textarea name="location" type="text" class="form-control" id="location" row="2" ></textarea>
    </div><br>

    <div class="form-group">
        <label for="image" class="form-label">Image:</label>
        <input name="image" type="file" class="form-control" id="image" placeholder="Enter Crisis image..">
    </div><br>

    <div class="form-group">
        <label for="contact_number" class="form-label">Contact Number:</label>
        <input name="number" type="number" class="form-control" id="contact_number" placeholder="Enter Contact Number..">
    </div><br>

    <div class="form-group">
        <label for="status" class="form-label">Status:</label>
        <select name="status" class="form-control" id="status" >
            <option value="">--Select Status--</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div><br>
    <div class="pb-1">
        <button type="submit" class="btn btn-primary ">Submit</button>
    </div>
    
</form>
@endsection