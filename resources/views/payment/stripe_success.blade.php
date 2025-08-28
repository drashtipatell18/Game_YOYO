<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <!-- Font Awesome for icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .success-container {
            background: #fff;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
            border-bottom: 5px solid #28a745;
            text-align: center;
            max-width: 500px;
            width: 90%;
        }

        .success-container i {
            font-size: 60px;
            color: #28a745;
            margin-bottom: 20px;
        }

        .success-container h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 15px;
        }

        .success-container p {
            font-size: 18px;
            color: #555;
        }

        @media screen and (max-width: 600px) {
            .success-container {
                padding: 30px 20px;
            }

            .success-container h2 {
                font-size: 26px;
            }

            .success-container p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="success-container">
        <i class="fas fa-check-circle"></i>
        <h2>Your payment was successful</h2>
        <p>Thank you for your payment. We will be in contact with more details shortly.</p>
    </div>
</body>
</html>
