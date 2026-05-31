@extends('frontend.partials.master')
@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm p-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">My Application</h5>
                    <a href="{{ route('website') }}" class="btn btn-secondary btn-sm">← Back to Home</a>
                </div>

                @if($volunteer->status == 'approved')

                    <div class="alert alert-success">
                        Your application has been Approved! You are now an active volunteer.
                    </div>

                @elseif($volunteer->status == 'rejected')
                
                    <div class="alert alert-danger">
                         Your application has been Rejected! Please contact us for details.
                    </div>

                @else
                    <div class="alert alert-warning">
                         Your application is Pending! review. We will notify you soon.
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col" >Field</th>
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Applied As</td>
                                <td>{{ $volunteer->volunteer_name }}</td>
                            </tr>
                            
                            <tr>
                                <td>Email</td>
                                <td>{{ $volunteer->email }}</td>
                            </tr>
                            <tr>
                                <td>Applied On</td>
                                <td>{{ $volunteer->created_at->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <td>Message</td>
                                <td>{{ $volunteer->message ?? 'N/A' }}</td>
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