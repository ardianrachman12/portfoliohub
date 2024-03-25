<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Maintenance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #3b1d5e, #191f4d);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .maintenance-wrapper {
            text-align: center;
        }

        .maintenance-content h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .maintenance-content p {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid #ccc;
            border-top-color: #333;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-top: 30px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div class="maintenance-wrapper">
        <div class="maintenance-content">
            <h1>Website Under Maintenance</h1>
            <p>We apologize for the inconvenience. Our website is currently undergoing scheduled maintenance.</p>
            <p>Please check back later.</p>
        </div>
    </div>
    <div class="spinner"></div>
</body>

</html>
