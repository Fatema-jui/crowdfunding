@extends('frontend.partials.master')
@section('content')

{{-- ── HERO ─────────────────────────────────────── --}}
<div class="mx-auto rounded shadow mb-4 position-relative overflow-hidden"
     style="max-width: 1620px; height: 728px; background: url('{{ asset('images/hero.jpg') }}') center/cover no-repeat;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100"
         style="background: rgba(0,0,0,0.45);"></div>
    
    <div class="position-absolute top-0 start-0 w-100 h-100 
                d-flex flex-column justify-content-center align-items-center text-white px-4">
        <h1 class="display-5 fw-bold text-center mb-3" style="max-width: 680px; color: #ffffff;">
            Help People in Need. <br>
            Support &amp; Make a Difference.
        </h1>
        <p class="lead text-center mb-4" style="max-width: 650px; opacity:.92;">
            Join thousands of donors helping communities recover from floods, fires,
            and other emergencies across Bangladesh.
        </p>
        <div class="d-flex justify-content-center flex-wrap" style="gap:1rem; z-index:1;">
            <a href="{{ route('crisis.list') }}" class="btn btn-light btn-lg px-4 fw-semibold">
                Donate Now
            </a>
            <a href="{{ route('webvolunteer.form') }}" class="btn btn-outline-light btn-lg px-4">
                Become a Volunteer
            </a>
        </div>
    </div>
</div>

{{-- ── STATS ───────────────────────────────────── --}}
<div class="container my-4">
    <div class="row g-3">

        <div class="col-md-4">
            <div class="card text-center shadow-sm h-100"
                 style="border-top: 3px solid #0d6efd;">
                <div class="card-body py-4">
                    <div class="fs-2 mb-2">💰</div>
                    <h3 class="fw-bold text-primary mb-1">
                        BDT {{ number_format($totalDonated, 2) }}
                    </h3>
                    <p class="text-muted mb-0">Total Donated</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm h-100"
                 style="border-top: 3px solid #198754;">
                <div class="card-body py-4">
                    <div class="fs-2 mb-2">🚨</div>
                    <h3 class="fw-bold text-success mb-1">{{ $activeCrises }}</h3>
                    <p class="text-muted mb-0">Active Crises</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm h-100"
                 style="border-top: 3px solid #dc3545;">
                <div class="card-body py-4">
                    <div class="fs-2 mb-2">🤝</div>
                    <h3 class="fw-bold text-danger mb-1">{{ $volunteers }}</h3>
                    <p class="text-muted mb-0">Volunteers</p>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- ── CATEGORY CARDS ──────────────────────────── --}}
<div class="container my-4">
    <h5 class="mb-3">Browse by Category</h5>
    <div class="row row-cols-2 row-cols-md-4 g-3">
        @foreach($categories as $category)
        <div class="col">
            
            <a href="{{ route('crisis.list', ['category' => $category->id]) }}"
               class="text-decoration-none">
                <div class="card text-center h-100">
                    @if($category->image)
                        <img src="{{ asset('category/' . $category->image) }}"
                             class="card-img-top"
                             alt="{{ $category->category_name }}"
                             style="height: 150px; object-fit: cover;">
                    @else
                        <div style="height:150px; background:#ccc; 
                                    display:flex; align-items:center; justify-content:center;">
                            <span class="text-muted">No Image</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h6 class="card-title mb-0">{{ $category->category_name }}</h6>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

{{-- ── CRISIS CARDS ─────────────────────────────── --}}
<div class="container mb-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Active Crisis Campaigns</h5>
        <a href="{{ route('crisis.list') }}" class="btn btn-outline-primary btn-sm">
            See All →
        </a>
    </div>

    <div class="row g-4">
        @foreach($crises as $crisis)

        {{-- no @php block  — data is coming from the controller --}}
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">

                {{-- Image --}}
                @if($crisis->image)
                    <img src="{{ asset('crises/' . $crisis->image) }}"
                         class="card-img-top rounded-top"
                         style="height: 180px; object-fit: cover;"
                         alt="{{ $crisis->crisis_title }}">
                @else
                    <div class="card-img-top bg-secondary d-flex align-items-center
                                justify-content-center"
                         style="height: 180px;">
                        <span class="text-white">No Image</span>
                    </div>
                @endif

                {{-- Progress bar --}}
                <div class="px-3 pt-2">
                    <div class="d-flex justify-content-between small text-muted mb-1">
                        <span>{{ number_format($crisis->percent, 0) }}% complete</span>
                        <span>BDT {{ number_format($crisis->raised, 2) }} raised</span>
                    </div>
                    <div class="progress mb-2" style="height: 6px;">
                        <div class="progress-bar bg-success"
                             style="width: {{ $crisis->percent }}%;"></div>
                    </div>
                </div>

                <div class="card-body">
                    <span class="badge bg-primary mb-2">
                        {{ $crisis->category->category_name ?? 'General' }}
                    </span>

                    <h6 class="card-title">{{ $crisis->crisis_title }}</h6>
                    <p class="text-truncate text-muted mb-3">{{ $crisis->description }}</p>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">
                            {{ $crisis->donations_count ?? 0 }} donors
                        </small>
                        <a href="{{ route('crisis.details', $crisis->id) }}"
                           class="btn btn-primary btn-sm">
                            View
                        </a>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- ── CTA BANNER ───────────────────────────────── --}}
<div class="bg-light py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center
                    bg-white rounded shadow-sm p-4 flex-wrap gap-3">
            <div>
                <h5 class="fw-bold mb-1">Helping the Homeless, Hungry & Hurting Children</h5>
                <p class="text-muted mb-0 small">Your small contribution can change a life.</p>
            </div>
            {{-- use real route --}}
            <a href="{{ route('crisis.list') }}" class="btn btn-primary">
                Donate Now
            </a>
        </div>
    </div>
</div>

@endsection