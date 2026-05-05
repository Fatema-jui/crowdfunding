@extends('frontend.partials.master')
@section('content')

<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4 text-center" style="max-width: 380px; width: 100%;">

        <h2 class="text-success">✓</h2>
        <h5 class="text-success">Payment Successful</h5>
        <p class="text-muted small">Thank you for your donation!</p>

        <hr>

        @if(session('tran_id'))
        <p class="small mb-1">Transaction ID: <strong>{{ session('tran_id') }}</strong></p>
        @endif

        @if(session('amount'))
        <p class="small mb-1">Amount: <strong class="text-success">BDT {{ session('amount') }}</strong></p>
        @endif

        <p class="small mb-0">Status: <span class="badge bg-success">Completed</span></p>

        <hr>

        <div class="d-flex gap-2">
            <a href="{{ route('website') }}" class="btn btn-success w-50">Home</a>
            <a href="{{ route('crisis.list') }}" class="btn btn-outline-secondary w-50">See More</a>
        </div>

    </div>
</div>

@endsection