<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
    <script type="text/javascript">
        // Open the URL in a new window
        window.open("{{ $redirectUrl }}", "_blank");

        // Optionally, redirect the current window to another page
        window.location.href = "{{ route('admin.booking.redirect') }}"; // Replace 'home' with your desired route
    </script>
</head>
<body>
    <p>Redirecting...</p>
</body>
</html>