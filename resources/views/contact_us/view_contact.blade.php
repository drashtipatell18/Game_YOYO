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
                                           @foreach ($contacts as $contact)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $contact->name }}</td>
                                                    <td class="text-center">{{ $contact->email }}</td>
                                                    <td class="text-center">{{ $contact->tag }}</td>
                                                    <td class="text-center">{{ $contact->message }}</td>
                                                    <td class="text-center">
                                                        <form action="{{ route('contactUs.delete', $contact->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger custom-btn" title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete this Contact?')">
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
