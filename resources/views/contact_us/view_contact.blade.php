@extends('layouts.app')
@section('title', 'View Contact us')
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
                                        <h2 class="mb-2 page-title">Contact Us</h2>
                                    </div>
                                    <!-- table -->
                                    <table class="table table-striped table-hover" id="dataTable-1">
                                        <thead class="custom-thead">
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Tag</th>
                                                <th class="text-center">Message</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <tr>
                                                <td class="text-center">1</td>
                                                <td class="text-center">John Doe</td>
                                                <td class="text-center">john@example.com</td>
                                                <td class="text-center">Customer</td>
                                                <td class="text-center">Hello, I need help with my order.</td>
                                               <td class="text-center">
                                                    <button class="btn btn-sm btn-danger" style="color:white">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td class="text-center">Jane Smith</td>
                                                <td class="text-center">jane@example.com</td>
                                                <td class="text-center">Support</td>
                                                <td class="text-center">Please update me on ticket #1234.</td>
                                               <td class="text-center">
                                                    <button class="btn btn-sm btn-danger" style="color:white">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
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
