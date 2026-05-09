@extends('partials.master')
@section('content')
<h2>Create Expense Form</h2>

<form action="{{ route('expense.form') }}" method="GET">
    <div class="mb-3">
        <label for="crisis_id" class="form-label">Crisis:</label>
        <select class="form-control" id="crisis_id" name="crisis_id" onchange="this.form.submit()">
            <option value="">--select a crisis--</option>
            @foreach($crises as $crisis)
                <option value="{{ $crisis->id }}" {{ request('crisis_id') == $crisis->id ? 'selected' : '' }}>
                    {{ $crisis->crisis_title }}
                </option>
            @endforeach
        </select>
    </div>
</form>

<form action="{{ route('expense.submit') }}" method="POST">
    @csrf
    <input type="hidden" name="crisis_id" value="{{ request('crisis_id') }}">

    <div class="mb-3">
        <label for="volunteer_id" class="form-label">Volunteer:</label>
        <select class="form-control" id="volunteer_id" name="volunteer_id" required>
            <option value="">--select a volunteer--</option>
            @foreach($volunteers as $volunteer)
                <option value="{{ $volunteer->id }}">{{ $volunteer->volunteer_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="purpose" class="form-label">Purpose:</label>
        <input type="text" class="form-control" id="purpose" name="purpose" required>
    </div>

    <div class="mb-3">
        <label for="amount" class="form-label">Amount (BDT):</label>
        <input type="number" class="form-control" id="amount" name="amount" required>
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Date:</label>
        <input type="date" class="form-control" id="date" name="date" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection