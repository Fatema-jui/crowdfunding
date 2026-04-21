@extends('partials.master')
@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="mb-0">Donor List</h5>
            <small class="text-muted">Total {{ $total }} donors registered</small>
        </div>
        <div>
            <a href="{{ route('donor.form') }}" class="btn btn-primary">Add New Donor</a>
        </div>
    </div>

    <form method="GET" action="{{ route('donor') }}" class="row g-2 mb-3">
        <div class="col-md-5">
            <input type="text" name="search" class="form-control"
                placeholder="Search by name or ID..." value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Search</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Donor</th>
                    <th>Contact</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($donors as $donor)
                <tr>
                    <td>{{ $donor->id }}</td>
                    <td>
                        <strong>{{ $donor->name }}</strong><br>
                        <small class="text-muted">{{ $donor->donor_id ?? 'N/A' }}</small>
                    </td>
                    <td>
                        {{ $donor->email }}<br>
                        <small>{{ $donor->phone }}</small>
                    </td>
                    <td>৳ {{ number_format($donor->total_donation) }}</td>
                    <td>{{ \Illuminate\Support\Carbon::parse($donor->donation_date)->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No donors found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $donors->withQueryString()->links() }}
    </div>
</div>

@endsection