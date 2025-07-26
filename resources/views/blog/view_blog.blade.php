@extends('layouts.app')
@section('title', 'View Blog')
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
                                        <h2 class="mb-2 page-title">Blog List</h2>
                                        <div class="mb-3">
                                            <a href="{{ route('blog.create') }}" class="btn btn-primary  text-white custom-btn">Create
                                                Blog</a>
                                        </div>
                                    </div>
                                    <!-- table -->
                                    <table class="table table-striped table-hover" id="dataTable-1">
                                        <thead class="custom-thead">
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Description</th>
                                                <th class="text-center">Image</th>
                                                <th class="text-center">Video</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($blog as $blog)
                                                <tr>
                                                    <td class="text-center">{{ $blog->id }}</td>
                                                    <td class="text-center">{{ $blog->name }}</td>
                                                    <td class="text-center">{{ Str::limit($blog->description, 40) }}</td>
                                                    <td class="text-center">
                                                        @php
                                                            $images = json_decode($blog->image, true);
                                                        @endphp

                                                        @if (!empty($images) && isset($images[0]))
                                                            <img src="{{ asset('images/blogs/' . $images[0]) }}"
                                                                alt="Blog Image" class="img-fluid"
                                                                style="width: 100px; height: 100px;">
                                                        @endif
                                                        <img src="{{ asset('assets/images/unnamed.jpg') }}" alt="User Image" class="img-fluid"
    style="width: 60px; height: 60px; object-fit: cover;">
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($blog->video)
                                                            <video controls style="max-width: 30%; height: auto;">
                                                                <source src="{{ asset('videos/blogs/' . $blog->video) }}"
                                                                    type="video/mp4">
                                                                Your browser does not support the video tag.
                                                            </video>
                                                        @endif
                                                        <img src="{{ asset('assets/images/unnamed.jpg') }}" alt="User Image" class="img-fluid"
    style="width: 60px; height: 60px; object-fit: cover;">
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('edit.blog', $blog->id) }}"
                                                            class="btn btn-sm btn-warning text-white custom-btn" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('destroy.blog', $blog->id) }}" method="POST"
                                                            style="display:inline;">
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
                    "paginate": {
                        "previous": "<i class='fa fa-angle-double-left'></i>",
                        "next": "<i class='fa fa-angle-double-right'></i>"
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
