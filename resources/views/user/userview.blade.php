@extends('partials.master')
@section('content')
<div class="container">
    <h2 class="mb-3 text-primary">User View</h2>

    <div class="card shadow-sm border-0" style="max-width:600px;">
        <div class="card-body p-0">

            <table class="table table-striped mb-0">
                <tbody>
                    <tr>
                        <th style="width:30%">Name</th>
                        <td>{{ $user->name }}</td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>

                    <tr>
                       <th>Phone</th>
                       <td>{{$user->phone}}</td>
                    </tr>

                    <tr>
                       <th>Role</th>
                       <td>{{ ($user->role) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection