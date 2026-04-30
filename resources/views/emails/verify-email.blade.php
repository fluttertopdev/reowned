<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Welcome to {{setting('name')}}</h2>

    <p>Hello {{ $name }},</p>

    <p>Click the button below to verify your account:</p>

    <a href="{{ $verificationLink }}"
       style="padding:10px 20px;background:#000;color:#fff;text-decoration:none;">
        Verify Email
    </a>

    <p>This link will expire in 24 hours.</p>
</body>
</html>