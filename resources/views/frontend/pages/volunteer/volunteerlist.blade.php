@extends('frontend.partials.master')
@section('content')

<div class="container my-4">

    {{-- Header Card --}}
    <div class="card border-0 shadow-sm mb-4"
         style="background-color: #198754;">
        <div class="card-body py-4 px-4">
            <h2 class="text-white fw-bold mb-1">Approved Volunteers</h2>
            <p class="text-white mb-0">Admin approved volunteer list</p>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-3">
                <small class="text-muted text-uppercase fw-semibold">Total Approved</small>
                <h2 class="fw-bold mt-1">{{ $totalApproved }}</h2>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm p-3">
                <small class="text-muted text-uppercase fw-semibold">Active Areas</small>
                <h2 class="fw-bold mt-1">{{ $activeAreas }}</h2>
            </div>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white  py-3">
            <h5 class="fw-bold mb-0 ">Volunteer List</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="bg-white border-bottom">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Area</th>
                            <th>Approved On</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($volunteers as $volunteer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $volunteer->volunteer_name }}</td>
                            <td>{{ $volunteer->email }}</td>
                            <td>{{ $volunteer->address ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($volunteer->updated_at)->format('d M Y') }}</td>
                            <td>
                                <span class="badge bg-success px-3 py-2">
                                    Approved
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection