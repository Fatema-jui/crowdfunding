
@extends('partials.master')
@section('content')

<h2>Crisis Category</h2>

<a href="{{ route('crisis.category.form') }}" class="btn btn-primary">Add Category</a>

<div class="table-responsive">
    <table class="table table-striped table-hover">
<thead>
        <tr>
            <th Scope="col">#</th>
            <th Scope="col">Category Name</th>
            <th Scope="col">Description</th>
            <th Scope="col">Status</th>
        </tr>
</thead>

<tbody>
    @foreach($categories as $category)
    <tr>
        <td Scope="row">{{$category->id}}</td>
        <td>{{$category->category_name}}</td>
        <td>{{$category->description}}</td>
        <td>{{$category->status}}</td>
        <td>
            <div class="btn-group" role="group" style="gap:5px;">
                <a href="{{ route('category.view' , $category->id)}}" class="btn btn-primary btn-sm">View</a>
                <a href="" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ route('category.delete',$category->id)}}" class="btn btn-danger btn-sm">Delete</a>               
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
 </table>
</div>

@endsection