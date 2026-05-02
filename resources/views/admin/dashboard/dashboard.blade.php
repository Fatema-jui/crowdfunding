@extends('partials.master')
@section('content')

<div class="container-fluid py-4">

    <h2 class="mb-4">Admin Dashboard</h2>

    
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

    <div class="row">

        <div class="col-md-4 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h6>Total Crises</h6>
                    <h2>{{ $totalCrisis ?? 0 }}</h2>
                    <a href="{{ route('crisis') }}" class="text-white">View Details →</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card text-white bg-secondary">
                <div class="card-body">
                    <h6>Total Users</h6>
                    <h2>{{ $totalUser ?? 0 }}</h2>
                    <a href="{{ route('user') }}" class="text-white">View Details →</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card text-white bg-dark">
                <div class="card-body">
                    <h6>Total Categories</h6>
                    <h2>{{ $totalCategory ?? 0 }}</h2>
                    <a href="{{ route('crisis.category') }}" class="text-white">View Details →</a>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection