@extends('partials.master')
@section('content')

<div class="container-fluid py-4">

    <h2 class="mb-4">Admin Dashboard</h2>

    <div class="row row-cols-md-3 g-2">

        {{--  Category --}}
        <div class="col">
            <div class="card text-white bg-secondary h-100">
                <div class="card-body">
                    <h6>Total Categories</h6>
                    <h2>{{ $totalCategory ?? 0 }}</h2>
                    <a href="{{ route('crisis.category') }}" class="text-white " >View Details →</a>
                </div>
            </div>
        </div>

        {{--  Crisis --}}
        <div class="col">
            <div class="card text-white bg-warning h-100">
                <div class="card-body">
                    <h6>Total Crises</h6>
                    <h2>{{ $totalCrisis ?? 0 }}</h2>
                    <a href="{{ route('crisis') }}" class="text-white">View Details →</a>
                </div>
            </div>
        </div>

        {{--  Donor --}}
        <div class="col">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h6>Total Donor</h6>
                    <h2>{{ $totalDonor ?? 0 }}</h2>
                    <a href="{{ route('donor') }}" class="text-white">View Details →</a>
                </div>
            </div>
        </div>

        {{--  Donation --}}
        <div class="col">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h6>Total Donation</h6>
                    <h4>BDT {{ number_format($totalDonation) }}</h4>
                    <a href="{{ route('donation') }}" class="text-white">View Details →</a>
                </div>
            </div>
        </div>

        {{-- Volunteer --}}
        <div class="col">
            <div class="card text-white bg-orange h-100" style="background-color: #fd7e14;">
                <div class="card-body">
                    <h6>Total Volunteer</h6>
                    <h2>{{ $totalVolunteer ?? 0 }}</h2>
                    <a href="{{ route('volunteer') }}" class="text-white">View Details →</a>
                </div>
            </div>
        </div>

        {{--  Report --}}
        <div class="col">
            <div class="card text-white bg-info h-100">
                <div class="card-body">
                    <h6>View Report</h6>
                    <h2>📊</h2>
                    <a href="{{ route('report') }}" class="text-white">View Details →</a>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection