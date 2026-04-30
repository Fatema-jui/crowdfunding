@extends('frontend.partials.master')
@section('content')

<div class="container py-5 d-flex justify-content-center">
    <div class="card rounded-4 p-4 shadow" style="max-width: 640px; width: 100%; border: 1px solid #dee2e6;">

        {{-- Back button --}}
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mb-4" style="width: fit-content;">← Back</a>

        {{-- Header --}}
        <p class="fw-bold mb-1" style="font-size: 18px;">Expense Details</p>
        <h6 class="fw-semibold mb-4">{{ $crisis->crisis_title }}</h6>

        {{-- Summary --}}
        <div class="row g-3 mb-4">
            <div class="col-6">
                <div class="p-3 rounded-3 bg-primary text-white">
                    <p class="mb-1" style="font-size: 13px; opacity: 0.85;">Total collected</p>
                    <p class="fw-semibold mb-0" style="font-size: 22px;">BDT {{ number_format($crisis->donations_sum_amount ?? 0) }}</p>
                </div>
            </div>
            <div class="col-6">
                <div class="p-3 rounded-3 bg-secondary text-white">
                    <p class="mb-1" style="font-size: 13px; opacity: 0.85;">Total spent</p>
                    <p class="fw-semibold mb-0" style="font-size: 22px;">BDT {{ number_format($totalSpent) }}</p>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <table class="table table-striped" style="font-size: 14px;">
            <thead>
                <tr>
                    <th class="fw-bold pb-2">Volunteer</th>
                    <th class="fw-bold pb-2">Purpose</th>
                    <th class="fw-bold pb-2">Amount</th>
                    <th class="fw-bold pb-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenses as $expense)
                <tr>
                    <td class="py-3">{{ $expense->volunteer->volunteer_name }}</td>
                    <td class="py-3">{{ $expense->purpose }}</td>
                    <td class="py-3">BDT {{ number_format($expense->amount) }}</td>
                    <td class="py-3">
                        @if($expense->status == 'approved')
                            <span class="badge bg-success">Approved</span>
                        @elseif($expense->status == 'rejected')
                            <span class="badge bg-danger">Rejected</span>
                        @else
                            <span class="badge bg-warning text-dark">Pending</span>
                        @endif
                    </td>
                </tr>
                @endforeach
                {{-- Total row --}}
                <tr style="border-top: 2px solid #dee2e6;">
                    <td class="pt-3 fw-bold">Total</td>
                    <td></td>
                    <td class="pt-3 fw-bold">BDT  {{ number_format($expenses->sum('amount')) }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection