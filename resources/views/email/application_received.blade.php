<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Job Application</title>
</head>

<body>
    <h2>New Job Application Received</h2>
    <p><strong>Job ID:</strong> {{ $application->job_id }}</p>
    <p><strong>Full Name:</strong> {{ $application->full_name }}</p>
    <p><strong>Email:</strong> {{ $application->email }}</p>
    <p><strong>Mobile:</strong> {{ $application->mobile }}</p>
    <p><strong>Address:</strong> {{ $application->address }}</p>
    <p><strong>Gender:</strong> {{ ucfirst($application->gender) }}</p>
    <p><strong>Why should we hire you?</strong> {{ $application->why_hire }}</p>
    <p><strong>Resume:</strong> <a href="{{ asset('storage/app/' . $application->resume) }}">Download Resume</a></p>
</body>

</html>
