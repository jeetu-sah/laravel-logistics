<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
    <script>
        // Automatically open the URL in a new tab when the page loads
        window.onload = function () {
            const url = "{{ $url }}"; // Pass the URL safely
            window.open(url, "_blank"); // Open the URL in a new tab
        };
    </script>
</head>

<body>
    <p>Redirecting to booking details... If the page does not open, <a href="{{ $url }}" target="_blank">click here</a>.</p>
</body>

</html>
