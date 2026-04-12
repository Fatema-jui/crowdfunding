@extends('frontend.partials.master')
@section('content')

{{-- ── HERO ─────────────────────────────────────── --}}
<div class="bg-primary text-white text-center py-5">
    <div class="container py-4">

        {{-- Small tag line --}}
        <span class="badge bg-white text-primary mb-3 px-3 py-2" 
              style="font-size: 12px; border-radius: 20px;">
            Crisis Relief Platform
        </span>

        {{-- Main heading — বড় করা হয়েছে --}}
        <h1 class="display-4 fw-bold mb-3">
            Help People in Need. <br>
            Support &amp; Make a Difference.
        </h1>

        {{-- Subtitle --}}
        <p class="lead mb-4 mx-auto" style="max-width: 550px; opacity: .88;">
            Join thousands of donors helping communities recover from 
            floods, fires, and other emergencies across Bangladesh.
        </p>

        {{-- Image placeholder — পরে real image দিবে --}}
        {{-- DYNAMIC: এখানে একটা hero image রাখতে পারো 
             <img src="{{ asset('images/hero_1.jpg') }}" class="img-fluid rounded mb-4" 
                  style="max-height: 280px; object-fit: cover;"> --}}

        {{-- Buttons --}}
        <div class="d-flex  justify-content-center flex-wrap" style="gap: 1rem;">
            {{-- DYNAMIC: href — route('crises.index') --}}
            <a href="#" class="btn btn-light btn-lg px-4 fw-semibold me-3">
                Donate Now
            </a>
            {{-- DYNAMIC: href — route('volunteer.register') --}}
            <a href="#" class="btn btn-outline-light btn-lg px-4">
                Become a Volunteer
            </a>
        </div>

    </div>
</div>

{{-- ── STATS — 3 আলাদা card ──────────────────────── --}}
<div class="container my-4">
    <div class="row g-3">

        <div class="col-md-4">
            <div class="card text-center shadow-sm h-100" 
                 style="border-top: 3px solid #0d6efd;">
                <div class="card-body py-4">
                    <div class="fs-2 mb-2">💰</div>
                    {{-- DYNAMIC: DB থেকে — Donation::sum('amount') --}}
                    <h3 class="fw-bold text-primary mb-1">৳2,41,000</h3>
                    <p class="text-muted mb-0">Total Donated</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm h-100"
                 style="border-top: 3px solid #198754;">
                <div class="card-body py-4">
                    <div class="fs-2 mb-2">🚨</div>
                    {{-- DYNAMIC: Crisis::where('status','active')->count() --}}
                    <h3 class="fw-bold text-success mb-1">6</h3>
                    <p class="text-muted mb-0">Active Crises</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm h-100"
                 style="border-top: 3px solid #dc3545;">
                <div class="card-body py-4">
                    <div class="fs-2 mb-2">🤝</div>
                    {{-- DYNAMIC: Volunteer::count() --}}
                    <h3 class="fw-bold text-danger mb-1">8</h3>
                    <p class="text-muted mb-0">Volunteers</p>
                </div>
            </div>
        </div>

    </div>
</div>


{{-- ── CATEGORY BUTTONS ─────────────────────────── --}}
<div class="container my-4">
    <h5 class="mb-3">Browse by Category</h5>
    <div class="d-flex flex-wrap gap-2">
        {{-- DYNAMIC: href — route('crises.index') --}}
        <a href="#" class="btn btn-primary btn-sm">All</a>

        {{-- DYNAMIC: $categories controller থেকে আসছে --}}
        @foreach($categories as $cat)
            {{-- DYNAMIC: href — route('crises.index', ['category' => $cat->id]) --}}
            <a href="#" class="btn btn-outline-secondary btn-sm">
                {{ $cat->category_name }}
            </a>
        @endforeach
    </div>
</div>


