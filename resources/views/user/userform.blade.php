@extends('partials.master')
@section('content')

<h2>Create user Form</h2>

<form action="{{ route('user.submit')}}" method="post">

@csrf    

    <div class="form-group">
        <label for="name" class="form-label">Name:</label>
        <input name="name"  type="text" class="form-control" id="name" placeholder="Enter Your Name..">
    </div><br>

    <div class="form-group">
        <label for="email" class="form-label">Email:</label>
        <input name="email" type="email" class="form-control" id="email" placeholder="Enter Your Email..">
    </div><br>

    <div class="form-group">
        <label for="phone" class="form-label">Phone:</label>
        <input name="phone" type="number" class="form-control" id="phone" placeholder="Enter Your Phone Number..">
    </div><br>

    <div class="form-group">
        <label for="password" class="form-label">Password:</label>
        <input name="password" type="password" class="form-control" id="password" placeholder="Enter Your Password here..">
    </div><br>

    <div class="form-group">
        <label for="confirm-password" class="form-label">Confirm Password:</label>
        <input name="confirm-password" type="password" class="form-control" placeholder="Confirm Your Password..">
    </div><br>

    <div class="form-group">
        <label for="role" class="form-label">Role:</label>
        <select name="role" class="form-control" id="role" >
            <option value="">--Select Role--</option>
            <option value="admin">Admin</option>
            <option value="donor">Donor</option>
        </select>
    </div><br>

    <button type="submit" class="btn btn-primary">Submit</button>

</form>
@endsection