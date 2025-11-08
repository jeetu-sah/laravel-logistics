@extends('masterLayout.master')
@section('main_content')
<main id="main">
    <div class="container-fluid">
        <div class="row">
            <video src="{{ asset('assets/videos/vikaslogisticsfinal.mp4') }}" width="100%" height="10%" autoplay loop muted></video>
        </div>
    </div>
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
<div class="container my-5">
    <!-- Title -->
    <div class="text-center mb-4">
        <h2 class="fw-bold text-success">Track Your Shipment</h2>
        <p class="text-muted">Enter your Bilti Number to check the delivery status</p>
    </div>
    <!-- Tracking Form -->
    <div class="card shadow-lg border-0 rounded-4 p-4 mb-4">
        <form id="trackShipmentForm" method="post">
            @csrf
            <div class="row g-3 justify-content-center">
                <div class="col-md-6">
                    <input type="text" id="shipmentNumber" class="form-control form-control-lg"
                        placeholder="Enter Bilti Number" required>
                </div>
                <div class="col-md-3 text-center">
                    <button type="submit" class="btn btn-warning btn-lg w-100 fw-bold">Track</button>
                </div>
            </div>
        </form>
        <p id="message" class="text-danger mt-2 text-center"></p>
    </div>

    <!-- Shipment Info -->
    <div class="card shadow-sm border-0 rounded-4 p-4">
        <div class="card-body">
            <div class="mb-4">
                <strong>Shipping By:</strong>
                <span class="text-success fw-semibold">Vikas Logistic</span> |
                <i class="fa fa-phone text-primary"></i>
                <a href="tel:+918840354461" class="text-decoration-none text-dark">+91-8840354461</a>
            </div>

            <!-- Progress Tracker -->
            <div class="track d-flex justify-content-between text-center">
                <div class="step" id="step1">
                    <span class="icon"><i class="fa fa-file-alt"></i></span>
                    <span class="text">Order Booked</span>
                </div>
                <div class="step" id="step2">
                    <span class="icon"><i class="fa fa-user"></i></span>
                    <span class="text">Dispatch</span>
                </div>
                <div class="step" id="step3">
                    <span class="icon"><i class="fa fa-truck"></i></span>
                    <span class="text">On the Way</span>
                </div>
                <div class="step" id="step4">
                    <span class="icon"><i class="fa fa-box"></i></span>
                    <span class="text">Ready for Delivery</span>
                </div>
                <div class="step" id="step5">
                    <span class="icon"><i class="fa fa-check-circle"></i></span>
                    <span class="text">Delivered</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-5">
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


    <!-- <div class="row mt-lg-3">
                <div>
                    <h6 class="mt-3 fw-bold primarycolor text-center">Our Team</h6>
                    <p class="blackcolor font30 text-center fw-bold">Expert Team Members</p>
                </div>
            </div> -->
    <!-- <div class="row">
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
            </div> -->
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
<div class="container" id="career">


    <style>
        .card-title,
        .job-status {
            display: inline-block;
            margin-right: 10px;
            /* optional spacing */
        }

        .job-card {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            transition: transform 0.3s ease-in-out;
        }

        .job-card:hover {
            transform: translateY(-10px);
        }

        .apply-btn {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 1rem;
            display: inline-block;
        }

        .apply-btn:hover {
            background-color: #0056b3;
            text-decoration: none;
        }

        .job-status {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .open-status {
            background-color: #28a745;
            color: white;
        }

        .closed-status {
            background-color: #dc3545;
            color: white;
        }

        .disabled-btn {
            background-color: #d6d6d6;
            cursor: not-allowed;
        }
    </style>
    <div class="container mt-5">
        <header class="text-center mb-5">
            <h1>Join Our Team Now</h1>
        </header>

        <div class="row">
            <!-- Job Card 1 -->
            @foreach ($careers as $career)
            <div class="col-md-12 mb-4">
                <div class="card job-card">
                    <div class="card-body">
                        <div style="display: flex; align-items: center;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <p style="color: #fd8f2a; font-size: 22px;" class="card-title">
                                    {{ $career->name }}
                                </p>

                                <span class="job-status open-status"
                                    style="margin-left:1000px;">{{ $career->status }}</span>
                            </div>

                        </div>

                        <p class=" mt-2">
                            Required Candidate - @if ($career->staff_type == 'both')
                            Male / Female
                            @elseif ($career->staff_type == 'male')
                            Male
                            @elseif ($career->staff_type == 'female')
                            Female
                            @else
                            {{ $career->staff_type }}
                            @endif
                            <br>Openings: {{ $career->post }}
                            <br> <br>
                            <i class="fas fa-map-marker-alt"></i> {{ $career->location }}<br>
                            ₹ {{ $career->salary }}
                        </p>
                        <p class="">
                            {{ $career->description }}
                        </p>
                        <!-- Button to trigger the modal -->
                        <a href="#" class="apply-btn" data-bs-toggle="modal"
                            data-bs-target="#applyModal" data-job-id="{{ $career->id }}"
                            data-job-name="{{ $career->name }}">Apply Now</a>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Modal Structure -->
        <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyModalLabel">Apply for Job</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Dynamic content for Job Name or ID -->
                        <p id="modal-job-info"></p>
                        <form action="{{ route('applications.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="job-id" name="job_id" value="" />

                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name"
                                    placeholder="Full Name" name="full_name" required>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="tel" class="form-label">Mobile</label>
                                        <input type="tel" class="form-control" placeholder="Mobile"
                                            id="tel" name="mobile" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" placeholder="Email"
                                            id="email" name="email" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" placeholder="Address"
                                            id="address" name="address" required>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-control" name="gender" id="gender">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="why_hire" class="form-label">Why should we hire you?</label>
                                <textarea id="why_hire" name="why_hire" placeholder="Describe in 100 characters" class="form-control" required></textarea>
                                <small id="charCount" class="form-text text-muted">Character Count: 0/100</small>
                            </div>

                            <script>
                                const textarea = document.getElementById('why_hire');
                                const charCountDisplay = document.getElementById('charCount');

                                textarea.addEventListener('input', function() {
                                    let charCount = textarea.value.length;
                                    charCountDisplay.textContent = `Character Count: ${charCount}/100`;

                                    // Prevent exceeding 100 characters
                                    if (charCount > 100) {
                                        textarea.value = textarea.value.substring(0, 100); // Trim to 100 characters
                                        charCountDisplay.textContent = `Character Count: 100/100`;
                                        charCountDisplay.style.color = 'red';
                                    } else {
                                        charCountDisplay.style.color = 'green';
                                    }
                                });
                            </script>


                            <div class="mb-3">
                                <label for="file" class="form-label">Resume</label>
                                <input type="file" class="form-control" id="file" name="resume"
                                    required>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

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

</div>
@endsection