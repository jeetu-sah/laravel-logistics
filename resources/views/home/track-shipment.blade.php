@extends('masterLayout.master')

@section('main_content')
<div class="container my-5">
    <div class="card shadow border-0 rounded-4 p-5 bg-light">
        <div class="card-body">
            <h4 class="fw-bold text-dark mb-4 text-center">🚚 Shipment Tracking</h4>

            <!-- Shipment Info -->
            <div class="mb-5 px-3 py-2 bg-white rounded-3 shadow-sm border">
                <p><strong>Bilti Number:</strong> <span class="text-dark">{{ $booking->bilti_number }}</span></p>
                <p><strong>Customer:</strong> {{ $booking->consignee_name }}</p>
                <p>
                    <strong>Shipping By:</strong> Vikas Logistic
                    <i class="fa fa-phone text-success ms-2"></i>
                    <a href="tel:+918840354461" class="fw-semibold text-decoration-none">+91-8840354461</a>
                </p>
            </div>

            <!-- Vertical Timeline -->
            <div class="timeline">
                @foreach($steps as $step)
                @php
                $statusClass = 'pending';
                $icon = 'fa-clock';

                if($step['status'] === 'completed') {
                $statusClass = 'completed';
                $icon = 'fa-check';
                } elseif($step['status'] === 'active') {
                $statusClass = 'active';
                $icon = 'fa-spinner fa-spin';
                }
                @endphp

                <div class="timeline-step {{ $statusClass }}">
                    <div class="circle">
                        <i class="fa {{ $icon }}"></i>
                    </div>
                    <div class="content">
                        <h6>{{ $step['name'] }}
                            @if(!empty($step['branchName']))
                            ({{ $step['branchName'] }})
                            @endif
                        </h6>
                        <p>
                            @if(!empty($step['dispatched_at']))
                            <strong>Dispatched:</strong> {{ $step['dispatched_at'] }}<br>
                            @endif
                            @if(!empty($step['received_at']))
                            <strong>Received:</strong> {{ $step['received_at'] }}
                            @endif
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Timeline CSS -->
<style>
    .timeline {
        position: relative;
        margin: 30px 0;
        padding-left: 50px;
        border-left: 3px solid #dee2e6;
    }

    .timeline-step {
        position: relative;
        margin-bottom: 40px;
        transition: all 0.3s ease-in-out;
    }

    .timeline-step:last-child {
        margin-bottom: 0;
    }

    .timeline-step .circle {
        position: absolute;
        left: -33px;
        top: 0;
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: #f8f9fa;
        border: 3px solid #ced4da;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        color: #6c757d;
        transition: all 0.3s ease-in-out;
    }

    .timeline-step.completed .circle {
        background: #28a745;
        border-color: #28a745;
        color: #fff;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    }

    .timeline-step.active .circle {
        background: #ffc107;
        border-color: #ffc107;
        color: #fff;
        animation: pulse 1.5s infinite;
    }

    .timeline-step .content {
        padding-left: 20px;
        background: #fff;
        border-radius: 8px;
        padding: 12px 20px;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease-in-out;
        position: relative;
        /* ensure it stays in flow */
        left: 30px;
        /* keep content aligned */
    }

    .timeline-step:hover .content {
        /* Remove translateX to prevent overlap */
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        /* subtle deeper shadow on hover */
    }

    .timeline-step .content h6 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
        color: #343a40;
    }

    .timeline-step .content p {
        margin: 5px 0 0;
        font-size: 14px;
        color: #495057;
    }

    .timeline-step.completed .content h6 {
        color: #28a745;
    }

    .timeline-step.active .content h6 {
        color: #ffc107;
    }

    /* Pulse animation */
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 193, 7, 0.6);
        }

        70% {
            box-shadow: 0 0 0 12px rgba(255, 193, 7, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(255, 193, 7, 0);
        }
    }

    /* Add hover effect */
    .timeline-step:hover .content {
        transform: translateX(5px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection