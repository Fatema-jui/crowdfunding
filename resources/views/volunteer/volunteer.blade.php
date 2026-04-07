@extends('partials.master')
@section('content')
<h2>Volunteer</h2>
<a href="{{ route('volunteer.form') }}" class="btn btn-primary">Add New Volunteer</a>

<div class="table-responsive">
    <table class="table table-striped table-hover">
<thead>
        <tr>
            <th Scope="col">#</th>
            <th Scope="col">Volunteer Name</th>
            <th Scope="col">Email</th>
            <th Scope="col">Phone</th>
            <th Scope="col">Address</th>
            <th Scope="col">Skill</th>
            <th Scope="col">Availability</th>
            <th Scope="col">Experience</th>
            <th Scope="col">Status</th>
        </tr>
</thead>
<tbody>
    @foreach($volunteers as $volunteer)
    <tr>
        <td Scope="row">{{$volunteer->id}}</td>
        <td>{{$volunteer->volunteer_name}}</td>
        <td>{{$volunteer->email}}</td>
        <td>{{$volunteer->phone}}</td>
        <td>{{$volunteer->address}}</td>
        <td>{{$volunteer->skill}}</td>
        <td>{{$volunteer->availability}}</td>
        <td>{{$volunteer->experience}}</td>
        <td>{{$volunteer->status}}</td>
        <td>
            <div class="btn-group" role="group" style="gap:5px;">
                <a href="{{route('volunteer.view',$volunteer->id)}}" class="btn btn-primary btn-sm">View</a>
                <a href="" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ route('volunteer.delete',$volunteer->id)}}" class="btn btn-danger btn-sm">Delete</a>

            </div>
        </td>
    </tr>
@endforeach
</tbody>
</table>
</div>

@endsection