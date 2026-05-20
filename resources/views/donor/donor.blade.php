@extends('partials.master')
@section('content')
<h2>Donor List</h2>
<a href="{{ route('donor.form') }}" class="btn btn-primary">Add New Donor</a>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Donor Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Action</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($donors as $donor)
            <tr>
                <td scope="row">{{  $loop->iteration }}</td>
                <td>{{ $donor->name }}</td>
                <td>{{ $donor->email }}</td>
                <td>{{ $donor->phone }}</td>
                <td>
                    <div class="btn-group" role="group" style="gap:5px;">
                        <a href="{{ route('donor.view', $donor->id) }}" class="btn btn-primary btn-sm">View</a>
                        <a href="" class="btn btn-warning btn-sm">Edit</a> 
                        <a href="{{ route('donor.delete', $donor->id) }}" class="btn btn-danger btn-sm">Delete</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection