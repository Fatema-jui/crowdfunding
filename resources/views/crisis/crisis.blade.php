@extends('partials.master')
@section('content')
<h2>Crises</h2>
<a href="{{ route('crisis.form')}}" class="btn btn-primary">Add New Crisis</a>

<div class="table-responsive">
    <table class="table table-striped table-hover">
<thead>
        <tr>
            <th Scope="col">#</th>
            <th Scope="col">Crisis Name</th>
            <th Scope="col">Description</th>
            <th Scope="col">Image</th>
            <th Scope="col">Status</th>
        </tr>
</thead>

<tbody>
    @foreach($crises as $crisis)
    <tr>
        <td Scope="row">{{$crisis->id}}</td>
        <td>{{$crisis->crisis_title}}</td>
        <td>{{$crisis->description}}</td>
         <td>
             @if($crisis->image)
                 <img width="100px" src="{{ asset('crises/' . $crisis->image) }}" alt="{{ $crisis->crisis_title }}">
             @else
                 <span>No Image</span>
             @endif
         </td>

        <td>{{$crisis->status}}</td>
        <td>
            <div class="btn-group" role="group" style="gap:5px;">
                <a href="{{ route('crisis.view' , $crisis->id)}}" class="btn btn-primary btn-sm">View</a>
                <a href="{{ route('crisis.edit', $crisis->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ route('crisis.delete',$crisis->id)}}" class="btn btn-danger btn-sm">Delete</a>               
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
 </table>
</div>


@endsection