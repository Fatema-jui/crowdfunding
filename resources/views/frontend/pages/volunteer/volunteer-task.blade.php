@extends('frontend.partials.master')
@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm p-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Assigned Tasks</h5>
                    <a href="{{ route('website') }}" class="btn btn-secondary btn-sm">← Back to Home</a>
                </div>

                @if($volunteer->crises && $volunteer->crises->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Crisis Name</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($volunteer->crises as $crisis)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $crisis->crisis_title }}</td>
                                    <td>{{ $crisis->location ?? 'N/A' }}</td>
                                    <td>
                                        @if($crisis->status == 'active')
                                            <span class="badge bg-success">Assigned</span>
                                        @else($crisis->status == 'inactive')
                                            <span class="badge bg-danger">Rejected</span>   
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