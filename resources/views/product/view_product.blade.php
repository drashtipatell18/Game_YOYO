@extends('layouts.app')
@section('title', 'View Product')
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
                                        <h2 class="mb-2 page-title">Product List</h2>
                                        <div class="mb-3">
                                            <a href="{{ route('product.create') }}"
                                                class="btn btn-primary text-white custom-btn">Create Product</a>
                                        </div>
                                    </div>
                                    <!-- table -->
                                    <table class="table table-striped table-hover" id="dataTable-1">
                                        <thead class="custom-thead">
                                            <tr>
                                                <th class="text-center">Id</th>
                                                <th class="text-center">Category</th>
                                                <th class="text-center">Image</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td class="text-center">{{ $product->id }}</td>
                                                    <td class="text-center">
                                                        {{ $product->category->name ?? 'No Category' }}
                                                    </td>
                                                    <td class="text-center">
                                                        @php
                                                            $firstImage = explode(',', $product->image)[0] ?? null;
                                                        @endphp

                                                        @if ($firstImage)
                                                            <img class="avatar-img rounded-circle"
                                                                src="{{ asset('images/products/' . trim($firstImage)) }}"
                                                                alt="Product Image"
                                                                style="width: 30px; height: 30px; object-fit: cover; border: 2px solid #dee2e6;">
                                                        @else
                                                            <img src="{{ asset('assets/images/unnamed.jpg') }}"
                                                                alt="User Image" class="img-fluid"
                                                                style="width: 60px; height: 60px; object-fit: cover;">
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $product->name }}</td>
                                                    <td class="text-center">
                                                        <span
                                                            class="badge toggle-status {{ $product->status === 'active' ? 'bg-success' : 'bg-danger text-dark' }}"
                                                            data-id="{{ $product->id }}">
                                                            {{ $product->status === 'active' ? 'Active' : 'Inactive' }}
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('product.edit', $product->id) }}"
                                                            class="btn btn-sm btn-warning text-white" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('product.delete', $product->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger custom-btn"
                                                                title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete this product?')">
                                                                <i class="fas fa-trash-alt text-white"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <!-- View Model Code -->

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
                "order": [
                    [0, "desc"]
                ]
            });


            // Status Active or Inactive

            $('.toggle-status').click(function() {
                var badge = $(this);
                var productId = badge.data('id');

                $.ajax({
                    url: '/product/toggle-status/' + productId,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'active') {
                            badge.removeClass('bg-danger text-dark').addClass('bg-success')
                                .text('Active');
                        } else {
                            badge.removeClass('bg-success').addClass('bg-danger text-dark')
                                .text('Inactive');
                        }
                    },
                    error: function() {
                        alert('Something went wrong. Please try again.');
                    }
                });
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
