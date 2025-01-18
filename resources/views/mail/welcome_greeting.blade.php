
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Welcome {{$data['first_name']}} {{$data['last_name']}} To nameer graduation</title>
    <style>
        /* Inline styles for simplicity, consider using CSS classes for larger templates */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f1f1f1;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            /*max-width: 200px;*/
            height: 100px;
        }

        .message {
            padding: 20px;
            background-color: #ffffff;
        }

        .message p {
            margin-bottom: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="logo">
        <img src="https://nameer-gradutaion.com/admin/media/our-image/logo.png">
    </div>
    <div class="message">
        <p style="text-align: right;direction: rtl;">أهلاً وسهلاً بك يا {{$data['first_name']}} {{$data['last_name']}} في منصة حصر الأضرار.</p>
    </div>

</div>
</body>

</html>
