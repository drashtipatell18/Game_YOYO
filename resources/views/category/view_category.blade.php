@extends('layouts.app')
@section('title', 'View Category')
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
        .custom-btn{
            width: 107%;
        }
        .page-title{
            width: 50%;
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
                                        <h2 class="mb-2 page-title">Category List</h2>
                                        <div class="mb-3">
                                            <a href="{{ route('category.create') }}"
                                                class="btn btn-primary text-white custom-btn">Create
                                                Category</a>
                                        </div>
                                    </div>
                                    <!-- table -->
                                    <table class="table table-striped table-hover" id="dataTable-1">
                                        <thead class="custom-thead">
                                            <tr>
                                                <th class="text-center">Id</th>
                                                <th class="text-center">Category Name</th>
                                                <th class="text-center">Image</th>
                                                <th class="text-center">Icon</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $key => $category)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $category->name }}</td>

                                                    {{-- Category Image --}}
                                                    <td class="text-center">
                                                        @if ($category->image)
                                                            <img src="{{ asset('images/category/' . $category->image) }}" alt="Category Image" width="60" height="60">
                                                        @else
                                                           <img src="{{ asset('assets/images/unnamed.jpg') }}" alt="User Image" class="img-fluid"
    style="width: 60px; height: 60px; object-fit: cover;">
                                                        @endif
                                                    </td>

                                                     <td class="text-center">
                                                        @if ($category->image)
                                                            <img src="{{ asset('images/category/' . $category->icon) }}" alt="Category Image" width="60" height="60">
                                                        @else
                                                           <img src="{{ asset('assets/images/unnamed.jpg') }}" alt="User Image" class="img-fluid"
    style="width: 60px; height: 60px; object-fit: cover;">
                                                        @endif
                                                    </td>

                                                    {{-- Actions --}}
                                                    <td class="text-center">
                                                        <a href="{{ route('edit.category', $category->id) }}"
                                                            class="btn btn-sm btn-warning text-white custom-btn" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form action="{{ route('destroy.category', $category->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger custom-btn" title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete this category?')">
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
