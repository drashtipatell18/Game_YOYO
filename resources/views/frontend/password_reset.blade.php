<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request - YOYO Khel</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <style>
        /* Reset styles for email clients */
        * {
            margin: 0 !important;
            padding: 0 !important;
            box-sizing: border-box !important;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif !important;
            line-height: 1.6 !important;
            color: #333 !important;
            background: #667eea !important;
            min-height: 100vh !important;
            padding: 20px !important;
            margin: 0 !important;
        }

        /* Gmail-specific fixes */
        .gmail-fix {
            border-collapse: collapse !important;
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        .email-container {
            max-width: 600px !important;
            margin: 0 auto !important;
            background: #ffffff !important;
            border-radius: 20px !important;
            overflow: hidden !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
        }

        .header {
            background: linear-gradient(135deg, #2d1b69 0%, #11998e 100%) !important;
            padding: 40px 30px !important;
            text-align: center !important;
            color: white !important;
        }

        .header .icon {
            font-size: 48px !important;
            margin-bottom: 15px !important;
            display: block !important;
            line-height: 1 !important;
        }

        .header h1 {
            font-size: 28px !important;
            font-weight: 600 !important;
            margin: 0 0 10px 0 !important;
            padding: 0 !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3) !important;
            line-height: 1.2 !important;
        }

        .header .subtitle {
            font-size: 16px !important;
            opacity: 0.9 !important;
            font-weight: 300 !important;
            margin: 0 !important;
            padding: 0 !important;
            line-height: 1.3 !important;
        }

        .content {
            padding: 40px 30px !important;
        }

        .greeting {
            font-size: 18px !important;
            font-weight: 600 !important;
            margin: 0 0 25px 0 !important;
            padding: 0 !important;
            color: #2d1b69 !important;
            line-height: 1.3 !important;
        }

        .message {
            font-size: 16px !important;
            margin: 0 0 25px 0 !important;
            padding: 0 !important;
            color: #555 !important;
            line-height: 1.6 !important;
        }

        .button-container {
            text-align: center !important;
            margin: 30px 0 !important;
            padding: 0 !important;
        }

        .reset-button {
            display: inline-block !important;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white !important;
            text-decoration: none !important;
            padding: 15px 35px !important;
            border-radius: 50px !important;
            font-weight: 600 !important;
            font-size: 16px !important;
            text-align: center !important;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3) !important;
            border: none !important;
            margin: 0 !important;
            line-height: 1.2 !important;
        }

        .reset-button:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4) !important;
            color: white !important;
            text-decoration: none !important;
        }

        .expiry-info {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%) !important;
            padding: 15px 20px !important;
            border-radius: 10px !important;
            text-align: center !important;
            font-weight: 500 !important;
            color: #2d1b69 !important;
            margin: 25px 0 !important;
            font-size: 14px !important;
            line-height: 1.4 !important;
        }

        .expiry-info .clock-icon {
            font-size: 16px !important;
            margin-right: 6px !important;
            vertical-align: middle !important;
        }

        .security-notice {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%) !important;
            padding: 20px !important;
            border-radius: 10px !important;
            margin: 25px 0 !important;
            border-left: 4px solid #ff6b6b !important;
        }

        .security-notice .lock-icon {
            font-size: 18px !important;
            margin-right: 8px !important;
            vertical-align: middle !important;
        }

        .security-notice strong {
            color: #d73527 !important;
            font-size: 14px !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .security-notice p {
            margin: 8px 0 0 0 !important;
            padding: 0 !important;
            font-size: 14px !important;
            line-height: 1.5 !important;
        }

        .divider {
            height: 1px !important;
            background: #ddd !important;
            margin: 30px 0 !important;
            border: none !important;
        }

        .alternative-section {
            margin: 30px 0 !important;
            padding: 0 !important;
        }

        .alternative-link {
            background: #f8f9fa !important;
            padding: 15px !important;
            border-radius: 8px !important;
            word-break: break-all !important;
            font-family: 'Courier New', monospace !important;
            font-size: 12px !important;
            color: #666 !important;
            border: 2px dashed #ddd !important;
            margin: 15px 0 !important;
            line-height: 1.4 !important;
        }

        .footer {
            background: #2d1b69 !important;
            color: white !important;
            padding: 30px !important;
            text-align: center !important;
        }

        .company-name {
            font-size: 20px !important;
            font-weight: 600 !important;
            margin: 0 0 10px 0 !important;
            padding: 0 !important;
            line-height: 1.3 !important;
        }

        .footer p {
            opacity: 0.8 !important;
            font-size: 14px !important;
            margin: 0 0 8px 0 !important;
            padding: 0 !important;
            line-height: 1.4 !important;
        }

        .footer a {
            color: #67eea2 !important;
            text-decoration: none !important;
        }

        .footer a:hover {
            text-decoration: underline !important;
        }

        .footer .disclaimer {
            margin: 20px 0 0 0 !important;
            padding: 15px 0 0 0 !important;
            font-size: 12px !important;
            opacity: 0.6 !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
            line-height: 1.3 !important;
        }

        /* Mobile responsiveness */
        @media screen and (max-width: 600px) {
            .email-container {
                margin: 10px !important;
                border-radius: 15px !important;
            }

            .header {
                padding: 30px 20px !important;
            }

            .header h1 {
                font-size: 24px !important;
            }

            .header .subtitle {
                font-size: 14px !important;
            }

            .content {
                padding: 30px 20px !important;
            }

            .greeting {
                font-size: 16px !important;
                margin: 0 0 20px 0 !important;
            }

            .message {
                font-size: 14px !important;
                margin: 0 0 20px 0 !important;
            }

            .reset-button {
                padding: 12px 30px !important;
                font-size: 14px !important;
            }

            .button-container {
                margin: 25px 0 !important;
            }

            .expiry-info, .security-notice {
                padding: 15px !important;
                margin: 20px 0 !important;
                font-size: 13px !important;
            }

            .alternative-link {
                padding: 12px !important;
                font-size: 11px !important;
            }

            .footer {
                padding: 25px 20px !important;
            }

            .company-name {
                font-size: 18px !important;
            }
        }

        /* Outlook specific fixes */
        .outlook-fix {
            font-size: 0 !important;
            line-height: 0 !important;
            mso-line-height-rule: exactly !important;
        }
    </style>
</head>
<body>
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" class="gmail-fix">
        <tr>
            <td>
                <div class="email-container">
                    <div class="header">
                        <span class="icon">🎮</span>
                        <h1 style="color: white !important">Password Reset Request</h1>
                        <p class="subtitle">YOYO Khel - Secure Your Gaming Adventure</p>
                    </div>

                    <div class="content">
                        <div class="greeting">
                            Hello {{ $user->name }},
                        </div>

                        <div class="message">
                            We received a request to reset the password for your account associated with this email address.
                            If you made this request, please click the button below to reset your password and get back to gaming!
                        </div>

                        <div class="button-container">
                            <a href="{{ url('front-reset/' . $user->remember_token) }}" class="reset-button">
                                🔐 Reset My Password
                            </a>
                        </div>

                        <div class="expiry-info">
                            <span class="clock-icon">⏰</span>
                            This link will expire in 24 hours for security reasons.
                        </div>

                        <div class="security-notice">
                            <span class="lock-icon">🔒</span>
                            <strong>Security Notice:</strong>
                            <p>If you didn't request this password reset, please ignore this email or contact our support team if you have concerns about your account security.</p>
                        </div>

                        <div class="divider"></div>

                        <div class="alternative-section">
                            <div class="message">
                                If the button above doesn't work, you can copy and paste the following link into your browser:
                            </div>

                            <div class="alternative-link">
                                {{ url('front-reset/' . $user->remember_token) }}
                            </div>

                            <div class="message">
                                For security reasons, this link will only work once and will expire in 24 hours. If you need to reset
                                your password after this time, please request a new reset link from our login page.
                            </div>
                        </div>
                    </div>

                    <div class="footer">
                        <p class="company-name">🚀 Kalathiya Infotech</p>
                        <p>
                            Questions? Contact us at
                            <a href="mailto:kalathiyainfotech@gmail.com">kalathiyainfotech@gmail.com</a>
                        </p>
                        <p class="disclaimer">
                            This email was sent from a secure system. Please do not reply to this email.
                        </p>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
