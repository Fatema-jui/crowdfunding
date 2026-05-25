@extends('frontend.partials.master')
@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm p-4">

                
                <div class="mb-4">
                    <a href="{{ route('website') }}" class="btn btn-outline-secondary btn-sm mb-3">
                        ← Back to Home
                    </a>
                    <h4 class="fw-bold mb-1">Apply as a Volunteer</h4>
                </div>
                
                @if(session('success'))
                <div class="alert alert-success mt-2">{{ session('success') }}</div>
                 @endif

                <form action="{{ route('webvolunteer.submit') }}" class="row g-3" method="POST">
                    @csrf

                    <div class="col-12">
                        <div class="alert alert-info">
                            Thank you for your interest in volunteering with us! Please fill out the form below, and we will get back to you soon.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="volunteer_name" class="form-label">Full Name:</label>
                        <input name="volunteer_name" type="text" class="form-control" id="volunteer_name" placeholder="Enter your full name.." required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address:</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Enter your email address.." required>
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Password:</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="••••••••" required>
                    </div>

                    <div class="col-md-6">
                        <label for="password-confirmation" class="form-label">Confirm Password:</label>
                        <input name="password_confirmation" type="password" class="form-control" id="password-confirmation" placeholder="••••••••" required>
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone Number:</label>
                        <input name="phone" type="text" class="form-control" id="phone" placeholder="Enter your phone number..">
                    </div>

                    <div class="col-md-6">
                        <label for="address" class="form-label">Address:</label>
                        <input name="address" type="text" class="form-control" id="address" placeholder="Enter your address..">
                    </div>

                    <div class="col-md-6">
                        <label for="age" class="form-label">Age:</label>
                        <input name="age" type="number" class="form-control" id="age" placeholder="Enter your age..">
                    </div>

                    <div class="col-md-6">
                        <label for="NID" class="form-label">National ID:</label>
                        <input name="NID" type="text" class="form-control" id="NID" placeholder="Enter your National ID..">
                    </div>

                    <div class="col-md-6">
                        <label for="birth_date" class="form-label">Birth Date:</label>
                        <input name="birth_date" type="date" class="form-control" id="birth_date">
                    </div>

                    <div class="col-md-6">
                        <label for="gender" class="form-label">Gender:</label>
                        <select name="gender" class="form-control" id="gender">
                            <option value="">-- Select Gender --</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="message" class="form-label">Why do you want to volunteer?</label>
                        <textarea name="message"  type = "text" class="form-control" id="message" rows="4"></textarea>
                    </div>

                    <div class="col-12  text-center ">
                        <button type="submit" class="btn text-white" style="background-color: #0f766e; ">
                            Submit Application
                        </button>
                        <p class="text-center mt-3 mb-0 small">
                            Already have account?
                            <a href="{{ route('webvolunteer.login') }}" style="color: #0f766e;">Login here</a>
                        </p> 
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

@endsection