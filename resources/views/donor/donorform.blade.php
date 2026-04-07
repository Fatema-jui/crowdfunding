@extends('partials.master')
@section('content')

<h2>Create Donor Form</h2>

<form action="{{ route('donor.submit') }}" method="post">
 
@csrf

<div class="form-group">
    <label for="name" class="form-label">Donor Name:</label>
    <input name="name" type="text" class="form-control" id="name" placeholder="Enter Donor Name..">
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

<div class="form-group">
    <label for="donor_type" class="form-label">Donor Type:</label>
    <select name="donor_type" class="form-control" id="donor_type">
        <option value="">--select donor type--</option>
        <option value="regular">Regular</option>
        <option value="one time">One Time</option>
    </select>
</div><br>

<div class="form-group">
    <label for="last_date" class="form-label">Last Donation Date:</label>
    <input name="donation_date" type="date" class="form-control" placeholder="Enter Last Donation Date..">
</div><br>

<div class="form-group">
    <label for="total donation"  class="form-label">Total Donation:</label>
    <input name="total_donation" type="number" class="form-control" placeholder="Enter Total Amount..">
</div><br>

<div class="form-group">
    <label for="status" class="form-label">Status:</label>
    <select name="status" class="form-control" id="status">
        <option value="status">--status--</option>
        <option value="pending">Pending</option>
        <option value="approve">Approve</option>
    </select>
</div><br>

<button type="submit" class="btn btn-primary">Submit</button>

</form>

@endsection