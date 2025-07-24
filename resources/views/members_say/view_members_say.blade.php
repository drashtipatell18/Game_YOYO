@extends('layouts.app')
@section('title', 'E-commerce | View Members Say')
@section('content')
    <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row my-4">
                        <!-- Small table -->
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="mb-3 d-flex justify-content-between">
                                        <h2 class="mb-2 page-title">Members Say</h2>
                                        <div class="mb-3">
                                            <a href="{{ route('members-say.create') }}"
                                                class="btn btn-primary text-white custom-btn">Create
                                                Members Say</a>
                                        </div>
                                    </div>
                                    <!-- table -->
                                    <table class="table table-striped table-hover" id="dataTable-1">
                                        <thead class="custom-thead">
                                            <tr>
                                                <th class="text-center">Id</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Description</th>
                                                <th class="text-center">Image</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($membersSay as $members)
                                                <tr>
                                                    <td class="text-center">{{ $members->id }}</td>
                                                    <td class="text-center">{{ $members->name }}</td>
                                                    <td class="text-center">{{ Str::limit($members->description, 50) }}</td>
                                                    <td class="text-center">
                                                        <img src="{{ asset('images/members_say/' . $members->image) }}"
                                                            alt="Service Icon" class="img-fluid"
                                                            style="width: 50px; height: 50px;">
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('edit.members-say', $members->id) }}"
                                                            class="btn btn-sm btn-warning text-white custom-btn" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('destroy.members-say', $members->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger custom-btn"
                                                                title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete this user?')">
                                                                <i class="fas fa-trash-alt text-white"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTable-1').DataTable({
                "pageLength": 10,
                "language": {
                    "lengthMenu": "Show _MENU_ entries",
                    "search": "Search:",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "Showing 0 to 0 of 0 entries",
                    "infoFiltered": "(filtered from _MAX_ total entries)",
                    "infoPostFix": "",
                    "paginate": {
                        "previous": "<i class='fa fa-angle-left'></i>",
                        "next": "<i class='fa fa-angle-right'></i>"
                    }
                },
                "order": [],
                "pagingType": "simple_numbers"
            });

            // Check for session messages and display them
            @if (session('success'))
                toastr.success("{{ session('success') }}", "Success", {
                    timeOut: 2000
                });
            @endif
            @if (session('danger'))
                toastr.error("{{ session('danger') }}", "Error", {
                    timeOut: 2000
                });
            @endif

        });
    </script>
@endpush
