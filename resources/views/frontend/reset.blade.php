<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset Password</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/h_style.css') }}" />
</head>
<style>
    .form-control.error {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
    }

    .form-control.valid {
        border-color: #28a745 !important;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
    }

    .error {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        display: block;
    }

    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #6c757d;
        z-index: 10;
    }

    .password-field {
        position: relative;
    }

    .password-field input {
        padding-right: 40px;
    }
</style>

<body>
    <div class="login-page">
        <div class="overlay">
            <div class="container">
                <div class="row form-box rounded-4 overflow-hidden">
                    <!-- Left Image -->
                    <div class="col-lg-6 col-md-6 d-none d-md-flex justify-content-center align-items-end img-part">
                        <img src="{{ asset('frontend/images/login.webp') }}" alt="robot"
                            class="img-fluid robot-img" />
                    </div>

                    <!-- Right Form -->
                    <div class="col-12 col-lg-5 col-md-6 d-flex align-items-center justify-content-center">
                        <div class="text-center login-content w-100">
                            <h2 class="mb-5">Reset Password</h2>
                            <form method="POST" action="{{ route('frontpost_reset', $token) }}" id="resetpassword">
                                @csrf

                                <!-- Hidden token field -->
                                <input type="hidden" name="token" value="{{ $token ?? request()->route('token') }}" />

                                <!-- Email (readonly/hidden based on your preference) -->
                                <input type="hidden" name="email" value="{{ $email ?? request()->email }}" />

                                <!-- New Password -->
                                <div class="mb-3 d-flex flex-column align-items-start input-wrapper">
                                    <label for="password" class="mb-1">New Password</label>
                                    <div class="password-field w-100">
                                        <input type="password" id="password" name="newpassword"
                                            class="form-control rounded py-2 px-4 text-black" placeholder="Enter New Password" />
                                        <i class="fas fa-eye password-toggle" onclick="togglePassword('password')"></i>
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-3 d-flex flex-column align-items-start input-wrapper">
                                    <label for="password_confirmation" class="mb-1">Confirm Password</label>
                                    <div class="password-field w-100">
                                        <input type="password" id="password_confirmation" name="confirmpassword"
                                            class="form-control rounded py-2 px-4 text-black" placeholder="Confirm New Password" />
                                        <i class="fas fa-eye password-toggle" onclick="togglePassword('password_confirmation')"></i>
                                    </div>
                                </div>

                                <!-- Reset Password Button -->
                                <button type="submit" class="btn btn-light w-100 rounded-pill py-2 mt-3">
                                    Update Password
                                </button>

                                <!-- Back to Login -->
                                <p class="text-center text-white-50 login-page-last mt-3">
                                    Remember your password?
                                    <a href="{{ route('frontend.login') }}" class="text-white"> Sign In</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize jQuery Validation
            $("#resetpassword").validate({
                rules: {
                    newpassword: {
                        required: true,
                        minlength: 8
                    },
                    confirmpassword: {
                        required: true,
                        minlength: 8,
                        equalTo: "#password"
                    }
                },
                messages: {
                    newpassword: {
                        required: "Please enter your new password",
                        minlength: "Password must be at least 8 characters long"
                    },
                    confirmpassword: {
                        required: "Please confirm your password",
                        minlength: "Password must be at least 8 characters long",
                        equalTo: "Passwords do not match"
                    }
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element.closest('.input-wrapper'));
                },
                highlight: function(element) {
                    $(element).addClass('error').removeClass('valid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('error').addClass('valid');
                },
                submitHandler: function(form) {
                    const submitBtn = $(form).find('button[type="submit"]');
                    const originalText = submitBtn.text();
                    submitBtn.prop('disabled', true).text('Updating...');
                    form.submit();
                }
            });
        });

        // Toggle password visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling;

            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}", "Success", {
                timeOut: 2000
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error("{{ session('error') }}", "Error", {
                timeOut: 2000
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}", "Error", {
                    timeOut: 3000
                });
            @endforeach
        </script>
    @endif
</body>

</html>
