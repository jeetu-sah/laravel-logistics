@extends('masterLayout.master')

@section('main_content')
<div class="container my-5">
    <div class="card shadow border-0 rounded-4 p-5 bg-white">
        <div class="card-body">
            <a href="{{ url('/') }}" class="btn btn-outline-primary mb-4">
                <i class="fa fa-arrow-left me-1"></i> {{__('Back')}}
            </a>

            <!-- Header -->
            <h3 class="fw-bold text-dark mb-4 text-center">
                🚚 {{__('Shipment Tracking')}}
            </h3>

            <!-- Booking Info -->
            <div class="mb-5 p-4 bg-light rounded-4 border shadow-sm">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <p class="mb-1 text-secondary">{{ __('Bilti Number')}}</p>
                        <h6 class="fw-bold">{{ $booking->bilti_number }}</h6>
                    </div>
                    <div class="col-md-4 mb-2">
                        <p class="mb-1 text-secondary">Customer</p>
                        <h6 class="fw-bold">{{ $booking->consignee_name }}</h6>
                    </div>
                    <div class="col-md-4 mb-2">
                        <p class="mb-1 text-secondary">Shipping By</p>
                        <h6 class="fw-bold">
                            Vikas Logistic
                            <a href="tel:+918840354461"
                                class="text-decoration-none ms-2 text-primary fw-semibold">
                                <i class="fa fa-phone text-success me-1"></i> +91 88403 54461
                            </a>
                        </h6>
                    </div>
                </div>
            </div>

            <!-- Vertical Timeline -->
            <div class="timeline position-relative">

                @foreach($steps as $step)
                @php
                $statusClass = match($step['status']) {
                'completed' => 'completed',
                'active' => 'active',
                default => 'pending'
                };
                $icon = match($step['status']) {
                'completed' => 'fa-check',
                'active' => 'fa-spinner fa-spin',
                default => 'fa-clock'
                };
                @endphp

                <div class="timeline-step {{ $statusClass }}">
                    <div class="circle">
                        <i class="fa {{ $icon }}"></i>
                    </div>

                    <div class="content">
                        <h6 class="fw-bold mb-1">
                            {{ $step['name'] }}
                            @if(!empty($step['branchName']))
                            <span class="text-muted">({{ $step['branchName'] }})</span>
                            @endif
                        </h6>
                        <span class="badge 
                            @if($step['status'] === 'completed') bg-success 
                            @elseif($step['status'] === 'pending') bg-warning text-dark
                            @else bg-secondary 
                            @endif
                            mb-2 d-inline-block">
                            {{ ucfirst($step['status']) }}
                        </span>
                        @if($step['status'] === 'completed')
                        <div class="small text-secondary">
                            @if(!empty($step['dispatched_at']))
                            <div><strong>Dispatched:</strong> {{ $step['dispatched_at'] }}</div>
                            @endif
                            @if(!empty($step['received_at']))
                            <div><strong>Received:</strong> {{ $step['received_at'] }}</div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>

<style>
    /* Timeline Line */
    .timeline {
        border-left: 3px dashed #d0d0d0;
        margin-left: 30px;
        padding-left: 30px;
    }

    /* Step */
    .timeline-step {
        position: relative;
        margin-bottom: 45px;
    }

    .timeline-step:last-child {
        margin-bottom: 0;
    }

    /* Circle */
    .timeline-step .circle {
        position: absolute;
        left: -52px;
        top: 0;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #f8f9fa;
        border: 3px solid #cfcfcf;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    /* Completed */
    .timeline-step.completed .circle {
        background: #28a745;
        border-color: #28a745;
        color: #fff;
    }

    .timeline-step.completed .content h6 {
        color: #28a745;
    }

    /* Active */
    .timeline-step.active .circle {
        background: #ffc107;
        border-color: #ffc107;
        color: #fff;
        animation: pulse 1.5s infinite;
    }

    .timeline-step.active .content h6 {
        color: #ffc107;
    }

    /* Content Card */
    .timeline-step .content {
        background: #ffffff;
        padding: 15px 20px;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        transition: 0.3s;
    }

    .timeline-step:hover .content {
        transform: translateX(5px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
    }

    /* Pulse Animation */
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.5);
        }

        70% {
            box-shadow: 0 0 0 12px rgba(255, 193, 7, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(255, 193, 7, 0);
        }
    }
</style>
@endsection