@extends('frontend.layout.master')
@section('content')
<div class="container mt-4">

    <!-- Back Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Page Heading on Left -->
        <h3 class="fw-bold mb-0">Where’s My Package?</h3>
        <!-- Back Button on Right -->
        <a href="{{ url()->previous() }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>
    <!-- Shipment Summary Card -->
    <div class="main-card">
        <h5 class="fw-semibold mb-2">Shipment Summary</h5>

        <div class="shipment-box mb-3">
            <div class="d-flex justify-content-between">
                <div>
                    <h6 class="fw-bold mb-1">Tracking Number: <span class="text-primary">{{$biltyNumber}}</span></h6>
                    <h6 class="fw-bold mb-1">Customer: <span class="text-primary">{{ $booking->consignee_name }}</span></h6>
                    <div class="text-muted">Courier: Charlie Travels Cargo</div>
                    <div class="text-muted">Contact: +91 95994 12941</div>
                </div>

                <span class="badge bg-primary p-2" style="height: 30px;">In Transit</span>
            </div>
        </div>

        <!-- Progress Steps -->
        <h6 class="fw-bold mt-5">Shipment Progress</h6>
        <hr>
        <!-- Detailed Timeline -->
        <h6 class="fw-bold">Detailed Timeline</h6>

        <div class="timeline mt-5">
            @foreach($steps as $step)
            <div class="timeline-item">
                <h6 class="fw-bold mb-1">{{$step['branchName'] ?? '--'}}</h6>
                <small class="text-muted">
                    {{$step['name'] ?? '--'}} • {{$step['status'] ?? '--'}} <br>
                    <span class="text-muted">
                        @if(!empty($step['dispatched_at']))
                        {{$step['dispatched_at'] ?? '--'}}
                        @endif
                        @if(!empty($step['received_at']))
                        {{$step['received_at'] ?? '--'}}
                        @endif
                    </span>
                </small>
            </div>
            @endforeach
        </div>


        <!-- <div class="timeline">
            <div class="timeline-item">
                <h6 class="fw-bold">Out for Delivery</h6>
                <small class="text-muted">Today • 10:25 AM</small>
            </div>

            <div class="timeline-item">
                <h6 class="fw-bold">In Transit</h6>
                <small class="text-muted">Yesterday • 5:45 PM</small>
            </div>

            <div class="timeline-item">
                <h6 class="fw-bold">Dispatched from Warehouse</h6>
                <small class="text-muted">2 Days Ago • 3:00 PM</small>
            </div>
            <div class="timeline-item">
                <h6 class="fw-bold">Order Confirmed</h6>
                <small class="text-muted">3 Days Ago • 11:20 AM</small>
            </div>
        </div> -->
        <hr>

        <!-- More Shipment Info -->
        <!-- <h6 class="fw-bold mb-3">Additional Information</h6>

        <div class="row g-3">
            <div class="col-md-4">
                <div class="info-box">
                    <i class="bi bi-box-seam fs-4 text-primary"></i>
                    <h6 class="fw-bold mt-2">Package Weight</h6>
                    <div class="text-muted">1.2 KG</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box">
                    <i class="bi bi-geo-alt fs-4 text-danger"></i>
                    <h6 class="fw-bold mt-2">Destination</h6>
                    <div class="text-muted">Bhopal, MP</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-box">
                    <i class="bi bi-calendar-check fs-4 text-success"></i>
                    <h6 class="fw-bold mt-2">Estimated Delivery</h6>
                    <div class="text-muted">23 Nov 2025</div>
                </div>
            </div>
        </div> -->

    </div>
</div>
@endsection