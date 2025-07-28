@extends('layouts.app')
@section('title', 'View Cart')
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

            .custom-btn {
                width: 107%;
            }

            .page-title {
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
                                        <h2 class="mb-2 page-title">Cart List</h2>
                                        <div class="mb-3">
                                            <a href="{{ route('add-to-cart.create') }}"
                                                class="btn btn-primary text-white custom-btn">Create
                                                Cart</a>
                                        </div>
                                    </div>
                                    <table id="cartTable" class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Product Name</th>
                                                <th class="text-center">User Name</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Total</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($carts as $cart)
                                                <tr>
                                                    <td class="text-center">{{ $cart->id }}</td>
                                                    <td class="text-center">{{ $cart->product->name }}</td>
                                                    <td class="text-center">{{ $cart->user->name }}</td>
                                                    <td class="text-center">{{ $cart->quantity }}</td>
                                                    <td class="text-center">${{ $cart->product->price }}</td>
                                                    <td class="text-center">${{ $cart->quantity * $cart->product->price }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('add-to-cart.edit', $cart->id) }}"
                                                            class="btn btn-warning btn-sm"><i class="fas fa-edit text-white"></i></a>
                                                        <form action="{{ route('add-to-cart.destroy', $cart->id) }}" method="POST"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm"><i class="fas fa-trash-alt text-white"></i></button>
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
    @endsection
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#cartTable').DataTable({
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
