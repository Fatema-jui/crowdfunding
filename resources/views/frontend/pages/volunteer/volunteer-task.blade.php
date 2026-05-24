@extends('frontend.partials.master')
@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm p-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Assigned Tasks</h5>
                    <a href="{{ route('website') }}" class="btn btn-secondary btn-sm">← Back to Home</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($volunteer->crises && $volunteer->crises->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Crisis Name</th>
                                    <th>Description</th>
                                    <th>Location</th>
                                    <th>Task Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($volunteer->crises as $crisis)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $crisis->crisis_title }}</td>
                                    <td>{{ $crisis->description ?? 'N/A' }}</td>
                                    <td>{{ $crisis->location ?? 'N/A' }}</td>
                                    <td>
                                        @if($crisis->pivot->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @else
                                            <div class="d-flex gap-2 align-items-center">
                                                <span class="badge bg-success text-light">Assigned</span>
                                                <form action="{{ route('webvolunteer.task.complete', $crisis->id) }}" method="POST">
                                                @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                         Complete
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">
                        No tasks assigned yet. Please wait for admin to assign tasks.
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection