@extends('frontend.partials.master')
@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm p-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Volunteer Profile</h5>
                     
                    <a href="{{ route('website') }}" class="btn btn-secondary btn-sm">← Back to Home</a>
                    
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('webvolunteer.profile.update') }}" method="POST" class="row g-3">
                @csrf

                    <div class="col-md-6">
                        <label class="form-label">Full Name:</label>
                        <input name="volunteer_name" type="text" class="form-control" value="{{ $volunteer->volunteer_name }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" value="{{ $volunteer->email }}" Disabled>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Phone:</label>
                        <input name="phone" type="text" class="form-control" value="{{ $volunteer->phone }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Address:</label>
                        <input name="address" type="text" class="form-control" value="{{ $volunteer->address }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Age:</label>
                        <input name="age" type="number" class="form-control" value="{{ $volunteer->age }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Gender:</label>
                        <select name="gender" class="form-control">
                            <option value="">-- Select --</option>
                            <option value="male"   {{ $volunteer->gender == 'male'   ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $volunteer->gender == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other"  {{ $volunteer->gender == 'other'  ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">NID:</label>
                        <input name="NID" type="text" class="form-control" value="{{ $volunteer->NID }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Birth Date:</label>
                        <input name="birth_date" type="date" class="form-control" value="{{ $volunteer->birth_date }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">New Password:</label>
                        <input name="password" type="password" class="form-control" placeholder="••••••••">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Confirm Password:</label>
                        <input name="password_confirmation" type="password" class="form-control" placeholder="••••••••">
                    </div>
                    

                    <div class="col-12 text-center">
                        <button type="submit" class="btn w-50 text-white" style="background-color: #0f766e; ">
                            Update Profile
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection