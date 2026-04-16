@extends('frontend.partials.master')
@section('content')


<div class="container py-5">

    {{-- Page header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">All Crisis Campaigns</h4>
            <small class="text-muted">{{ $crises->count() }} টি crisis পাওয়া গেছে</small>
        </div>
        <a href="{{ route('website') }}" class="btn btn-outline-secondary btn-sm">
            ← Back to Home
        </a>
    </div>

    {{-- Filter form --}}
    <form method="GET" action="{{ route('crisis.list') }}" class="row g-2 mb-4">
        <div class="col-md-5">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Crisis search করুন..."
                   value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <select name="category" class="form-select">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->category_name }}
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
                                     alt="{{ $crisis->title }}">
                            @else
                                <div class="bg-secondary rounded d-flex align-items-center
                                            justify-content-center"
                                     style="height: 80px;">
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
                                {{-- DYNAMIC: location field থাকলে --}}
                                {{-- <small class="text-muted">📍 {{ $crisis->location }}</small> --}}
                            </div>

                            <h6 class="fw-bold mb-1">{{ $crisis->title }}</h6>

                            <p class="text-muted small mb-2">
                                {{ Str::limit($crisis->description, 100) }}
                            </p>

                            {{-- Progress bar --}}
                            <div class="d-flex align-items-center gap-2">
                                <div class="progress flex-grow-1" style="height: 6px;">
                                    <div class="progress-bar bg-success"
                                         style="width: {{
                                             isset($crisis->goal) && $crisis->goal > 0
                                             ? min(100, ($crisis->raised / $crisis->goal) * 100)
                                             : 0
                                         }}%;">
                                    </div>
                                </div>
                                <small class="text-muted" style="white-space: nowrap;">
                                    {{-- DYNAMIC: raised/goal --}}
                                    ৳{{ number_format($crisis->raised ?? 0) }} raised
                                </small>
                            </div>
                        </div>

                        {{-- Button --}}
                        <div class="col-md-2 text-end">
                            <a href="{{ route('crisis.details', $crisis->id) }}"
                               class="btn btn-sm fw-semibold"
                               style="background-color: #0f766e; color: #fff;">
                                Details →
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">কোনো crisis পাওয়া যায়নি।</p>
            <a href="{{ route('crisis.list') }}" class="btn btn-outline-secondary btn-sm">
                Reset Filter
            </a>
        </div>
        @endforelse

    </div>
</div>


@endsection