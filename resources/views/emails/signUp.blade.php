<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
</head>
<body style="font-family: Arial, sans-serif; background: #f2f2f2; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 8px; text-align: center;">

        <h1>Hello {{ $employee->name }}</h1>

        <p>Welcome to our company! We're excited to have you on board.</p>

        <p>If you have any questions, feel free to reach out.</p>

        <hr style="margin: 30px 0;">

        <p style="font-size: 13px; color: #777;">
            &copy; {{ date('Y') }} All rights reserved.
        </p>
    </div>
</body>
</html>