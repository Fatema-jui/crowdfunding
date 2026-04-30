@extends('frontend.partials.master')
@section('content')

{{-- Header --}}
<div style="background-color: #198754; padding: 40px 0;">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <h2 class="text-white fw-bold mb-1">Approved Volunteers</h2>
            <p class="text-white-50 mb-0">Admin approved volunteer list</p>
        </div>
        <span class="badge fs-6 px-3 py-2"
              style="background-color: rgba(255,255,255,0.15); color:white;">
            Total: {{ $totalApproved }} Volunteers
        </span>
    </div>
</div>

<div class="container my-4">

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

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Area</th>
                    <th scope="col">Approved On</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($volunteers as $volunteer)
                <tr>
                    <td>{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
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

@endsection