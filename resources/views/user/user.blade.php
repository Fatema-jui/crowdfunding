@extends('partials.master')
@section('content')

<h2>Users</h2>
<a href="{{ route('user.form')}}" class="btn btn-primary">Add users</a>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th Scope="col">#</th>
                <th Scope="col">Name</th>
                <th Scope="col">Email</th>
                <th Scope="col">Phone</th>
                <th Scope="col">Role</th>
                <th Scope="col">Address</th>
                <th Scope="col">Profile Image</th>
                <th Scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td Scope="row">{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->role}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->image}}</td>
                <td>{{$user->status}}</td>
                <td>
                    <div class="btn-group" role="group" style="gap:5px;">
                        <a href="" class="btn btn-primary btn-sm">View</a> 
                        <a href="" class="btn btn-warning btn-sm">Edit</a>
                        <a href="" class="btn btn-danger btn-sm">Delete</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection