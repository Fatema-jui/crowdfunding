@extends('frontend.partials.master')
@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm p-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">My Profile</h5>
                    <a href="{{ route('website') }}" class="btn btn-secondary btn-sm">← Back to Home</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('donor.profile.update') }}" method="POST" class="row g-3">
                @csrf
                    <div class="col-12">
                        <label class="form-label">Full Name:</label>
                        <input name="name" type="text" class="form-control" value="{{ $user->name }}" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Email Address:</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Phone Number:</label>
                        <input name="phone" type="text" class="form-control" value="{{ $user->phone }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">New Password:</label>
                        <input name="password" type="password" class="form-control" placeholder="••••••••">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Confirm Password:</label>
                        <input name="password_confirmation" type="password" class="form-control" placeholder="••••••••">
                    </div>
                    <div class="col-12 text-center ">
                        <button type="submit" class="btn w-50 text-white" style="background-color: #0f766e;">
                            Update Profile
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection