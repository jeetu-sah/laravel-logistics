@extends('frontend.layout.master')
@section('content')
<div class="container mt-4">
    <!-- Page Title -->
    <div class="page-title-area text-center">
        <h2 class="fw-bold">Track Your Shipment</h2>
        <div class="text-muted">Real-time updates about your package</div>
    </div>
    <!-- Search Box -->
    <div class="search-card mt-3 mb-4">
        <h5 class="text-center fw-semibold mb-3">Enter Tracking Number</h5>
        <form action="" method="get" onsubmit="return validateBiltyNumber()">
            <input type="text" id="bilty-number" name="bilty-number" class="form-control mb-3" placeholder="Enter tracking / builty number">
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-search me-1"></i> Track Now
            </button>
        </form>
    </div>
</div>
@endsection