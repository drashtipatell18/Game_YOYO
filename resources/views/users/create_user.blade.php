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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ isset($user) ? $user->name : '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control"
                                        value="{{ isset($user) ? $user->username : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            @if (!isset($user))
                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ isset($user) ? $user->email : '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="role_id">Role</label>
                                    <select name="role_id" class="form-control">
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $key => $role)
                                            <option value="{{ $key }}"
                                                {{ isset($user) && $user->role_id == $key ? 'selected' : '' }}>
                                                {{ $role }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" class="form-control"
                                        value="{{ isset($user) ? $user->phone : '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="favourite_game">Favourite Game</label>
                                    <input type="text" name="favourite_game" class="form-control"
                                        value="{{ isset($user) ? $user->favourite_game : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="gaming_platform">Gaming Platform</label>
                                    <input type="text" name="gaming_platform" class="form-control"
                                        value="{{ isset($user) ? $user->gaming_platform : '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="country">Country</label>
                                    <input type="text" name="country" class="form-control"
                                        value="{{ isset($user) ? $user->country : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="image">Image</label>
                            @if (isset($user) && $user->image)
                                <img src="{{ asset('images/users/' . $user->image) }}" alt="User Image" class="img-fluid"
                                    style="width: 100px; height: 100px;">
                            @endif
                            <input type="file" name="image" class="form-control" id="image">
                            <div id="image-preview" class="mt-2" style="display: none;">
                                <img src="" alt="Image Preview" class="img-fluid"
                                    style="width: 100px; height: 100px;">
                            </div>
                        </div>

                        <div class="form-group text-center p-3">
                            <button type="submit" class="btn btn-primary mr-2 text-white custom-btn" style="pointer-events: auto;">
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
                        username: {
                            required: true,
                        },
                        password: {
                            required: true,
                        },
                        phone: {
                            required: true,
                        },
                        favourite_game: {
                            required: true,
                        },
                        gaming_platform: {
                            required: true,
                        },
                        country: {
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
                        },
                        username: {
                            required: 'Username is required',
                        },
                        phone: {
                            required: 'Phone is required',
                        },
                        favourite_game: {
                            required: 'Favourite game is required',
                        },
                        gaming_platform: {
                            required: 'Gaming platform is required',
                        },
                        country: {
                            required: 'Country is required',
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
