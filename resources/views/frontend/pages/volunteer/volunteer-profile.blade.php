@extends('frontend.partials.master')
@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm p-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Volunteer Profile</h5>
                    <a href="{{ route('website') }}" class="btn btn-secondary btn-sm">← Back to Home</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Field</th>
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{{ $volunteer->volunteer_name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $volunteer->email }}</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>{{ $volunteer->phone }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $volunteer->address ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td>Age</td>
                                <td>{{ $volunteer->age ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>{{ ucfirst($volunteer->gender ?? 'N/A') }}</td>
                            </tr>
                            <tr>
                                <td>NID</td>
                                <td>{{ $volunteer->NID ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td>Birth Date</td>
                                <td>{{ $volunteer->birth_date ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    @if($volunteer->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($volunteer->status == 'rejected')
                                        <span class="badge bg-danger">Rejected</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection