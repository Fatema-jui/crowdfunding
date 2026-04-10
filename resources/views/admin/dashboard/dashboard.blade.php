@extends('partials.master')
@section('content')

<div class="container-fluid py-4">

    <h2 class="mb-4">Admin Dashboard</h2>

    {{-- স্ট্যাট কার্ড --}}
    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h6>Total Donor</h6>
                    <h2>{{ $totalDonor }}</h2>
                    <a href="{{ route('donor') }}" class="text-white">View Details →</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h6>Total Volunteer</h6>
                    <h2>{{ $totalVolunteer }}</h2>
                    <a href="{{ route('volunteer') }}" class="text-white">View Details →</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h6>Total Donation</h6>
                    <h2>৳ {{ number_format($totalDonation) }}</h2>
                    <a href="{{ route('donation') }}" class="text-white">View Details →</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h6>View Report</h6>
                    <h2>📊</h2>
                    <a href="{{ route('report') }}" class="text-white">View Details →</a>
                </div>
            </div>
        </div>

    </div>

    
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Recent Donations</h5>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Donor Name</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentDonations as $index => $donation)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $donation->donor_name }}</td>
                                <td>৳ {{ number_format($donation->amount) }}</td>
                                <td>{{ $donation->created_at->format('d M Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection