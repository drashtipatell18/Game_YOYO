<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/h_style.css') }}" />
    <!-- Custom Checkbox Style -->
    <style>
        .db_custom_checkbox {
            position: relative;
            padding-left: 26px;
            cursor: pointer;
            user-select: none;
            display: inline-block;
            color: #ccc;
            font-size: 14px;
        }

        .db_custom_checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .db_custom_checkbox .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 16px;
            width: 16px;
            background-color: transparent;
            border: 2px solid #ccc;
            border-radius: 3px;
        }

        .db_custom_checkbox input:checked~.checkmark {
            background-color: black;
            border-color: white;
        }

        .db_custom_checkbox .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .db_custom_checkbox input:checked~.checkmark:after {
            display: block;
        }

        .db_custom_checkbox .checkmark:after {
            left: 4px;
            top: 0px;
            width: 5px;
            height: 9px;
            border: solid #fff;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .error {
            color: red;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .social-icons .icon {
            cursor: pointer;
        }
    </style>
</head>

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
                            <h2 class="mb-4">Welcome<br />The Yoyo Game</h2>
                            <form action={{ route('frontlogin') }} method="post" id="frontendlogin">
                                @csrf
                                <!-- Email -->
                                <div class="mb-3">
                                    <input type="email" name="email"
                                        class="form-control rounded py-2 px-4 text-black" placeholder="Enter Email" />
                                </div>
                                <!-- Password with eye icon -->
                                <div class="mb-3">
                                    <div class="position-relative">
                                        <input type="password" name="password"
                                            class="form-control rounded-end py-2 px-4 pe-5 text-black"
                                            placeholder="Enter Password" id="db_password_input" />
                                        <i class="fa-solid fa-eye-slash" id="db_toggle_password"
                                            style="
                                    position: absolute;
                                    top: 35%;
                                    right: 15px;
                                    transform: translateY(-50%);
                                    cursor: pointer;
                                    color: #888;
                                    z-index: 5;
                                    "></i>
                                    </div>
                                    <!-- Custom Checkbox + Forgot Password -->
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <label class="db_custom_checkbox">
                                            {{-- Remember Me
                                <input type="checkbox" id="rememberMe" />
                                <span class="checkmark"></span> --}}
                                        </label>
                                        <a href="/auth/ForgetPass.html" class="text-white-50 small">Forgot Password?</a>
                                    </div>
                                </div>
                                <!-- Sign In Button -->
                                <button type="submit" id="loginBtn" class="btn btn-light w-100 rounded-pill py-2">
                                    Sign In
                                </button>
                            </form>
                            <!-- Or continue with -->
                            <div class="d-flex align-items-center my-3">
                                <hr class="flex-grow-1 border-white" />
                                <span class="px-3 text-white-50 small">Or continue with</span>
                                <hr class="flex-grow-1 border-white" />
                            </div>
                            <!-- Social Icons -->
                            <div class="d-flex justify-content-center gap-4 mb-3 social-icons">
                                <div class="google icon">
                                    <img src="{{ asset('frontend/images/google-logo.png') }}" alt="Google"
                                        width="25" />
                                </div>
                                <div class="apple icon">
                                    <img src="{{ asset('frontend/images/apple-logo.png') }}" alt="Apple"
                                        width="20" />
                                </div>
                                <div class="facebook icon">
                                    <img src="{{ asset('frontend/images/Facebook-logo.png') }}" alt="Facebook"
                                        width="25" />
                                </div>
                            </div>
                            <!-- Create Account -->
                            <p class="text-center text-white-50 login-page-last">
                                Don’t have an account?
                                <a href="/auth/SignUp.html" class="text-white">Create Account!</a>
                            </p>
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

            // Password toggle
            $("#toggle_password").click(function() {
                const passwordInput = $("#password");
                const type = passwordInput.attr("type") === "password" ? "text" : "password";
                passwordInput.attr("type", type);
                $(this).toggleClass("fa-eye fa-eye-slash");
            });

            // Add custom strong password method
            // $.validator.addMethod("strongPassword", function(value, element) {
            //     return this.optional(element) ||
            //         /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/.test(value);
            // }, "Password must contain upper/lowercase, number, and special character");

            // Form validation rules
            $("#frontendlogin").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                        maxlength: 100
                    },
                    password: {
                        required: true,
                        minlength: 6
                        // strongPassword: true
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email",
                        email: "Enter a valid email",
                    },
                    password: {
                        required: "Please enter your password",
                        minlength: "Minimum 6 characters",
                    }
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
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

            // Real-time validation
            $('#email, #password').on('keyup blur', function() {
                $(this).valid();
            });

            // Social icon click
            $('.social-icons .icon').on('click', function() {
                const platform = $(this).attr('class').split(' ')[0];
                toastr.info(`${platform.charAt(0).toUpperCase() + platform.slice(1)} login clicked!`);
            });
        });
    </script>
</body>

</html>
