@extends('layouts.app')
@section('title', isset($user) ? 'Edit User' : 'Create User')
@section('content')
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card" style="margin: 0 auto;">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ isset($user) ? 'Edit User' : 'Create User' }}</h4>
                    <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="post"
                        enctype="multipart/form-data" id="user-form">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ isset($user) ? $user->first_name : '' }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ isset($user) ? $user->email : '' }}">
                        </div>
                        @if (!isset($user))
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        @endif
                        <div class="form-group mb-3">
                            <label for="role_id">Role</label>
                            <select name="role_id" class="form-control">
                                <option value="">Select Role</option>
                                @foreach ($roles as $key => $role)
                                    <option value="{{ $key }}"
                                        {{ isset($user) && $user->role_id == $key ? 'selected' : '' }}>{{ $role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="image">Image</label>
                            @php
                                $imagePath = isset($user) && $user->image && file_exists(public_path('images/users/' . $user->image))
                                    ? asset('images/users/' . $user->image)
                                    : asset('images/users/dummy-profile.jpg'); // fallback dummy image
                            @endphp

                            <img src="{{ $imagePath }}" alt="User Image" class="img-fluid"
                                 style="width: 100px; height: 100px; margin-bottom: 10px;">

                            <input type="file" name="image" class="form-control" id="image">
                        </div>

                <div class="form-group text-center p-3">
                    <button type="submit" class="btn btn-primary mr-2 text-white" style="pointer-events: auto;">
                        {{ isset($user) ? 'Update' : 'Submit' }}
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#image').change(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
        $(document).ready(function() {
            $('#user-form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    role_id: {
                        required: true,
                    },
                    password: {
                        required: true,
                    }

                },
                messages: {
                    name: {
                        required: 'Name is required',
                    },
                    email: {
                        required: 'Email is required',
                        email: 'Please enter a valid email address',
                    },
                    role_id: {
                        required: 'Role is required',
                    },
                    password: {
                        required: 'Password is required',
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    // Optional: Add loading state
                    var submitBtn = $(form).find('button[type="submit"]');
                    var originalText = submitBtn.text();
                    submitBtn.prop('disabled', true).text('Processing...');
                    // Submit the form
                    form.submit();
                }
            });
        });
    </script>
@endpush
