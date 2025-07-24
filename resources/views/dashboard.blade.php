@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@section('content')


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if(session('success'))
        toastr.success("{{ session('success') }}", "Success", { timeOut: 2000 });
        @endif

        @if(session('error'))
        toastr.error("{{ session('error') }}", "Error", { timeOut: 2000 });
        @endif
    </script>
@endpush
@endsection
