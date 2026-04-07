@extends('partials.master')
@section('content')

<h2>Donor</h2>

<a href="{{ route('donor.form')}}" class="btn btn-primary">Add New Donor</a>

<div class="table-responsive">
    <table class="table table-striped table-hover">
<thead>
        <tr>
            <th Scope="col">#</th>
            <th Scope="col">Donor Name</th>
            <th Scope="col">Email</th>
            <th Scope="col">Phone</th>
            <th Scope="col">Address</th>
            <th Scope="col">Donor_type</th>
            <th Scope="col">Donation Date</th>
            <th Scope="col">Total_Donation</th>
            <th Scope="col">Status</th>
        </tr>
</thead>
<tbody>
    @foreach($donors as $donor)
    <tr>
        <td Scope="row">{{$donor->id}}</td>
        <td>{{$donor->name}}</td>
        <td>{{$donor->email}}</td>
        <td>{{$donor->phone}}</td>
        <td>{{$donor->address}}</td>
        <td>{{$donor->donor_type}}</td>
        <td>{{$donor->donation_date}}</td>
        <td>{{$donor->total_donation}}</td>
        <td>{{$donor->status}}</td>
        <td>
            <div class="btn-group" role="group" style="gap:5px;">
                <a href="{{route('donor.view' , $donor->id)}}" class="btn btn-primary btn-sm">View</a>
                <a href="" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ route('donor.delete' , $donor->id) }}" class="btn btn-danger btn-sm">Delete</a>

            </div>
        </td>
    </tr>
@endforeach
</tbody>
</table>
</div>

@endsection