<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h2>{{ __('lang.website.forgot_password') }} - {{ setting('name') }}</h2>

    <p>{{ __('lang.website.hello') }} {{ $name }},</p>

    <p>{{ $customMessage }}</p>

    <p>
        <strong>{{ __('lang.website.your_otp') }}:</strong> {{ $otp }}
    </p>

</body>
</html>