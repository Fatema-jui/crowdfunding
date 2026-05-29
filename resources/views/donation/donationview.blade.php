@extends('partials.master')
@section('content')

<div class="container mt-4">
    <h3 class="mb-3 text-primary">Donation View</h3>

    <div class="card shadow-sm border-0" style="max-width:700px;">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <tbody>
                    <tr>
                        <th style="width:35%">Select Crisis</th>
                        <td>{{ $donation->crisis->crisis_title }}</td>
                    </tr>
                    <tr>
                        <th>Donor Name</th>
                        <td>{{ $donation->donor?->name }}</td>
                    </tr>
                    <tr>
                        <th>Donation Amount</th>
                        <td>{{ $donation->amount }}</td>
                    </tr>
                    <tr>
                        <th>Payment Method</th>
                        <td>{{ $donation->payment_method }}</td>
                    </tr>
                    <tr>
                        <th>Donation Date</th>
                        <td>{{ $donation->donation_date }}</td>
                    </tr>
                    <tr>
                        <th>Transaction ID</th>
                        <td>{{ $donation->transaction_id }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($donation->status == 'completed')
                                <span class="badge bg-success">Completed</span>
                            @elseif($donation->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($donation->status  == 'failed')
                                <span class="badge bg-danger">Failed</span>
                            @else
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection