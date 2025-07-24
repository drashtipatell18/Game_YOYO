@extends('layouts.app')
@section('title', 'View Our Teams')
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
                                        <h2 class="mb-2 page-title">Our Team List</h2>
                                        <div class="mb-3">
                                            <a href="{{ route('our_teams.create') }}"
                                                class="btn btn-primary text-white custom-btn">Create
                                                Our Team</a>
                                        </div>
                                    </div>
                                    <!-- table -->
                                    <table class="table table-striped table-hover" id="dataTable-1">
                                        <thead class="custom-thead">
                                            <tr>
                                                <th class="text-center">Id</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Image</th>
                                                <th class="text-center">Designation</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ourTeams as $key => $team)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">{{ $team->name }}</td>

                                                    {{-- Category Image --}}
                                                    <td class="text-center">
                                                        @if ($team->image)
                                                            <img src="{{ asset('images/ourteam/' . $team->image) }}" alt="Team Image" width="60" height="60">
                                                        @else
                                                            <img src="{{ asset('assets/images/unnamed.jpg') }}" alt="User Image" class="img-fluid"
    style="width: 60px; height: 60px; object-fit: cover;">
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $team->designation }}</td>

                                                    {{-- Actions --}}
                                                    <td class="text-center">
                                                        <a href="{{ route('edit.our_teams', $team->id) }}"
                                                            class="btn btn-sm btn-warning text-white custom-btn" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        <form action="{{ route('destroy.our_teams', $team->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger custom-btn" title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete this Team?')">
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
