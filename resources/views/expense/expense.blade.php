@extends('partials.master')
@section('content')
<h2>Expense</h2>
<a href="{{ route('expense.form') }}" class="btn btn-primary">Add New Expense</a>

@if(session('success'))
    <div class="alert alert-success mt-2">{{ session('success') }}</div>
@endif

<div class="table-responsive mt-3">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Crisis</th>
                <th>Volunteer</th>
                <th>Purpose</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as  $expense)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $expense->crisis->crisis_title }}</td>
                <td>{{ $expense->volunteer->volunteer_name }}</td>
                <td>{{ $expense->purpose }}</td>
                <td>BDT {{ number_format($expense->amount, 2) }}</td>
                <td>{{ $expense->date }}</td>

                <td>
                    @if($expense->status == 'approved')
                        <span class="badge bg-success">Approved</span>
                    @elseif($expense->status == 'rejected')
                        <span class="badge bg-danger">Rejected</span>
                    @else
                        Pending
                    @endif
                </td>

                <td style="white-space: nowrap;">
                    @if($expense->status != 'approved')
                    <form action="{{ route('expense.approve', $expense->id) }}" method="POST" style="display:inline;">
                        @csrf
                    
                        <button type="submit" class="btn btn-primary btn-sm">Approve</button>
                    </form>
                    @endif

                    @if($expense->status != 'rejected')
                    <form action="{{ route('expense.reject', $expense->id) }}" method="POST" style="display:inline;">
                        @csrf
                        
                        <button type="submit" class="btn btn-warning btn-sm">Reject</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection