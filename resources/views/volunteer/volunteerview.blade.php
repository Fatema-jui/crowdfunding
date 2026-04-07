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
                        <td>{{ $volunteer->volunteer_name }}</td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>{{ $volunteer->email }}</td>
                    </tr>

                    <tr>
                       <th>Phone</th>
                       <td>{{$volunteer->phone}}</td>
                    </tr>

                    <tr>
                        <th>Address</th>
                        <td>{{$volunteer->address}}</td>
                    </tr>

                    <tr>
                        <th>Skill</th>
                        <td>{{$volunteer->skill}}</td>
                    </tr>

                    <tr>
                        <th>Availability</th>
                        <td>{{$volunteer->availability}}</td>
                    </tr>

                    <tr>
                        <th>Experience</th>
                        <td>{{$volunteer->experience}}</td>
                    </tr>
-
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($volunteer->status == 1 || $volunteer->status == 'active')
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
