@extends('.partials.master')
@section('content')

<div class="container mt-4">
    <h3 class="mb-3 text-primary">Crisis View</h3>

    <div class="card shadow-sm border-0" style="max-width:600px;">
        <div class="card-body p-0">

            <table class="table table-striped mb-0">
                <tbody>
                    <tr>
                        <th style="width:30%">Crisis Title</th>
                        <td>{{ $crisis->crisis_title }}</td>
                    </tr>

                    <tr>
                        <th>Select Crisis</th>
                        <td>{{$crisis->category_id}}</td>
                    </tr>

                    <tr>
                        <th>Description</th>
                        <td>{{ $crisis->description }}</td>
                    </tr>

                    <tr>
                        <th>Target Amount</th>
                        <td>{{$crisis->target_amount}}</td>
                    </tr>
                    
                    <tr>
                        <th>Deadline Date</th>
                        <td>{{$crisis->deadline_date}}</td>
                    </tr>

                    <tr>
                        <th>Location</th>
                        <td>{{$crisis->location}}</td>
                    </tr>

                    <tr>
                        <th>Image</th>
                        <td>{{$crisis->image}}</td>
                    </tr>

                    <tr>
                        <th>Contact Number</th>
                        <td>{{$crisis->number}}</td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            @if($crisis->status == 1 || $crisis->status == 'active')
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
