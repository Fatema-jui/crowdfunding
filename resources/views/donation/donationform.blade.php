@extends('partials.master')
@section('content')

<h2>Create Donation Form</h2>

<form action="{{ route('donation.submit') }}" method="post">

@csrf

<div class="form-group">
    <label for="select_crisis" class="form-label">Select crisis:</label>
    <select name="crisis_id" class="form-control" id="select_crisis">
        <option value="">--Select Crisis--</option>
        @foreach($crises as $crisis)
        <option value="{{$crisis->id}}">{{$crisis->crisis_title}}</option>
        @endforeach
    </select>
</div><br>

<div class="form-group">
    <label for="user_name" class="form-label">Donar Name:</label>
    <select name="user_id" class="form-control" id="user_name">
        <option value="">--Donor Name--</option>
        @foreach($users as $user)
        <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>   
</div><br>

<div class="form-group">
    <label for="amount"  class="form-label">Donation Amount:</label>
    <input name="amount" type="number" class="form-control" id="amount" placeholder="Enter Amount..">
</div><br>

<div class="form-group">
    <label for="payment_method" class="form-label">Payment Method:</label>
    <select name="payment_method" class="form-control" id="payment_method">
        <option value="">--Select Payment Method--</option>
        <option value="bkash">Bkash</option>
        <option value="nagad">Nagad</option>
        <option value="rocket">Rocket</option>
        <option value="card">Card</option>
    </select>
</div><br>

<div class="form-group">
    <label for="donation_date" class="form-label">Donation Date:</label>
    <input name="donation_date" type="date" class="form-control" placeholder="Enter Donation Date..">
</div><br>

<div class="form-group">
    <label for="" class="">Transaction ID:</label>
    <input name="transaction_id" type="text" class="form-control" placeholder="Enter Transaction Id..">
</div><br>

<div class="form-group">
    <label for="status" class="form-label">Status:</label>
    <select name="status" class="form-control" id="status">
        <option value="">--Select Status--</option>
        <option value="pending">Pending</option>
        <option value="completed">Completed</option>
        <option value="failed">Failed</option>
    </select>
</div><br>

<button type="submit" class="btn btn-primary">Submit</button>

</form>

@endsection