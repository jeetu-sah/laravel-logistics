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
    <main id="main">
        <section id="main-carousel">
            <div class="container-fluid">
                <div class="row">
                    <div class="col px-0">
                        <div class="carousel slide kb-carousel carousel-fade" id="carouselKenBurns"
                            data-bs-ride="carousel">
                            <!-- Carousel Items -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('site/img/What-Is-Freight-Forwarder.jpg') }}"
                                        class="d-block w-100" alt="Slide 1">
                                    {{-- <div class="carousel-caption kb-caption kb-caption-left">
                                        <h1 data-animation="animated">Ken Burns</h1>
                                        <h3 data-animation="animated">A zoom effect with CSS3</h3>
                                    </div> --}}
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('site/img/role-of-a-freight-fowarding-software-and-efficiency-michigan.jpg') }}"
                                        class="d-block w-100" alt="Slide 2">
                                    {{-- <div class="carousel-caption kb-caption kb-caption-right">
                                        <h1 data-animation="animated">Catch Your Eye</h1>
                                        <h3 data-animation="animated">It attracts the attention of customers</h3>
                                    </div> --}}
                                </div>
                                {{-- <div class="carousel-item">
                                    <img src="{{ asset('site/img/1686136310745.jpeg') }}" class="d-block w-100"
                                        alt="Slide 3">
                                    <div class="carousel-caption kb-caption kb-caption-center">
                                        <h1 data-animation="animated">Super Effect</h1>
                                        <h3 data-animation="animated">Demonstrate your benefits</h3>
                                    </div>
                                </div> --}}
                            </div>

                            <!-- Carousel Arrows -->
                            <button class="carousel-control-prev kb-control-prev" type="button"
                                data-bs-target="#carouselKenBurns" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next kb-control-next" type="button"
                                data-bs-target="#carouselKenBurns" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <style>
        .container {
            margin-top: 50px;
            margin-bottom: 50px
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0.10rem
        }

        .card-header:first-child {
            border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1)
        }

        .track {
            position: relative;
            background-color: #ddd;
            height: 7px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 60px;
            margin-top: 50px
        }

        .track .step {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            width: 25%;
            margin-top: -18px;
            text-align: center;
            position: relative
        }

        .track .step.active:before {
            background: #FF5722
        }

        .track .step::before {
            height: 7px;
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 18px
        }

        .track .step.active .icon {
            background: #ee5435;
            color: #fff
        }

        .track .icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            position: relative;
            border-radius: 100%;
            background: #ddd
        }

        .track .step.active .text {
            font-weight: 400;
            color: #000
        }

        .track .text {
            display: block;
            margin-top: 7px
        }

        .itemside {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 100%
        }

        .itemside .aside {
            position: relative;
            -ms-flex-negative: 0;
            flex-shrink: 0
        }

        .img-sm {
            width: 80px;
            height: 80px;
            padding: 7px
        }

        ul.row,
        ul.row-sm {
            list-style: none;
            padding: 0
        }

        .itemside .info {
            padding-left: 15px;
            padding-right: 7px
        }

        .itemside .title {
            display: block;
            margin-bottom: 5px;
            color: #212529
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        .btn-warning {
            color: #ffffff;
            background-color: #ee5435;
            border-color: #ee5435;
            border-radius: 1px
        }

        .btn-warning:hover {
            color: #ffffff;
            background-color: #ff2b00;
            border-color: #ff2b00;
            border-radius: 1px
        }
    </style>
    <div class="container">
        <div class="row mt-lg-3 margintop" id="shipment-head">
            <div>
                <p class="color font30 text-center fw-bold">Track your Shipment</p>
            </div>
        </div>
        
        <div class="row margintop" id="shipment">
            <article class="card">
                <div class="card-header"> My Orders / Tracking<br> <input type="Search.." class="card-header col-md-2" placeholder=" Shipment Number"> <button class="btn btn-primary">Track</button></div>
                
                <div class="card-body">
                    <h6>Order ID: OD45345345435</h6>
                    <article class="card">
                        <div class="card-body row">
                            <div class="col"> <strong>Estimated Delivery time:</strong> <br>29 nov 2019 </div>
                            <div class="col"> <strong>Shipping BY:</strong> <br> Vikas Logistic, | <i
                                    class="fa fa-phone"></i>
                                +91-8840354461 </div>
                            <div class="col"> <strong>Status:</strong> <br> Picked by the courier </div>
                            <div class="col"> <strong>Tracking #:</strong> <br> BD045903594059 </div>
                        </div>
                    </article>
                    <div class="track">
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text">Order Booked</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span
                                class="text">Dispatch</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span
                                class="text"> On the way </span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span
                                class="text">Ready for delivery</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                                class="text"> Delivered</span> </div>
                    </div>
                    <hr>


                </div>
            </article>
        </div>
    </div>
    <div class="row margintop" id="about">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12 ">
            <div class="left-about padding10">
                <img src="{{ asset('site/img/about-img.jpg') }}" alt=""
                    class="img-fluid animateimge targetimge">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12 p-lg-5 ">
            <div class="about-right padding10">
                <div>
                    <h6 class="mt-lg-3 fw-bold primarycolor">About Us</h6>
                    <p class="blackcolor font30 width75 fw-bold">Quick Transport and Logistics Solutions</p>
                    <p class="lightblack">
                        At Vikas Logistics, we specialize in providing quick, reliable, and efficient transport and
                        logistics solutions tailored to your needs. With a commitment to excellence, we ensure seamless
                        movement of goods across air, sea, road, and rail, backed by our expertise in customs clearance
                        and warehousing. Your trust drives our journey toward delivering success, one shipment at a
                        time. 🚛🌍📦</p>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-6 col-md-6">
                        <div>
                            <i class="fa-solid fa-globe globe"></i>
                            <div class="mt-3">
                                <h5>Global Coverage</h5>
                                <p class="lightblack">Vikas Logistics ensures seamless transportation and logistics
                                    solutions across the globe. With our extensive network and expertise, we connect
                                    businesses to international markets efficiently and reliably. 🌍✈️🚢</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <i class="fa-solid fa-truck-fast globe"></i>
                        <div class="mt-3">
                            <h5>Pan-India Coverage</h5>
                            <p class="lightblack">Vikas Logistics proudly serves all corners of India, offering
                                seamless transportation and logistics solutions across the country. No matter where you
                                are, we ensure your goods reach their destination efficiently and on time. 🇮🇳🚛📦</p>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="./index.html" class="explore-more">Explore More</a>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row margintop">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div>
                    <div>
                        <h6 class="mt-3 fw-bold primarycolor">Some Facts</h6>
                        <p class="blackcolor font30  fw-bold">#1 Place To Manage All Of Your Shipments</p>
                        <p class="lightblack">
                            Vikas Logistics is the ultimate destination for managing all your shipments, providing a
                            seamless and efficient experience from start to finish. Whether you're shipping locally or
                            internationally, our advanced tracking systems and reliable services give you complete
                            control over your shipments. Our platform ensures transparency, real-time updates, and
                            smooth coordination for every stage of the process. Trust Vikas Logistics to handle your
                            logistics needs with precision and care, ensuring your goods arrive on time and in perfect
                            condition. 📦🚚🌍</p>
                    </div>
                    <div class="d-flex gap-5">
                        <div class="headphone"><i class="fa-solid fa-headphones "></i></div>
                        <div class="contact-headphone">
                            <p class="fw-bold">Call for any query!</p>
                            <h5 class="primarycolor fw-bold">+91 8840354461</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mt-5 mt-lg-0">
                <div class="row mt-md-5">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="client-box">
                            <i class="fa-solid fa-users"></i>
                            <p class="mt-4 fw-bold " id="counter">2,00,000</p>
                            <h5>Happy Clients</h5>
                        </div>
                        <div class="client-box mt-4 bg-info">
                            <i class="fa-solid fa-ship"></i>
                            <p class="mt-4 fw-bold " id="counter1">0</p>
                            <h5>Complete Shipments</h5>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 right-client ">
                        <div class="client-box mt-4 bg-success">
                            <i class="fa-solid fa-star"></i>
                            <p class="mt-4 fw-bold " id="counter2">0</p>
                            <h5>Customer Reviews</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-lg-3 margintop" id="service">
            <div>
                <h6 class="mt-3 fw-bold primarycolor text-center">Our Services</h6>
                <p class="blackcolor font30 text-center fw-bold">Explore Our Services</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mt-md-4 col-sm-12">
                <div class="p-3 our-service">
                    <div>
                        <div class="box-overflow">
                            <img src="{{ asset('site/img/air.jpg') }}" alt="" class="img-fluid">
                        </div>

                        <p class="air-freight">Air Freight</p>
                        <p class="lightblack">Air Freight ensures fast and reliable transportation of goods across
                            global destinations, offering efficient solutions for time-sensitive shipments. 🌍✈️
                        </p>
                        <div class="read-more">
                            <a href="#"><i class="fa-solid fa-arrow-right"></i><span>Read More</span></a>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-6 mt-md-4 col-sm-12">
                <div class="p-3 our-service">
                    <div>
                        <div class="box-overflow">
                            <img src="{{ asset('site/img/ocean.jpg') }}" alt="" class="img-fluid">
                        </div>

                        <p class="air-freight">Ocean Freight</p>
                        <p class="lightblack">Ocean Freight offers cost-effective and reliable solutions for
                            transporting goods in bulk across international waters. 🚢🌊
                        </p>
                        <div class="read-more">
                            <a href="#"><i class="fa-solid fa-arrow-right"></i><span>Read More</span></a>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-6 mt-md-4 col-sm-12">
                <div class="p-3 our-service">
                    <div>
                        <div class="box-overflow">
                            <img src="{{ asset('site/img/road-freeight-1.jpg') }}" alt="" class="img-fluid">
                        </div>

                        <p class="air-freight">Road Freight</p>
                        <p class="lightblack">Road Freight ensures flexible and efficient transportation of goods over
                            short and long distances with door-to-door service. 🚛🛣️
                        </p>
                        <div class="read-more">
                            <a href="#"><i class="fa-solid fa-arrow-right"></i><span>Read More</span></a>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-lg-4 col-md-6 mt-md-4 col-sm-12">
                <div class="p-3 our-service">
                    <div>
                        <div class="box-overflow">
                            <img src="{{ asset('site/img/transportation_research_board_1.jpg') }}" alt=""
                                class="img-fluid">
                        </div>

                        <p class="air-freight">Train Freight</p>
                        <p class="lightblack">Train Freight offers reliable and eco-friendly transportation for heavy
                            and bulk goods across vast distances. 🚂📦
                        </p>
                        <div class="read-more">
                            <a href="#"><i class="fa-solid fa-arrow-right"></i><span>Read More</span></a>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-6 mt-md-4 col-sm-12">
                <div class="p-3 our-service">
                    <div>
                        <div class="box-overflow">
                            <img src="{{ asset('site/img/Custom-Clearance-Container-1.jpg') }}" alt=""
                                class="img-fluid">
                        </div>

                        <p class="air-freight">Customs Clearance</p>
                        <p class="lightblack">Customs Clearance ensures smooth processing of import and export goods by
                            handling all legal and regulatory requirements. 🛃📑
                        </p>
                        <div class="read-more">
                            <a href="#"><i class="fa-solid fa-arrow-right"></i><span>Read More</span></a>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-6 mt-md-4 col-sm-12">
                <div class="p-3 our-service">
                    <div>
                        <div class="box-overflow">
                            <img src="{{ asset('site/img/Warehousing.jpeg') }}" alt="" class="img-fluid">
                        </div>

                        <p class="air-freight">Warehouse Solutions</p>
                        <p class="lightblack">Warehouse Solutions provide secure storage, efficient inventory
                            management, and streamlined distribution for your goods. 🏢📦
                        </p>
                        <div class="read-more">
                            <a href="#"><i class="fa-solid fa-arrow-right"></i><span>Read More</span></a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="row   margintop">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div>
                    <h6 class="mt-3 fw-bold primarycolor">Our Features</h6>
                    <p class="blackcolor font30  fw-bold">At Vikas Logistics, we offer a range of features designed to
                        streamline your shipping experience:</p>
                    <div>
                        <div class="our-features mt-5">
                            <div>
                                <p style="font-size:30px;"> 📍</p>
                            </div>
                            <div>
                                <h6>End-to-End Tracking</h6>
                                <p class="lightblack">Stay updated with real-time tracking of your shipments, ensuring
                                    complete transparency and control. </p>
                            </div>


                        </div>
                        <div class="our-features mt-5">
                            <div>
                                <p style="font-size:30px;">⏰</p>
                            </div>
                            <div>
                                <h6>Timely Deliveries: </h6>
                                <p class="lightblack">We prioritize punctuality, ensuring your goods reach their
                                    destination on time, every time. </p>
                            </div>


                        </div>
                        <div class="our-features mt-5">
                            <div>
                                <p style="font-size:30px;">🇮🇳</p>
                            </div>
                            <div>
                                <h6>Nationwide Coverage:</h6>
                                <p class="lightblack">From north to south, east to west, we offer logistics solutions
                                    across India, making your business operations smoother.</p>
                            </div>


                        </div>

                        <div class="our-features mt-5">
                            <div>
                                <p style="font-size:30px;">🏢</p>
                            </div>
                            <div>
                                <h6>Warehousing Solutions:</h6>
                                <p class="lightblack">Secure and efficient storage solutions, with proper inventory
                                    management and easy access to goods. </p>
                            </div>


                        </div>
                        <div class="our-features mt-5">
                            <div>
                                <p style="font-size:30px;">🚛</p>
                            </div>
                            <div>
                                <h6>Flexible Transport Options: </h6>
                                <p class="lightblack">Air, sea, road, or rail—choose the mode of transport that suits
                                    your needs and budget. </p>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 dnone">
                <div class="mt-4">
                    <img src="{{ asset('site/img/image2.jpg') }}" alt="" class="img-fluid">
                </div>
            </div>

        </div>
        <div class="row mt-5" id="contact">
            <div class="col-lg-5 col-md-12 col-sm-12 mt-5">
                <div>
                    <h6 class="mt-3 fw-bold primarycolor">Get A Quote</h6>

                    <p class="lightblack mt-4">Looking for reliable and efficient logistics solutions? Request a free
                        quote today! Simply fill out the form with your shipment details, and our team at Vikas
                        Logistics will provide you with a customized, competitive quote tailored to your needs. Let us
                        help you streamline your logistics with transparent pricing and exceptional service. 📦✈️🚚
                    </p>

                </div>
                <div>
                    <h6 class="mt-3 fw-bold primarycolor">Request A Free Quote!</h6>

                    <p class="lightblack mt-4">Looking for reliable and efficient logistics solutions? Request a free
                        quote today! Simply fill out the form with your shipment details, and our team at Vikas
                        Logistics will provide you with a customized, competitive quote tailored to your needs. Let us
                        help you streamline your logistics with transparent pricing and exceptional service. 📦✈️🚚
                    </p>
                    <div class="d-flex gap-5">
                        <div class="headphone"><i class="fa-solid fa-headphones " aria-hidden="true"></i></div>
                        <div class="contact-headphone">
                            <p class="fw-bold">Call for any query!</p>
                            <h5 class="primarycolor fw-bold">+91 8840354461</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12 mt-5">
                <div class="p-5 bgcontact">
                    <form action="{{ url('inquiry') }}" method="post">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control border-0 inpstyle" name="name"
                                    placeholder="Your Name" required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="email" class="form-control border-0 inpstyle" name="email"
                                    placeholder="Your Email" required>
                            </div>
                            <div class="col-12 col-sm-12">
                                <input type="text" class="form-control border-0 inpstyle" name="mobile"
                                    placeholder="Your Mobile" required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="states" class="form-label">State (Origin)</label>
                                <select class="form-select border-0 inpstyle " id="states" name="states">

                                    <option value="">Select State</option>
                                    @foreach ($state as $states)
                                        <option value="{{ $states->id }}">{{ $states->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="district_name" class="form-label">City (Origin)</label>
                                <select class="form-select border-0 inpstyle" name="district" id="district_name"
                                    required>
                                    <option selected disabled value="">Select State First</option>
                                    <!-- Add cities here -->
                                </select>
                                <div class="invalid-feedback">Select City</div>
                                @error('district_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="destionation_state" class="form-label">State (Destination) </label>
                                <select class="form-select border-0 inpstyle " id="destionation_state"
                                    name="destionation_state">

                                    <option value="">Select State</option>
                                    @foreach ($state as $states)
                                        <option value="{{ $states->id }}">{{ $states->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="destination_district_name" class="form-label">City (Destination)</label>
                                <select class="form-select border-0 inpstyle" name="destination_district_name"
                                    id="destination_district_name" required>
                                    <option selected disabled value="">Select State First</option>
                                    <!-- Add cities here -->
                                </select>
                                <div class="invalid-feedback">Select City</div>
                                @error('destination_district_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <textarea class="form-control border-0 inpstyle" name="description" placeholder="What would you like to know?"
                                    required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn  w-100 py-3 submitbtn">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="row mt-lg-3">
            <div>
                <h6 class="mt-3 fw-bold primarycolor text-center">Our Team</h6>
                <p class="blackcolor font30 text-center fw-bold">Expert Team Members</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 mt-5 col-sm-12">
                <div class="p-3 our-service">
                    <div>
                        <div class="box-overflow">
                            <img src="{{ asset('site/img/employee-images/aman.jpg') }}" alt=""
                                class="img-fluid">
                        </div>

                        <p class="air-freight">Aman</p>
                        {{-- <p class="lightblack">Designation.</p> --}}
                        {{-- <div class="read-more">
                            <div class="share">
                                <i class="fa-solid fa-share" aria-hidden="true"></i>
                                <span class="d-flex">
                                    <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                                    <a href=""><i class="fa-brands fa-twitter"></i></a>
                                    <a href=""><i class="fa-brands fa-instagram"></i></a>
                                </span>
                            </div>
                        </div> --}}

                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-5 col-sm-12">
                <div class="p-3 our-service">
                    <div>
                        <div class="box-overflow">
                            <img src="{{ asset('site/img/employee-images/aniketsoni.jpg') }}" alt=""
                                class="img-fluid">
                        </div>

                        <p class="air-freight">Aniket Soni</p>
                        {{-- <p class="lightblack">Designation.</p> --}}
                        {{-- <div class="read-more">
                            <div class="share">
                                <i class="fa-solid fa-share" aria-hidden="true"></i>
                                <span class="d-flex">
                                    <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                                    <a href=""><i class="fa-brands fa-twitter"></i></a>
                                    <a href=""><i class="fa-brands fa-instagram"></i></a>
                                </span>
                            </div>
                        </div> --}}

                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-5 col-sm-12">
                <div class="p-3 our-service">
                    <div>
                        <div class="box-overflow">
                            <img src="{{ asset('site/img/employee-images/asrafali.jpg') }}" alt=""
                                class="img-fluid">
                        </div>

                        <p class="air-freight">Asraf ali</p>
                        {{-- <p class="lightblack">Designation.</p> --}}
                        <div class="read-more">
                            {{-- <div class="share">
                                <i class="fa-solid fa-share" aria-hidden="true"></i>
                                <span class="d-flex">
                                    <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                                    <a href=""><i class="fa-brands fa-twitter"></i></a>
                                    <a href=""><i class="fa-brands fa-instagram"></i></a>
                                </span>
                            </div> --}}
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-5 col-sm-12">
                <div class="p-3 our-service">
                    <div>
                        <div class="box-overflow">
                            <img src="{{ asset('site/img/employee-images/kaptan.jpg') }}" alt=""
                                class="img-fluid">
                        </div>

                        <p class="air-freight">Kaptan</p>
                        {{-- <p class="lightblack">Designation.</p> --}}
                        <div class="read-more">
                            {{-- <div class="share">
                                <i class="fa-solid fa-share" aria-hidden="true"></i>
                                <span class="d-flex">
                                    <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                                    <a href=""><i class="fa-brands fa-twitter"></i></a>
                                    <a href=""><i class="fa-brands fa-instagram"></i></a>
                                </span>
                            </div> --}}
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-5 col-sm-12">
                <div class="p-3 our-service">
                    <div>
                        <div class="box-overflow">
                            <img src="{{ asset('site/img/employee-images/pintusingh.jpg') }}" alt=""
                                class="img-fluid">
                        </div>

                        <p class="air-freight">Pintu Singh</p>
                        {{-- <p class="lightblack">Designation.</p> --}}
                        <div class="read-more">
                            {{-- <div class="share">
                                <i class="fa-solid fa-share" aria-hidden="true"></i>
                                <span class="d-flex">
                                    <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                                    <a href=""><i class="fa-brands fa-twitter"></i></a>
                                    <a href=""><i class="fa-brands fa-instagram"></i></a>
                                </span>
                            </div> --}}
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-lg-3 col-md-6 mt-5 col-sm-12">
                <div class="p-3 our-service">
                    <div>
                        <div class="box-overflow">
                            <img src="{{ asset('site/img/employee-images/unknown.jpg') }}" alt=""
                                class="img-fluid">
                        </div>

                        <p class="air-freight">Full Name</p>
                        {{-- <p class="lightblack">Designation.</p> --}}
                        <div class="read-more">
                            {{-- <div class="share">
                                <i class="fa-solid fa-share" aria-hidden="true"></i>
                                <span class="d-flex">
                                    <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                                    <a href=""><i class="fa-brands fa-twitter"></i></a>
                                    <a href=""><i class="fa-brands fa-instagram"></i></a>
                                </span>
                            </div> --}}
                        </div>

                    </div>

                </div>
            </div>
        </div>
        {{-- <div class="row mt-5">
            <div>
                <div>
                    <h6 class="mt-3 fw-bold primarycolor text-center">Testimonial</h6>
                    <p class="blackcolor font30 text-center fw-bold">Our Clients Say!</p>
                </div>
                <div>
                    <div class="content-wrapper">
                        <div class="wrapper-for-arrows">
                            <div style="opacity: 0;" class="chicken"></div>
                            <div id="reviewWrap" class="review-wrap">
                                <div id="imgDiv" class="">
                                </div>
                                <div id="personName"></div>
                                <div id="profession"></div>
                                <div id="description">
                                </div>
                            </div>

                            <div class="left-arrow-wrap arrow-wrap">
                                <div class="arrow" id="leftArrow"></div>
                            </div>
                            <div class="right-arrow-wrap arrow-wrap">
                                <div class="arrow" id="rightArrow"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div> --}}
    </div>
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
                    {{-- 
                    <div class="col-lg-3 mt-5  mt-lg-0">
                        <form>
                            <h5 class="textcenter">Newsletter</h5>
                            <p class="textcenter">Dolor amet sit justo amet elitr clita ipsum elitr est. </p>
                            <div class="w-100 gap-2">
                                <input id="newsletter1" type="text" class="form-control"
                                    placeholder="Email address" required><br>
                                <button class="btn bgprimarycolor w-100 btnsubscribe"
                                    type="button">Subscribe</button>
                            </div>
                        </form>
                    </div> --}}
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
<script>
    $('#states').on('change', function() {
        var stateId = $(this).val();
        if (stateId) {
            $.ajax({
                url: '{{ url('get-districts-user') }}/' + stateId,
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
                url: '{{ url('get-districts-user') }}/' + stateId,
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
