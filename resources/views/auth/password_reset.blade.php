<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request</title>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f4f4f4;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background: linear-gradient(135deg, #8A775A 0%, #75654d 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .email-header h1 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .email-header p {
            font-size: 16px;
            opacity: 0.9;
        }

        .email-body {
            padding: 40px 30px;
        }

        .greeting {
            font-size: 18px;
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .message {
            font-size: 16px;
            line-height: 1.8;
            color: #555555;
            margin-bottom: 30px;
        }

        .reset-button {
            display: inline-block;
            background: linear-gradient(135deg, #8A775A 0%, #75654d 100%);
            color: white;
            text-decoration: none;
            padding: 16px 32px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .reset-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .button-container {
            text-align: center;
            margin: 30px 0;
        }

        .alternative-link {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
            word-break: break-all;
            font-family: monospace;
            font-size: 14px;
            color: #495057;
        }

        .security-notice {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
            color: #856404;
        }

        .security-notice .icon {
            display: inline-block;
            margin-right: 8px;
            font-size: 16px;
        }

        .expiry-info {
            font-size: 14px;
            color: #6c757d;
            text-align: center;
            margin: 20px 0;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }

        .footer p {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .footer .company-name {
            font-weight: 600;
            color: #495057;
        }

        .social-links {
            margin-top: 20px;
        }

        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #6c757d;
            text-decoration: none;
            font-size: 14px;
        }

        .divider {
            height: 1px;
            background-color: #e9ecef;
            margin: 30px 0;
        }

        /* Responsive styles */
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 10px;
                border-radius: 4px;
            }

            .email-header,
            .email-body,
            .footer {
                padding: 20px;
            }

            .email-header h1 {
                font-size: 24px;
            }

            .reset-button {
                padding: 14px 28px;
                font-size: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1 style="color:white">Password Reset Request</h1>
            <p>We received a request to reset your password</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <div class="greeting">
                Hello {{ $user->first_name }} {{ $user->last_name }},
            </div>

            <div class="message">
                We received a request to reset the password for your account associated with this email address. If you
                made this request, please click the button below to reset your password.
            </div>

            <div class="button-container">
                <a href="{{ url('reset/' . $user->remember_token) }}" class="reset-button">Reset My Password</a>
            </div>

            <div class="expiry-info">
                This link will expire in 24 hours for security reasons.
            </div>

            <div class="security-notice">
                <span class="icon">🔒</span>
                <strong>Security Notice:</strong> If you didn't request this password reset, please ignore this email or
                contact our support team if you have concerns about your account security.
            </div>

            <div class="divider"></div>

            <div class="message">
                If the button above doesn't work, you can copy and paste the following link into your browser:
            </div>

            <div class="alternative-link">
                {{ url('reset/' . $user->remember_token) }}
            </div>

            <div class="message">
                For security reasons, this link will only work once and will expire in 24 hours. If you need to reset
                your password after this time, please request a new reset link.
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="company-name">Kalathiya Infotech</p>
            <p>If you have any questions, please contact us at info@yoyokhel.com</p>
        </div>
    </div>
</body>

</html>
