@extends('frontend.partials.master')
@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm p-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">My Donations</h5>
                    <a href="{{ route('website') }}" class="btn btn-secondary btn-sm">← Back to Home</a>
                </div>

                @if($donations->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Crisis Name</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Re Donation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donations as $donation)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $donation->crisis->crisis_title ?? 'N/A' }}</td>
                                    <td>BDT {{ number_format($donation->amount, 2) }}</td>
                                    <td>{{ $donation->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if($donation->status == 'completed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif($donation->status == 'pending')
                                            <span class="badge bg-warning ">Pending</span>
                                        @else
                                            <span class="badge bg-danger">Failed</span>
                                        @endif
                                    </td>
                                    <td>
                                    @if($donation->status == 'completed')
                                        <a href="{{ route('crisis.details', $donation->crisis_id) }}" 
                                           class="btn btn-sm btn-primary"
                                          style="font-size: 11px; padding: 2px 8px;">
                                        Donate Again
                                       </a>
                                    @else
                                       <span class="text-muted">N/A</span>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info">
                        You have not made any donations yet.
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection