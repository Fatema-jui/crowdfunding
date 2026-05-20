@extends('partials.master')
@section('content')
<h2>Volunteer</h2>
<a href="{{ route('volunteer.form') }}" class="btn btn-primary">Add New Volunteer</a>

@if(session('success'))
    <div class="alert alert-success mt-2">{{ session('success') }}</div>
@endif

<div class="table-responsive mt-3">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Volunteer Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Age</th>
                <th>NID</th>
                <th>Birth Date</th>
                <th>Gender</th>
                <th>Message</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($volunteers as $volunteer)
            <tr>
                <td>{{ $volunteer->id }}</td>
                <td>{{ $volunteer->volunteer_name }}</td>
                <td>{{ $volunteer->email }}</td>
                <td>{{ $volunteer->phone }}</td>
                <td>{{ $volunteer->address }}</td>
                <td>{{ $volunteer->age }}</td>
                <td>{{ $volunteer->NID }}</td>
                <td>{{ $volunteer->birth_date }}</td>
                <td>{{ $volunteer->gender }}</td>
                <td>{{ $volunteer->message }}</td>

                <td>
                    @if($volunteer->status == 'approved')
                        <span class="badge bg-success">Approved</span>
                    @elseif($volunteer->status == 'rejected')
                        <span class="badge bg-danger">Rejected</span>
                    @else
                        Pending
                    @endif
                </td>

                <td style="white-space: nowrap;">
                    @if($volunteer->status != 'approved')
                    <form action="{{ route('volunteer.approve', $volunteer->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Approve</button>
                    </form>
                    @endif

                    @if($volunteer->status != 'rejected')
                    <form action="{{ route('volunteer.reject', $volunteer->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm">Reject</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection