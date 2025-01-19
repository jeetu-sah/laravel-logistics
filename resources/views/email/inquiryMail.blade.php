<!DOCTYPE html>
<html>
<head>
    <title>Thank You for Your Inquiry</title>
</head>
<body>
    <h1>Thank You, {{ $name }}</h1>
    <p>We have received your inquiry. Here are the details:</p>
    <ul>
        <li><strong>Name:</strong> {{ $name }}</li>
        <li><strong>Email:</strong> {{ $email }}</li>
        <li><strong>Message:</strong> {{ $message }}</li>
    </ul>
</body>
</html>
