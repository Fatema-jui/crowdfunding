@extends('partials.master')
@section('content')
<h2>Donation</h2>
<a href="{{ route('donation.form')}}" class="btn btn-primary">Add New Donation</a>

<div class="table-responsive">
  <table class="table table-striped table-hover">
    <thead>
        <th Scope="col">#</th>
        <th Scope="col">Crisis Title</th>
        <th Scope="col">Donar name</th>
        <th Scope="col">Donation Amount</th>
        <th Scope="col">payment Method</th>
        <th Scope="col">Donation Date</th>
        <th Scope="col">Transaction ID</th>
        <th Scope="col">Status</th>
        <th Scope="col">Action</th>
    </thead>
    <tbody>
        @foreach($donations as $donation)
        <tr>            
            <td Scope="row">{{$donation->id}}</td>
            <td>{{$donation->crisis->crisis_title}}</td>
            <td>{{$donation->donor?->name}}</td>
            <td>{{$donation->amount}}</td>
            <td>{{$donation->payment_method}}</td>
            <td>{{$donation->donation_date}}</td>
            <td>{{$donation->transaction_id}}</td>
            <td>{{$donation->status}}</td>
            <td>
                 <div class="btn-group" role="group" style="gap:5px;">
                <a href="{{ route('donation.view', $donation->id) }}" class="btn btn-primary btn-sm">View</a>
                <a href="" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ route('donation.delete', $donation->id) }}" class="btn btn-danger btn-sm">Delete</a>               
            </div>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>  
</div>
@endsection