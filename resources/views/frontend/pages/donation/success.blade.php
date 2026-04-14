@extends('frontend.partials.master')
@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm text-center p-4">

                {{-- Success icon --}}
                <div class="mb-3">
                    <div class="rounded-circle d-inline-flex align-items-center
                                justify-content-center mb-3"
                         style="width:70px; height:70px; background:#d1fae5;">
                        <span style="font-size: 2rem;">✓</span>
                    </div>
                    <h4 class="fw-bold" style="color: #0f766e;">
                        Donation Successful!
                    </h4>
                    <p class="text-muted">
                        Thank you for your generous donation.
                    </p>
                </div>

                {{-- Receipt --}}
                <div class="bg-light rounded p-3 text-start mb-4">

                    <div class="d-flex justify-content-between py-2
                                border-bottom">
                        <span class="text-muted small">Crisis</span>
                        <span class="small fw-semibold">
                            {{-- DYNAMIC: session থেকে আসছে --}}
                            {{ $donation->crisis->title ?? 'N/A' }}
                        </span>
                    </div>

                    <div class="d-flex justify-content-between py-2
                                border-bottom">
                        <span class="text-muted small">Amount</span>
                        <span class="small fw-bold" style="color:#0f766e;">
                            ৳{{ number_format($donation->amount) }}
                        </span>
                    </div>

                    <div class="d-flex justify-content-between py-2
                                border-bottom">
                        <span class="text-muted small">Payment Method</span>
                        <span class="small fw-semibold">
                            {{ $donation->payment_method }}
                        </span>
                    </div>

                    <div class="d-flex justify-content-between py-2
                                border-bottom">
                        <span class="text-muted small">Donor</span>
                        <span class="small fw-semibold">
                            {{ auth()->user()->name }}
                        </span>
                    </div>

                    <div class="d-flex justify-content-between py-2">
                        <span class="text-muted small">Date</span>
                        <span class="small fw-semibold">
                            {{ $donation->created_at->format('d M Y') }}
                        </span>
                    </div>

                </div>

                {{-- Buttons --}}
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ url('/') }}"
                       class="btn fw-semibold"
                       style="background-color: #0f766e; color: #fff;">
                        ← Back to Home
                    </a>
                    {{-- DYNAMIC: My donations page পরে বানাবে --}}
                    <a href="#"
                       class="btn btn-outline-secondary">
                        My Donations
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection