@extends('partials.master')
@section('content')

<h2> Create Volunteer Form</h2>

<form action="{{ route('volunteer.submit')}}" method="post">

@csrf

<div class="form-group" >
    <label for="name" class="form-label">Name:</label>
    <input name="volunteer_name" type="text" class="form-control" placeholder="Enter Name..">
</div><br>

<div class="form-group">
    <label for="email" class="form-label">Email:</label>
    <input  name="email" type="email" class="form-control" placeholder="Enter Email..">
</div><br>

<div class="form-group">
    <label for="phone" class="form-label">Phone:</label>
    <input name="phone" type="number" class="form-control" placeholder="Enter Phone..">
</div><br>

<div class="form-group">
    <label for="address" class="form-label">Address:</label>
    <textarea name="address" type="text" class="form-control" row="3" placeholder="Enter Address.."></textarea>
</div><br>

<div class="form-group">
    <label for="skill" class="form-label">Skill:</label>
    <select name="skill" class="form-control">
    <option value="">--select skill--</option>
    <option value="first aid">First Aid</option>
    <option value="recuse">Recuse</option>
    </select>
</div><br>

<div class="form-group">
    <label for="availability" class="form-label">Availability:</label>
    <select name="availability" class="form-control">
    <option value="">--select availability--</option>
    <option value="part-time">Part-Time</option>
    <option value="full-time">Full-Time</option>
    </select>
</div><br>

<div class="form-group">
    <label for="experience" class="form-label">Experience:</label>
    <input name="experience" type="number" class="form-control" placeholder="Enter Experience..">
</div><br>

<div class="form-group">
    <label for="status" class="form-label">Status:</label>
    <select name="status" class="form-control">
        <option value="">--select status--</option>
        <option value="pending">Pending</option>
        <option value="approve">Approve</option>
    </select><br>

    <button type="submit" class="btn btn-primary">Submit</button>

</div>
</form>

@endsection