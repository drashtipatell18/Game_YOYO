<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Game Ecommerce">
    <meta name="author" content="Game Ecommerce">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #8A775A 0%, #75654d 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Animated background particles */
        .bg-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) {
            width: 80px;
            height: 80px;
            left: 10%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            width: 60px;
            height: 60px;
            left: 20%;
            animation-delay: 1s;
        }

        .particle:nth-child(3) {
            width: 100px;
            height: 100px;
            left: 35%;
            animation-delay: 2s;
        }

        .particle:nth-child(4) {
            width: 40px;
            height: 40px;
            left: 70%;
            animation-delay: 3s;
        }

        .particle:nth-child(5) {
            width: 120px;
            height: 120px;
            left: 85%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-30px) rotate(120deg);
            }

            66% {
                transform: translateY(20px) rotate(240deg);
            }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 32%;
            position: relative;
            z-index: 2;
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .logo-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            box-shadow: 0 10px 25px rgba(255, 107, 107, 0.3);
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .logo::before {
            content: "🎮";
            font-size: 35px;
        }

        .title {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #7f8c8d;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            color: #555;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 15px 50px 15px 20px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #fff;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        /* Validation Error Styles */
        .form-group input.error {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.1) !important;
        }

        .form-group input.valid {
            border-color: #28a745 !important;
            box-shadow: 0 0 0 4px rgba(40, 167, 69, 0.1) !important;
        }

        /* Error message styles */
        label.error {
            color: #dc3545 !important;
            font-size: 18px !important;
            font-weight: 400 !important;
            margin-top: 5px !important;
            margin-bottom: 0 !important;
            display: block !important;
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            font-size: 20px;
            transition: color 0.3s ease;
        }

        .form-group input:focus+.input-icon {
            color: #667eea;
        }

        .form-group input.error+.input-icon {
            color: #dc3545;
        }

        .form-group input.valid+.input-icon {
            color: #28a745;
        }

        .forgot-password {
            text-align: right;
            margin-bottom: 30px;
        }

        .forgot-password a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #764ba2;
        }

        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #8A775A 0%, #75654d 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .login-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #c3e6cb;
            margin-bottom: 20px;
            display: none;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .login-container {
                max-width: 90%;
                margin: 20px;
                padding: 30px 25px;
            }

            .title {
                font-size: 24px;
            }
        }

        @keyframes clickPulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            100% {
                transform: scale(20);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <div class="bg-animation">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="login-container">
        <div class="logo-section">
            <div class="">
                <img src="{{ asset('assets/images/favicon.png') }}" alt="logo" class="logo-icon me-2"
                    style="width: 80px; height: 80px;">
            </div>
            <h1 class="title">Game Ecommerce</h1>
        </div>

        <form id="loginForm" action="{{ route('loginstore') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <input type="text" id="email" class="form-control" name="email"
                        placeholder="Enter your email">
                        <span class="input-icon">✉️</span>
                    </div>
                    @error('email')
                        <label class="error">{{ $message }}</label>
                    @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrapper">
                    <input type="password" id="password" class="form-control" name="password"
                        placeholder="Enter your password">
                    <span class="input-icon">🔒</span>
                </div>
                @error('password')
                    <label class="error">{{ $message }}</label>
                @enderror
            </div>

            <div class="forgot-password">
                <a href="{{ route('forget.password') }}">Forgot
                    password?</a>
            </div>

            <button type="submit" class="login-btn">
                Sign In
            </button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize jQuery Validation
            $("#loginForm").validate({
                rules: {
                    email: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 50
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email",
                    },
                    password: {
                        required: "Please enter your password",
                        minlength: "Password must be at least 6 characters long",
                        maxlength: "Password cannot exceed 50 characters"
                    }
                },
                errorPlacement: function(error, element) {
                    // Place error message after the input wrapper
                    error.insertAfter(element.closest('.input-wrapper'));
                },
                highlight: function(element) {
                    $(element).addClass('error').removeClass('valid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('error').addClass('valid');
                },
                submitHandler: function(form) {
                    handleFormSubmission();
                }
            });

            // Add real-time validation feedback
            $('#username, #password').on('keyup blur', function() {
                $(this).valid();
            });
        });

        function handleFormSubmission() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            // Simulate loading
            const btn = document.querySelector('.login-btn');
            const originalText = btn.textContent;
            btn.textContent = 'Signing in...';
            btn.disabled = true;

            setTimeout(() => {
                // Show success message
                const successMsg = document.getElementById('successMessage');
                successMsg.textContent = `Welcome ${username}! You would now be redirected to the admin dashboard.`;
                successMsg.style.display = 'block';

                // Reset button
                btn.textContent = originalText;
                btn.disabled = false;

                // Hide success message after 5 seconds
                setTimeout(() => {
                    successMsg.style.display = 'none';
                }, 5000);
            }, 2000);
        }

        // Helper function for alerts
        function showAlert(message) {
            alert(message);
        }

        // Add some interactivity to input fields
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.parentElement.style.transform = 'translateY(-2px)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.parentElement.style.transform = 'translateY(0)';
            });
        });

        // Add particle animation on click
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('login-btn')) {
                createClickEffect(e.clientX, e.clientY);
            }
        });

        function createClickEffect(x, y) {
            const effect = document.createElement('div');
            effect.style.position = 'fixed';
            effect.style.left = x + 'px';
            effect.style.top = y + 'px';
            effect.style.width = '10px';
            effect.style.height = '10px';
            effect.style.background = 'rgba(255, 255, 255, 0.8)';
            effect.style.borderRadius = '50%';
            effect.style.pointerEvents = 'none';
            effect.style.animation = 'clickPulse 0.6s ease-out forwards';
            effect.style.zIndex = '1000';

            document.body.appendChild(effect);

            setTimeout(() => {
                document.body.removeChild(effect);
            }, 600);
        }
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
</body>

</html>
