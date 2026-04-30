@extends('partials.master')
@section('content')

<div class="container">
    <h2>Expense Report</h2>

    <form method="GET" action="{{ route('report.generate') }}">
        <div class="row mb-3 align-items-end">
            <div class="col-md-3">
                <label>From Date</label>
                <input type="date" name="from_date" class="form-control"
                    value="{{ $from_date ?? '' }}" required>
            </div>
            <div class="col-md-3">
                <label>To Date</label>
                <input type="date" name="to_date" class="form-control"
                    value="{{ $to_date ?? '' }}" required>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Generate</button>
            </div>
            @isset($expenses)
            <div class="col-md-2">
               <a href="{{ route('report.export', ['from_date' => $from_date, 'to_date' => $to_date]) }}"
                 class="btn btn-secondary w-100">Export
                </a>
            </div>
            @endisset
        </div>
    </form>

    @isset($expenses)

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center p-3">
                <small class="text-muted">Total Expense</small>
                <h4>BDT {{ number_format($total, 2) }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3">
                <small class="text-muted">Entries</small>
                <h4>{{ $expenses->count() }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3">
                <small class="text-muted">Approved</small>
                <h4>{{ $approved }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center p-3">
                <small class="text-muted">Pending</small>
                <h4>{{ $pending }}</h4>
            </div>
        </div>
    </div>

    <div id="printArea">
        <h5 class="mb-2">Report: {{ $from_date }} to {{ $to_date }}</h5>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Crisis</th>
                    <th>Volunteer</th>
                    <th>Purpose</th>
                    <th>Amount (BDT)</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @if($expenses->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center">No expenses found.</td>
                    </tr>
                @else
                    @foreach($expenses as $i => $exp)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $exp->crisis->crisis_title ?? '—' }}</td>
                        <td>{{ $exp->volunteer->volunteer_name ?? '—' }}</td>
                        <td>{{ $exp->purpose }}</td>
                        <td>{{ number_format($exp->amount, 2) }}</td>
                        <td>{{ $exp->date }}</td>
                        <td>
                            @if($exp->status === 'approved')
                                <span class="badge bg-success">Approved</span>
                            @elseif($exp->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr class="table-secondary fw-bold">
                    <td colspan="4">Total</td>
                    <td>{{ number_format($total, 2) }}</td>
                    <td colspan="2"></td>
                </tr>
            </tfoot>
        </table>
    </div>

    @endisset
</div>


@endsection