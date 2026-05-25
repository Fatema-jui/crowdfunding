@extends('frontend.partials.master')
@section('content')

<div class="container py-5">

    {{-- Page header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">All Crisis Campaigns</h4>
            <small class="text-muted">{{ $crises->count() }} crises found</small>
        </div>
        <a href="{{ route('website') }}" class="btn btn-outline-secondary btn-sm">
            ← Back to Home
        </a>
    </div>

    {{-- Filter form --}}
    <form method="GET" action="{{ route('crisis.list') }}" class="row g-2 mb-4">
        <div class="col-md-5">
            <input type="text" name="search" class="form-control" placeholder="Search crises..."value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="category" class="form-select">
                <option value="">All Categories</option>
                @foreach($categories as $catagory)
                    <option value="{{ $catagory->id }}"
                        {{ request('category') == $catagory->id ? 'selected' : '' }}>
                        {{ $catagory->category_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn w-100"
                    style="background-color: #0f766e; color: #fff;">
                Filter
            </button>
        </div>
        <div class="col-md-1">
            <a href="{{ route('crisis.list') }}" class="btn btn-outline-secondary w-100">
                ✕
            </a>
        </div>
    </form>

    {{-- Crisis list --}}
    <div class="row g-4">
        @forelse($crises as $crisis)
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row align-items-center g-3">

                        {{-- Image --}}
                        <div class="col-md-2 col-3">
                            @if($crisis->image)
                                <img src="{{ asset('crises/' . $crisis->image) }}"
                                     class="img-fluid rounded"
                                     style="height: 80px; width: 100%; object-fit: cover;"
                                     alt="{{ $crisis->crisis_title }}">
                            @else
                                <div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="height: 80px;">
                                    <small class="text-white">No Image</small>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="col-md-8 col-9">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="badge bg-primary">
                                    {{ $crisis->category->category_name ?? 'General' }}
                                </span>
                            </div>

                            {{-- Crisis Title --}}
                            <h6 class="fw-semibold mb-1">{{ $crisis->crisis_title }}</h6>

                            {{-- Description --}}
                            <p class="text-muted small mb-2">
                                {{ Str::limit($crisis->description, 100) }}
                            </p>

                            {{-- Progress bar — the data is coming from the controller --}}
                            <div class="d-flex align-items-center gap-2">
                                <div class="progress flex-grow-1" style="height: 6px;">
                                    <div class="progress-bar bg-success"
                                         style="width: {{ $crisis->percent }}%;">
                                    </div>
                                </div>
                                <small class="text-muted"
                                       style="white-space: nowrap; font-size: 11px;">
                                    {{ number_format($crisis->percent, 0) }}% complete •
                                    BDT{{ number_format($crisis->raised, 2) }} raised of
                                    BDT{{ number_format($crisis->goal, 2) }}
                                </small>
                            </div>

                            {{-- Donors count --}}
                            <small class="text-muted mt-1 d-block">
                                {{ $crisis->donations_count ?? 0 }} donors
                            </small>
                        </div>

                        {{-- Button --}}
                        <div class="col-md-2 text-end d-flex flex-column gap-2">
                           <a href="{{ route('crisis.details', $crisis->id) }}"class="btn btn-sm fw-semibold" style="background-color: #0f766e; color: #fff;">
                              Details →
                            </a>

                            <a href="{{ route('crisis.expense', $crisis->id) }}"class="btn btn-sm fw-semibold" style="background-color: #0f766e; color: #fff;">
                              Expense →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">No crises found.</p>
            <a href="{{ route('crisis.list') }}" class="btn btn-outline-secondary btn-sm">
                Reset Filter
            </a>
        </div>
        @endforelse

    </div>
</div>

@endsection