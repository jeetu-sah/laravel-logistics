<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/15bc5dc973.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('site/style.css') }}" />
</head>

<body>
    @if (session('success'))
    <script type="text/javascript">
        // Display the success message in a JavaScript alert
        alert("{{ session('success') }}");

        // Optionally, you can add custom code to show a custom alert and hide it after 2 seconds
        setTimeout(function() {
            // Custom alert can be added here if desired, otherwise, the default alert will close after user clicks
        }, 2000); // 2000 milliseconds = 2 seconds
    </script>
    @endif

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light headerfixed" id="home-link">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('site/img/logo.png') }}" alt="" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link font20 bottom-border" aria-current="page" href="#"
                            id="home-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font20 bottom-border" aria-current="page" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font20 bottom-border" aria-current="page" href="#service">Services</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link font20 bottom-border" aria-current="page" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font20 bottom-border" aria-current="page" href="#shipment">Track Shipment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font20 bottom-border" aria-current="page" href="#career">Career</a>
                    </li>
                    <li class="franchise ">
                        <a class="nav-link font20 bottom-border" aria-current="page" target="_blank" href="{{ url('franchise') }}">Franchise</a>
                    </li>
                </ul>
                <div class="me-4">
                    <i class="fa-solid fa-headphones primarycolor font20"></i>
                    <a href="tel:+91-8840354461" class="font20 blackcolor">+91-8840354461</a>
                </div>
                <div class="me-4">
                    <button class="btn btn-warning"> <a target="_blank" href="{{ url('/login') }}"
                            class="nav-link p-0 whitecolor whitecoloritem">Login</a></button>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    @yield('main_content')

    <div class="footercolor">
        <div class="container">
            <footer class="py-5">
                <div class="row">
                    <div class="col-lg-3">
                        <h5 class="whitecolor">Address</h5>
                        <ul class="nav flex-column mt-4">
                            <li class="nav-item mb-2">
                                <div class="d-flex">
                                    <div class="mt-1">
                                        <i class="fa-solid fa-location-dot me-3 "></i>
                                    </div>

                                    <a href="" class="whitecolor whitecoloritem">Corporate Address:
                                        256 Damodar Nagar Kanpur Nagar</a>
                                </div>
                            </li>
                            <li class="nav-item mb-2">
                                <div class="d-flex">
                                    <div class="mt-1">
                                        <i class="fa-solid fa-phone me-3 "></i>
                                    </div>

                                    <span>
                                        <a href="tel: +91-8840354461"
                                            class="whitecolor whitecoloritem">+91-8840354461</a>
                                        {{-- <a href="tel: +91-7271920999"
                                            class="whitecolor whitecoloritem">+91-7271920999</a> /
                                        <a href="tel: +91-7860578111"
                                            class="whitecolor whitecoloritem">+91-7860578111</a> --}}
                                    </span>
                                </div>
                            </li>
                            <li class="nav-item mb-2">
                                <div class="d-flex ">
                                    <div>
                                        <i class="fa-regular fa-envelope me-3 "></i>
                                    </div>
                                    <a href="mailto:vikaslogistics14320@gmail.com"
                                        class="whitecolor whitecoloritem">vikaslogistics14320@gmail.com</a>
                                </div>
                            </li>

                        </ul>
                        <ul class="ps-0 d-flex gap-1 mt-3">
                            <li class="footeritem">
                                <a href=""><i class="fa-brands fa-twitter"></i></a>
                            </li>
                            <li class="footeritem">
                                <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                            </li>
                            <li class="footeritem">
                                <a href=""><i class="fa-brands fa-youtube"></i></a>
                            </li>
                            <li class="footeritem">
                                <a href=""><i class="fa-brands fa-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-2 mt-5  mt-lg-0">
                        <h5>Important Links</h5>
                        <ul class="nav flex-column mt-4">
                            <li class="nav-item mb-2 ">
                                <div class="d-flex gap-2 align-items-center">
                                    <i class="fa-solid fa-circle-arrow-right"></i>
                                    <a href="#" class="nav-link p-0 whitecolor whitecoloritem">Home</a>
                                </div>
                            </li>
                            <li class="nav-item mb-2 ">
                                <div class="d-flex gap-2 align-items-center">
                                    <i class="fa-solid fa-circle-arrow-right"></i>
                                    <a href="#" class="nav-link p-0 whitecolor whitecoloritem">About</a>
                                </div>
                            </li>
                            <li class="nav-item mb-2 ">
                                <div class="d-flex gap-2 align-items-center">
                                    <i class="fa-solid fa-circle-arrow-right"></i>
                                    <a href="#" class="nav-link p-0 whitecolor whitecoloritem">Service</a>
                                </div>
                            </li>
                            <li class="nav-item mb-2 ">
                                <div class="d-flex gap-2 align-items-center">
                                    <i class="fa-solid fa-circle-arrow-right"></i>
                                    <a href="#" class="nav-link p-0 whitecolor whitecoloritem">Contact</a>
                                </div>
                            </li>
                            <li class="nav-item mb-2 ">
                                <div class="d-flex gap-2 align-items-center">
                                    <i class="fa-solid fa-circle-arrow-right"></i>
                                    <a target="_blank" href="{{ url('/login') }}"
                                        class="nav-link p-0 whitecolor whitecoloritem">Login</a>
                                </div>
                            </li>

                        </ul>
                    </div>

                    <div class="col-lg-7 mt-5 mt-lg-0">
                        <div>
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6080913.846100792!2d72.7170415!3d25.0728932!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399c47b2bbe70b55%3A0x6ef3694e3392a949!2sChandramukhi%20Guest%20House!5e1!3m2!1sen!2sin!4v1726860901196!5m2!1sen!2sin"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="row mt-5">
                    <div class="text-center">
                        <p class="text-center">© 2024 Company, Inc. All rights reserved.</p>
                    </div>

                </div>
            </footer>
        </div>
    </div>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<script src="{{ asset('site/script.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Include jQuery (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Attach an event listener to all the "Apply Now" buttons
    document.querySelectorAll('.apply-btn').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent the default action of the link

            // Get job ID and job name from the clicked button's data attributes
            var jobId = this.getAttribute('data-job-id');
            var jobName = this.getAttribute('data-job-name');

            // Update the modal content dynamically
            var modalInfo = document.getElementById('modal-job-info');
            modalInfo.innerHTML = 'You are applying for: ' + jobName + '';
            document.getElementById('job-id').value = jobId;
        });
    });
