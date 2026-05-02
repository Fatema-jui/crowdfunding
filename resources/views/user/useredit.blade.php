@extends('partials.master')
@section('content')
<div class="container mt-4">
    <h3 class="mb-3 text-primary">Edit User </h3>

    <div class="card shadow-sm border-0" style="max-width:600px;">
        <div class="card-body p-0">

       <form action="{{ route('user.update', $user->id) }}" method="POST" >
            @csrf
            @method('PUT')
            <input type="text" name="name" value="{{ $user->name}}" class="form-control"><br>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control"><br>
            <input type="text" name="phone" value="{{ $user->phone }}" class="form-control"><br>
            <select name="role" class="form-control">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                
                <option value="donor" {{ $user->role == 'donor' ? 'selected' : '' }}>Donor</option>
            </select><br>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        </div>
    </div>
@endsection