@extends('.partials.master')
@section('content')

<div class="container  mt-4">
    <h3 class="mb-3 text-primary">Category View</h3>

    <div class="card shadow-sm border-0" style="max-width:600px;">
        <div class="card-body p-0">

            <table class="table table-striped mb-0">
                <tbody>
                    <tr>
                        <th style="width:30%">Name</th>
                        <td>{{ $category->category_name }}</td>
                    </tr>

                    <tr>
                        <th>Description</th>
                        <td>{{ $category->description }}</td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td>{{$category->image}}</td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            @if($category->status == 1 || $category->status == 'active')
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
