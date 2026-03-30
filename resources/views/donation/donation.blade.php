@extends('partials.master')
@section('content')
<h2>Donation</h2>
<a href="{{ route('donation.form')}}" class="btn btn-primary">Add New Donation</a>
@endsection