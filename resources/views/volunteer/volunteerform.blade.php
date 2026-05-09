@extends('partials.master')
@section('content')

<h2> Create Volunteer Form</h2>

<form action="{{ route('volunteer.submit')}}" method="post">

@csrf

<div class="form-group" >
    <label for="volunteer_name" class="form-label">Name:</label>
    <input name="volunteer_name" type="text" class="form-control" placeholder="Enter Name..">
</div><br>

<div class="form-group">
    <label for="email" class="form-label">Email:</label>
    <input  name="email" type="email" class="form-control" placeholder="Enter Email..">
</div><br>

<div class="form-group">
    <label for="phone" class="form-label">Phone:</label>
    <input name="phone" type="text" class="form-control" placeholder="Enter Phone..">
</div><br>

<div class="form-group">
    <label for="address" class="form-label">Address:</label>
    <textarea name="address" type="text" class="form-control" rows="3" placeholder="Enter Address.."></textarea>
</div><br>

<div class="form-group">
    <label for="age" class="form-label">Age:</label>
    <input name="age" type="number" class="form-control" placeholder="Enter Age..">
    
</div><br>

<div class="form-group">
    <label for="gender" class="form-label">Gender:</label>
    <select name="gender" class="form-control">
        <option value="">--select gender--</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
    </select>
</div><br>

<div class="form-group">
    <label for="message" class="form-label">Message:</label>
    <textarea name="message" type="text" class="form-control" rows="3" placeholder="Enter Message.."></textarea>
</div><br>

<div class="form-group">
    <label for="status" class="form-label">Status:</label>
    <input name="status" type="text" class="form-control" placeholder="Enter Status..">
</div><br>

    <button type="submit" class="btn btn-primary">Submit</button>


</form>

@endsection