{{-- ── CRISIS CARDS ─────────────────────────────── --}}
<div class="container mb-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Active Crisis Campaigns</h5>
        {{-- DYNAMIC: href — route('crises.index') --}}
        <a href="#" class="btn btn-outline-primary btn-sm">See All →</a>
    </div>

    <div class="row g-4">

        {{-- DYNAMIC: এখানে $categories র বদলে $crises loop দিবে
             Controller এ: $crises = Crisis::latest()->take(6)->get();
             তখন $cat এর বদলে $crisis ব্যবহার করবে --}}

        @foreach($categories as $cat)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">

                {{-- Image --}}
                {{-- DYNAMIC: src — asset('storage/' . $crisis->image) --}}
                <img src="{{ asset('images/img_2.jpg') }}"
                     class="card-img-top" style="height: 180px; object-fit: cover;" alt="">

                {{-- Progress bar on image bottom --}}
                <div class="px-3 pt-2">
                    <div class="d-flex justify-content-between small text-muted mb-1">
                        {{-- DYNAMIC: ($crisis->raised / $crisis->goal * 100) . '%' --}}
                        <span>80% complete</span>
                        {{-- DYNAMIC: '৳' . number_format($crisis->raised) --}}
                        <span>৳32,919 raised</span>
                    </div>
                    <div class="progress mb-2" style="height: 6px;">
                        {{-- DYNAMIC: width — ($crisis->raised / $crisis->goal * 100) . '%' --}}
                        <div class="progress-bar" style="width: 80%;"></div>
                    </div>
                </div>

                <div class="card-body">
                    {{-- DYNAMIC: $crisis->category->category_name --}}
                    <span class="badge bg-primary mb-2">{{ $cat->category_name }}</span>

                    {{-- DYNAMIC: $crisis->title --}}
                    <h6 class="card-title">{{ $cat->description }}</h6>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        {{-- DYNAMIC: $crisis->donations()->count() . ' donors' --}}
                        <small class="text-muted">43 donors</small>

                        {{-- DYNAMIC: href — route('crises.show', $crisis->id) --}}
                        <a href="#" class="btn btn-primary btn-sm">Donate</a>
                    </div>
                </div>

            </div>
        </div>
        @endforeach

    </div>
</div>


{{-- ── DONATE FORM SECTION ──────────────────────── --}}
<div class="bg-primary py-5">
    <div class="container">
        <div class="row align-items-center g-4">

            <div class="col-md-6">
                <img src="{{ asset('images/img_1.jpg') }}"
                     class="img-fluid rounded shadow" alt="">
            </div>

            <div class="col-md-6">
                <div class="bg-white rounded p-4 shadow">
                    <h4 class="fw-bold mb-4">Donate Now</h4>

                    {{-- DYNAMIC: action — route('donate.store'), @csrf, hidden crisis_id --}}
                    <form action="#">

                        <div class="mb-3">
                            <label class="form-label">Your Name</label>
                            {{-- DYNAMIC: value="{{ auth()->user()->name ?? '' }}" --}}
                            <input type="text" name="name" class="form-control" placeholder="Full name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            {{-- DYNAMIC: value="{{ auth()->user()->email ?? '' }}" --}}
                            <input type="email" name="email" class="form-control" placeholder="email@example.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Amount (৳)</label>
                            <input type="number" name="amount" id="donateAmount"
                                   class="form-control" placeholder="Enter amount">
                        </div>

                        {{-- Quick amount buttons --}}
                        <div class="d-flex gap-2 mb-3">
                            <button type="button" class="btn btn-outline-primary btn-sm"
                                    onclick="document.getElementById('donateAmount').value=100">৳100</button>
                            <button type="button" class="btn btn-outline-primary btn-sm"
                                    onclick="document.getElementById('donateAmount').value=500">৳500</button>
                            <button type="button" class="btn btn-outline-primary btn-sm"
                                    onclick="document.getElementById('donateAmount').value=1000">৳1,000</button>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Donate Now</button>

                    </form>
                </div>
            </div>

        </div>
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
            {{-- DYNAMIC: href — route('crises.index') --}}
            <a href="#" class="btn btn-primary">Donate Now</a>
        </div>
    </div>
</div>




@endsection