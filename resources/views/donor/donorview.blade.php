@extends('.partials.master')
@section('content')

<div class="container mt-4">
    <h3 class="mb-3 text-primary">Volunteer View</h3>

    <div class="card shadow-sm border-0" style="max-width:600px;">
        <div class="card-body p-0">

            <table class="table table-striped mb-0">
                <tbody>
                    <tr>
                        <th style="width:30%">Name</th>
                        <td>{{ $donor->name }}</td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>{{ $donor->email }}</td>
                    </tr>

                    <tr>
                       <th>Phone</th>
                       <td>{{$donor->phone}}</td>
                    </tr>

                    <tr>
                        <th>Address</th>
                        <td>{{$donor->address}}</td>
                    </tr>

                    <tr>
                        <th>Donor Type</th>
                        <td>{{$donor->donor_type}}</td>
                    </tr>

                    <tr>
                        <th>Donation Date</th>
                        <td>{{$donor->donation_date}}</td>
                    </tr>

                    <tr>
                        <th>Total Donation</th>
                        <td>{{$donor->total_donation}}</td>
                    </tr>
-
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($donor->status == 1 || $donor->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
