<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Cancelled</title>
    <!-- Font Awesome for icons -->
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

        .cancel-container {
            background: #fff;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
            border-bottom: 5px solid #dc3545;
            text-align: center;
            max-width: 500px;
            width: 90%;
        }

        .cancel-container i {
            font-size: 60px;
            color: #dc3545;
            margin-bottom: 20px;
        }

        .cancel-container h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 15px;
        }

        .cancel-container p {
            font-size: 18px;
            color: #555;
        }

        @media screen and (max-width: 600px) {
            .cancel-container {
                padding: 30px 20px;
            }

            .cancel-container h2 {
                font-size: 26px;
            }

            .cancel-container p {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="cancel-container">
        <div class="message-box cancel">
            <i class="fa fa-times-circle" aria-hidden="true"></i>
            <h2>Payment Cancelled</h2>
            <p>Your payment was not completed. Please try again or contact support if the issue persists.</p> 
        </div> 
    </div>
</body>
</html>
