<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <p>Hello,</p>
    
    <p>We received a request to reset your password. If you didn't make this request, you can ignore this email.</p>
    
    <p>To reset your password, click on the following link:</p>
    
    <a href = "{{route('showResetPassword', $token)}}">Reset Password</a>
        
    <p>If you have any issues, copy and paste the link into your browser's address bar.</p>
    
    <p>Thank you!</p>
</body>
</html>

