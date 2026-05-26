@extends('frontend.partials.master')
@section('content')

<div class="container py-5">
    <div class="row g-4">

        {{--  Crisis Info --}}
        <div class="col-lg-7">

            {{-- Image --}}
            @if($crisis->image)
                <img src="{{ asset('crises/' . $crisis->image) }}"
                     class="img-fluid rounded w-100 mb-4"
                     style="height: 300px; object-fit: cover;"
                     alt="{{ $crisis->crisis_title }}">
            @else
                <div class="bg-secondary rounded d-flex align-items-center justify-content-center mb-4"
                     style="height: 300px;">
                    <span class="text-white">No Image</span>
                </div>
            @endif

            <span class="badge bg-primary mb-2">
                {{ $crisis->category->category_name ?? 'General' }}
            </span>

            <h3 class="fw-bold  mt-2">{{ $crisis->crisis_title ?? 'Untitled Crisis' }}</h3>
            <p class="text-muted mt-3">{{ $crisis->description ?? 'No description available.' }}</p>

            <div class="card p-3 mt-4">
                <div class="d-flex justify-content-between mb-1">
                    <strong>BDT{{ number_format($crisis->raised, 2) }} raised</strong>
                    <span class="text-muted">Goal: BDT{{ number_format($crisis->goal, 2) }}</span>
                </div>
                <div class="progress mb-2" style="height: 10px;">
                    <div class="progress-bar bg-success" style="width: {{ $crisis->percent }}%;"></div>
                </div>
                <small class="text-muted text-start">{{ $crisis->donations_count ?? 0 }} donors</small>
                @if($crisis->deadline_date)
                    <br><small class="text-muted">Deadline: {{ \Carbon\Carbon::parse($crisis->deadline_date)->format('M d, Y') }}</small>
                @endif
            </div>

        </div>

        {{--  Donate Form  --}}
        <div class="col-lg-5">
            <div class="card shadow-sm p-4" style="position: sticky; top: 80px;">
               
                <h5 class="fw-bold  mb-4"> Donate Now</h5>

                @if(session('error'))
                   <div class="alert alert-danger small">
                     {{ session('error') }}
                    </div>
                @endif

                @guest
                    <div class="alert alert-warning small">
                        Please 
                        <a href="{{ route('show.login') }}?redirect={{ urlencode(url()->current()) }}">Login</a> 
                        or 
                        <a href="{{ route('show.register') }}?redirect={{ urlencode(url()->current()) }}">Register</a> 
                        before donating
                    </div>
                @endguest

                <form action="{{ route('donate.pay') }}" method="POST">
                    @csrf
                    <input type="hidden" name="crisis_id" value="{{ $crisis->id }}">

                    <p class="small text-muted mb-2">Choose an amount:</p>
                    <div class="d-flex gap-2 mb-3">
                        @foreach([100, 500, 1000, 5000] as $amount)
                            <button type="button" class="btn btn-outline-primary btn-sm"
                                    onclick="document.getElementById('amount').value='{{ $amount }}'">
                                BDT{{ $amount }}
                            </button>
                        @endforeach
                    </div>

                    <div class="mb-3">
                        <label class="form-label small">Custom Amount:</label>
                        <input type="number" name="amount" id="amount" class="form-control" placeholder="Amount" min="1" required>
                    </div>

                        <button type="submit" class="btn w-100 py-2 fw-semibold text-white"
                          style="background-color: {{ $crisis->isFull ? '#6b7280' : '#0f766e' }};" {{ $crisis->button_disabled }}>
                           {{ $crisis->target_reached }}
                        </button>

                </form>
            </div>
        </div>

    </div>
</div>

@endsection