</script>
<script>
    document.querySelectorAll('.apply-btn').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            var jobId = this.getAttribute('data-job-id');
            document.getElementById('job-id').value = jobId;
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#trackShipmentForm").on("submit", function(e) {
            e.preventDefault(); // stop normal submit
            let bilti = $("#shipmentNumber").val().trim();

            if (bilti) {
                // Redirect to another route with bilti as parameter
                window.location.href = "/track-shipment/" + encodeURIComponent(bilti);
            }
        });
    });
</script>

<script>
    $('#states').on('change', function() {
        var stateId = $(this).val();
        console.log('stateId', stateId)
        if (stateId) {
            $.ajax({
                url: "{{ url('get-districts-user') }}/" + stateId,
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#district_name').empty();
                    $('#district_name').append(
                        '<option selected disabled value="">Select District</option>');
                    $.each(data, function(key, value) {
                        $('#district_name').append('<option value="' + value.id + '">' +
                            value.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ', error);
                }
            });
        } else {
            $('#district_name').empty();
            $('#district_name').append('<option selected disabled value="">Select District</option>');
        }
    });
</script>

<script>
    $('#destionation_state').on('change', function() {
        var stateId = $(this).val();
        if (stateId) {
            $.ajax({
                url: "{{ url('get-districts-user') }}/" + stateId,
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#destination_district_name').empty();
                    $('#destination_district_name').append(
                        '<option selected disabled value="">Select District</option>');
                    $.each(data, function(key, value) {
                        $('#destination_district_name').append('<option value="' + value
                            .id + '">' +
                            value.name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ', error);
                }
            });
        } else {
            $('#destination_district_name').empty();
            $('#destination_district_name').append(
                '<option selected disabled value="">Select District</option>');
        }
    });
</script>