@extends('partials.master')
@section('content')

<div class="container py-3">

    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm mb-3">← Back to Report</a>

    <div class="d-inline-block px-3 py-1 text-white rounded-top" style="background:#1D6F42; font-size:13px;">
        expense_report_{{ $from_date }}_to_{{ $to_date }}.xlsx
    </div>

    <div class="border rounded-bottom rounded-end" style="border-color:#1D6F42 !important; border-width:2px !important;">
        <table class="table table-bordered table-striped mb-0" style="font-size:13px;">
            <thead class="thead-dark">
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
                    @foreach($expenses as $i => $expense)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $expense->crisis->crisis_title ?? '—' }}</td>
                        <td>{{ $expense->volunteer->volunteer_name ?? '—' }}</td>
                        <td>{{ $expense->purpose }}</td>
                        <td>{{ number_format($expense->amount, 2) }}</td>
                        <td>{{ $expense->date }}</td>
                        <td>
                            @if($expense->status === 'approved')
                                <span class="text-success font-weight-bold">Approved</span>
                            @elseif($expense->status === 'pending')
                                <span class="text-warning font-weight-bold">Pending</span>
                            @else
                                <span class="text-danger font-weight-bold">Rejected</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

</div>

@endsection