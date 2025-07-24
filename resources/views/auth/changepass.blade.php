@extends('layouts.app')
@section('title', 'Change Password')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<div class="row">
    <div class="col-md-6 grid-margin stretch-card" style="margin: 0 auto;">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Change Password</h4>
                <form action="{{ route('change-password') }}" method="post" id="change-password-form">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="current_password">Current Password</label>
                        <input type="password" name="current_password" id="current_password" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" id="new_password" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                    </div>
                    <div class="form-group text-center p-3">
                        <button type="submit" class="btn btn-primary mr-2 text-white custom-btn" style="pointer-events: auto;">
                            Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add custom validation method for current password
            $.validator.addMethod("checkCurrentPassword", function(value, element) {
                let isValid = false;
                $.ajax({
                    type: "POST",
                    url: "{{ route('checkCurrentPassword') }}",
                    data: {
                        current_password: value,
                        _token: '{{ csrf_token() }}'
                    },
                    async: false,
                    success: function(response) {
                        isValid = response.valid;
                    },
                    error: function() {
                        isValid = false;
                    }
                });
                return isValid;
            }, "Current password is incorrect.");

            $('#change-password-form').validate({
                rules: {
                    current_password: {
                        required: true,
                        checkCurrentPassword: true
                    },
                    new_password: {
                        required: true,
                        minlength: 8
                    },
                    confirm_password: {
                        required: true,
                        equalTo: '#new_password'
                    }
                },
                messages: {
                    current_password: {
                        required: 'Current password is required'
                    },
                    new_password: {
                        required: 'New password is required',
                        minlength: 'New password must be at least 8 characters long'
                    },
                    confirm_password: {
                        required: 'Confirm password is required',
                        equalTo: 'Confirm password must match new password'
                    }
                },
                errorElement: 'span',
                errorClass: 'text-danger',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    error.insertAfter(element);
                },
                highlight: function(element, errorClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    // Show loading state
                    $('button[type="submit"]').prop('disabled', true).text('Changing Password...');
                    form.submit();
                }
            });

            // Real-time validation for current password
            $('#current_password').on('blur', function() {
                if ($(this).val()) {
                    $(this).valid();
                }
            });
        });
    </script>
    @if(session('success'))
        <script>
            toastr.success("{{ session('success') }}", "Success", { timeOut: 2000 });
        </script>
    @endif

    @if(session('error'))
        <script>
            toastr.error("{{ session('error') }}", "Error", { timeOut: 2000 });
        </script>
    @endif
@endpush
