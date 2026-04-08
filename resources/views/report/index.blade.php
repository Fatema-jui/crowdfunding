@extends('partials.master')
@section('content')


<h2>Report</h2>

<!-- 🔍 Filter Form -->
<form method="GET" action="{{ route('report') }}">
    From: <input type="date" name="from_date">
    To: <input type="date" name="to_date">

    <select name="crisis_id">
        <option value="">All Crisis</option>
        @foreach($crisis as $c)
            <option value="{{ $c->id }}">{{ $c->title }}</option>
        @endforeach
    </select>

    <button type="submit">Filter</button>
</form>

<hr>

<!-- 📊 Summary -->
<h4>Total Donation: {{ $totalAmount }}</h4>
<h4>Total Records: {{ $totalDonor }}</h4>

<hr>

<!-- 📋 Table -->
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Donor</th>
        <th>Crisis</th>
        <th>Amount</th>
        <th>Date</th>
    </tr>

    @foreach($donations as $d)
    <tr>
        <td>{{ $d->id }}</td>
        <td>{{ $d->donor->name ?? 'N/A' }}</td>
        <td>{{ $d->crisis->title ?? 'N/A' }}</td>
        <td>{{ $d->amount }}</td>
        <td>{{ $d->created_at->format('d M Y') }}</td>
    </tr>
    @endforeach
</table>

<!-- 📄 Pagination -->
{{ $donations->links() }}

@endsection