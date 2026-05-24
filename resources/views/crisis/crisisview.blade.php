@extends('partials.master')
@section('content')

<div class="container mt-4">
    <h3 class="mb-3 text-primary">Crisis View</h3>

    {{-- Crisis Details Card --}}
    <div class="card shadow-sm border-0" style="max-width:600px;">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <tbody>
                    <tr>
                        <th style="width:30%">Crisis Title</th>
                        <td>{{ $crisis->crisis_title }}</td>
                    </tr>
                    <tr>
                        <th>Select Crisis</th>
                        <td>{{ $crisis->category_id }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $crisis->description }}</td>
                    </tr>
                    <tr>
                        <th>Target Amount</th>
                        <td>{{ $crisis->target_amount }}</td>
                    </tr>
                    <tr>
                        <th>Raised Amount</th>
                        <td>{{ $crisis->raised_amount }}</td>
                    </tr>
                    <tr>
                        <th>Deadline Date</th>
                        <td>{{ $crisis->deadline_date }}</td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td>{{ $crisis->location }}</td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td>{{ $crisis->image }}</td>
                    </tr>
                    <tr>
                        <th>Contact Number</th>
                        <td>{{ $crisis->number }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($crisis->status == 1 || $crisis->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Assigned Volunteers Card --}}
    <div class="card shadow-sm border-0 mt-4" style="max-width:600px; padding-bottom: 60px;">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Assigned Volunteers</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Volunteer Name</th>
                        <th>Task Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($crisis->volunteers as $index => $volunteer)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $volunteer->volunteer_name }}</td>
                            <td>
                                @if($volunteer->pivot->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-success text-light">Assigned</span>
                                @endif
                            </td>
                            <td>
                                @if($volunteer->pivot->status == 'completed')
                                    <span class="text-muted">-</span>
                                @else
                                    <a href="{{ route('crisis.volunteer.delete', ['crisis_id' => $crisis->id, 'volunteer_id' => $volunteer->id]) }}" 
                                       class="btn btn-danger btn-sm">Delete</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection