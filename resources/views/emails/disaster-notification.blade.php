<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>{{ $emailSubject }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            direction: rtl;
        }
        .header {
            background-color: #009ef7;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="header">
    <h2>{{ $emailSubject }}</h2>
</div>

<div class="content">
    {!! nl2br(e($emailContent)) !!}
</div>

<div class="footer">
    <p>هذا البريد الإلكتروني تم إرساله من نظام إدارة المتضررين</p>
</div>
</body>
</html>