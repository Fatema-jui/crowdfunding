@extends('partials.master')
@section('content')

<h2>Crisis</h2>

<a href="{{ route('crisis.form')}}" class="btn btn-primary">Add new Campagin</a>

<div class="table-responsive">
    <table class="table table-striped table-hover">
<thead>
        <tr>
            <th Scope="col">#</th>
            <th Scope="col">Crisis Title</th>
            <th Scope="col">Select Category</th>
            <th Scope="col">Description</th>
            <th Scope="col">Target Amount</th>
            <th Scope="col">Deadline Date</th>
            <th Scope="col">Location</th>
            <th Scope="col">Image</th>
            <th Scope="col">Contact Number</th>
        </tr>
</thead>

<tbody>
    @foreach($crises as $crisis)
    <tr>
        <td Scope="row">{{$crisis->id}}</td>
        <td>{{$crisis->crisis_title}}</td>
        <td>{{$crisis->category_id}}</td>
        <td>{{$crisis->description}}</td>
        <td>{{$crisis->target_amount}}</td>
        <td>{{$crisis->deadline_date}}</td>
        <td>{{$crisis->location}}</td>
        <td>{{$crisis->image}}</td>
        <td>{{$crisis->number}}</td>
        <td>{{$crisis->status}}</td>
        <td>
            <div class="btn-group" role="group" style="gap:5px;">
                <a href="" class="btn btn-primary btn-sm">View</a>
                <a href="" class="btn btn-warning btn-sm">Edit</a>
                <a href="" class="btn btn-danger btn-sm">Delete</a>               
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
 </table>
</div>

@endsection
