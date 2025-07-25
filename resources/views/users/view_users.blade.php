@extends('layouts.app')
@section('title', 'E-commerce | View User')
@section('content')
<style>
    @media (max-width: 768px) {
        .custom-btn {
            width: 100%;
            margin-top: 5px;
        }

        table.dataTable {
            width: 100% !important;
        }

        div.dataTables_wrapper {
            overflow-x: auto;
        }

        .dataTables_filter input {
            width: 100% !important;
            margin-top: 10px;
        }
    }
</style>

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
                                        <h2 class="mb-2 page-title">User List</h2>
                                        <div class="mb-3">
                                            <a href="{{ route('users.create') }}" class="btn btn-primary text-white custom-btn">Create
                                                User</a>
                                        </div>
                                    </div>
                                  <!-- table -->
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover" id="dataTable-1">
                                            <thead class="custom-thead">
                                                <tr>
                                                    <th class="text-center">Id</th>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Email</th>
                                                    <th class="text-center">Role</th>
                                                    <th class="text-center">Image</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td class="text-center">{{ $user->id }}</td>
                                                        <td class="text-center">{{ $user->name }}</td>
                                                        <td class="text-center">{{ $user->email }}</td>
                                                        <td class="text-center">{{ $user->role->name }}</td>
                                                        <td class="text-center">
                                                                                                                @php
                                                                                                $imagePath = public_path('images/users/' . $user->image);
                                                                                                $imageUrl =
                                                                                                    file_exists($imagePath) && $user->image
                                                                                                        ? asset('images/users/' . $user->image)
                                                                                                        : asset('images/users/dummy-profile.jpg'); // Dummy image fallback
                                                                                            @endphp
                                                                                    <img src="{{ asset('assets/images/dummy-avatar.jpg') }}" alt="User Image" class="img-fluid"  style="width: 60px; height: 60px; object-fit: cover;">
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ route('users.edit', $user->id) }}"
                                                                class="btn btn-sm btn-warning text-white custom-btn mb-1" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
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
            @if (session('error'))
                toastr.error("{{ session('error') }}", "Error", {
                    timeOut: 2000
                });
            @endif
        });
    </script>
@endpush
