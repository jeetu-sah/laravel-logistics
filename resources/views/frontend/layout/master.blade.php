<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Shipment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f3f6fa;
            font-family: "Inter", sans-serif;
        }

        .header-bar {
            background: #ffffff;
            padding: 15px 25px;
            border-bottom: 1px solid #e5e8ec;
            display: flex;
            align-items: center;
        }

        .header-bar img {
            height: 42px;
        }

        .page-title-area {
            padding: 25px 0 10px 0;
        }

        .search-card {
            background: #ffffff;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.07);
            max-width: 460px;
            margin: 0 auto;
        }

        .main-card {
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.07);
            padding: 25px;
            margin-bottom: 30px;
        }

        .shipment-box {
            background: #f1f5ff;
            padding: 18px;
            border-radius: 12px;
            border-left: 5px solid #0d6efd;
        }

        .progress-step {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .progress-step .circle {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #0d6efd;
        }

        .progress-step .line {
            height: 30px;
            width: 2px;
            background: #0d6efd;
            margin-left: 8px;
        }

        .timeline {
            border-left: 3px solid #0d6efd;
            margin-left: 10px;
            padding-left: 25px;
        }

        .timeline-item {
            margin-bottom: 25px;
            position: relative;
        }

        .timeline-item::before {
            content: "";
            width: 14px;
            height: 14px;
            background: #0d6efd;
            border-radius: 50%;
            position: absolute;
            left: -33px;
            top: 4px;
        }

        .info-box {
            background: #f8f9ff;
            padding: 18px;
            border-radius: 12px;
            border: 1px solid #e1e6ff;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header-bar">
        <div class="d-flex align-items-center">
            <!-- Back Button -->
            <a href="https://charlietravelscargo.com/" class="me-3 text-dark">
                <i class="bi bi-arrow-left fs-4"></i>
            </a>
            <!-- Logo + Company Name (Logo is clickable only) -->
            <div class="d-flex align-items-center">

                <!-- Only LOGO is clickable -->
                <a href="https://charlietravelscargo.com/">
                    <img src="{{ asset('charlietravelscargo/logo/logo.png') }}"
                        alt="Logo"
                        style="height:42px;">
                </a>

                <!-- Name + Tagline -->
                <div class="ms-2">
                    <span class="fw-bold" style="font-size:18px; display:block;">
                        Charlie Travels
                    </span>

                    <span class="text-muted px-2 py-1 rounded-pill shadow-sm"
                        style="font-size:12px; background:#f1f1f1;">
                        ✈ Cargo Services
                    </span>
                </div>
            </div>

        </div>
    </div>

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @yield('content')


    <footer class="mt-12">
        <!-- Full-width section -->
        <div class="py-5"
            style="background:#ffffff; border-top:1px solid #e5e8ec; border-bottom:1px solid #e5e8ec;">
            <div class="container px-4">
                <div class="row">
                    <!-- Logo + Tagline -->
                    <div class="col-md-4 mb-4 text-center text-md-start">
                        <img src="{{ asset('charlietravelscargo/logo/logo.png') }}" alt="Logo" style="height:45px;">
                        <h6 class="fw-bold mt-2" style="font-size:16px;">Charlie Travels Cargo</h6>
                        <p class="text-muted" style="font-size:14px;">
                            Safe • Fast • Reliable Cargo Delivery
                        </p>
                    </div>

                    <!-- Address -->
                    <div class="col-md-4 mb-4">
                        <h6 class="fw-bold mb-3">📍 Our Office</h6>
                        <p class="text-muted mb-1" style="font-size:14px;">
                            123, Transport Nagar<br>
                            Indore, Madhya Pradesh 452001<br>
                            India
                        </p>
                        <p class="text-muted mb-1" style="font-size:14px;">
                            📞 +91 98765 43210
                        </p>
                        <p class="text-muted" style="font-size:14px;">
                            ✉ support@charlietravelscargo.com
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-md-4 mb-4">
                        <h6 class="fw-bold mb-3">🔗 Quick Links</h6>
                        <ul class="list-unstyled" style="font-size:14px;">
                            <li class="mb-2">
                                <a href="#" class="text-muted text-decoration-none">Home</a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-muted text-decoration-none">Track Shipment</a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-muted text-decoration-none">About Us</a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-muted text-decoration-none">Contact Us</a>
                            </li>
                            <li>
                                <a href="#" class="text-muted text-decoration-none">Privacy Policy</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="text-center py-3"
            style="background:#f7f9fb; font-size:13px; color:#6c757d;">
            © 2025 <a href="https://bitnovatech.com/" target="_blank" style="color:#6c757d; text-decoration:none;">Bitnova</a>. All Rights Reserved.
        </div>
    </footer>
    <script>
        function validateBiltyNumber() {
            const input = document.getElementById('bilty-number').value.trim();
            if (input === "") {
                alert("Please enter a tracking / builty number.");
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
    </script>

</body>

</html>