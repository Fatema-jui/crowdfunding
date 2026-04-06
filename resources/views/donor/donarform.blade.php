@extends('partials.master')
@section('content')

<h2>Create Donar Form</h2>

<form action="{{ route('donar.submit') }}" method="post">
 
@csrf

<div class="form-group">
    <label for="name" class="form-label">Donar Name:</label>
    <input name="name" type="text" class="form-control" id="name" placeholder="Enter Donar Name..">
</div><br>

<div class="form-group">
    <label for="email" class="form-label">Email:</label>
    <input name="email" type="email" class="form-control" id="email" placeholder="Enter email here..">
</div><br>

<div class="form-group">
    <label for="phone" class="form-label">Phone:</label>
    <input name="phone" type="number" class="form-control" id="phone" placeholder="Enter Phone Number..">
</div><br>

<div class="form-group">
    <label for="address" class="form-label">Address:</label>
    <textarea name="address" class="form-control" id="address" placeholder="Enter Address here.."></textarea>
</div><br>

<button type="submit" class="btn btn-primary">Submit</button>

</form>

@endsection