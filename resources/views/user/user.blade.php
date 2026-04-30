@extends('partials.master')
@section('content')

<h2>Users</h2>
<a href="{{ route('user.form')}}" class="btn btn-primary">Add users</a>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>  {{-- একটাই Action কলাম --}}
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                    @if($user->role == 'donor')
                        <span class="badge bg-success">Donor</span>
                    @elseif($user->role == 'admin')
                        <span class="badge bg-danger">Admin</span>
                    @else
                        <span class="badge bg-secondary">User</span>
                    @endif
                </td>
                <td>  {{-- ✅ Button গুলো এই একটা td তে --}}
                    <a href="{{ route('user.view', $user->id) }}" class="btn btn-primary btn-sm">View</a>
                    <a href="" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger btn-sm" >Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection