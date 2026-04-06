@extends('partials.master')
@section('content')

<h2>Donar</h2>

<a href="{{ route('donar.form')}}" class="btn btn-primary">Add New Donar</a>


<div class="table-responsive">
    <table class="table table-striped table-hover">
<thead>
        <tr>
            <th Scope="col">#</th>
            <th Scope="col">Donar Name</th>
            <th Scope="col">Email</th>
            <th Scope="col">Phone</th>
            <th Scope="col">Address</th>
        </tr>
</thead>

<tbody>
    @foreach($donars as $donar)
    <tr>
        <td Scope="row">{{$donar->id}}</td>
        <td>{{$donar->name}}</td>
        <td>{{$donar->email}}</td>
        <td>{{$donar->phone}}</td>
        <td>{{$donar->address}}</td>
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