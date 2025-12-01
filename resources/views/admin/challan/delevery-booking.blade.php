@extends('admin.admin_layout.master')
@section('main_content')

<div class="content-wrapper bg-light" style="min-height: 1419px;">

    <!-- Page Header -->
    <section class="content-header pb-1">
        <div class="container-fluid">

            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h4 class="m-0 text-primary fw-bold d-flex align-items-center">
                        <i class="fas fa-clipboard-list me-2 text-primary"></i> {{ __('Manifest') }}
                    </h4>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent m-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/dashboard') }}" class="text-muted text-decoration-none">{{ __('Home') }}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">{{ __('Manifest') }}</li>
                        <li class="breadcrumb-item active text-primary">&nbsp;{{ __('Loading Challan Details') }}</li>
                    </ol>
                </div>
            </div>

            <div class="row mb-2">
                @include('common.notification')
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Action Buttons -->
            <div class="row mb-3">
                <div class="col-12 d-flex flex-wrap gap-2">

                    <button onclick="window.print()" class="btn btn-success shadow-sm px-3 py-2 fw-bold">
                        <i class="fas fa-print me-1"></i> {{__('Print') }}
                    </button>
                    &nbsp;
                    @if($challanDetail->user->branch_user_id === $branchId)
                    <a href="{{ url('admin/challans') }}" class="btn btn-primary shadow-sm px-3 py-2 fw-bold">
                        <i class="fas fa-edit me-1"></i> {{__('Edit') }}
                    </a>
                    @endif

                    <a href="{{ url('admin/challans') }}" class="btn btn-warning shadow-sm px-3 py-2 fw-bold">
                        <i class="fas fa-angle-double-left me-1"></i> {{__('Back') }}
                    </a>

                </div>
            </div>

            <!-- Challan Information Card -->
            <div class="print-area">
                <div class="card shadow-sm mb-4 border-0 rounded-3">
                    <div class="card-header text-white"
                        style="background: linear-gradient(135deg, #007bff, #0056b3); padding: 12px 20px; border-radius: 8px;">
                        <h3 class="card-title fw-semibold m-0 d-flex align-items-center">
                            <i class="fas fa-truck-loading me-2"></i>&nbsp;{{ __('Loading Challan Information') }}
                        </h3>
                    </div>

                    <div class="card-body p-3">
                        <div class="row g-3 detail-row">

                            <!-- Fields style improved -->
                            @php
                            $fields = [
                            ['label'=>'Created By', 'value'=> ($challanDetail->user->branch_user_id === $branchId) ? __('Self') : strtoupper($challanDetail->user->branch->branch_name)],
                            ['label'=>'Vehicle Number', 'value'=> strtoupper($challanDetail->busNumber)],
                            ['label'=>'Driver Name', 'value'=> strtoupper($challanDetail->driverName)],
                            ['label'=>'Driver Mobile', 'value'=> strtoupper($challanDetail->driverMobile)],
                            ['label'=>'Lock Number', 'value'=> strtoupper($challanDetail->locknumber)],
                            ['label'=>'Co-Loder', 'value'=> strtoupper($challanDetail->coLoder)],
                            ];
                            @endphp

                            @foreach($fields as $field)
                            <div class="col-md-2">
                                <div class="border rounded p-2 bg-light small-box-shadow">
                                    <div class="text-muted small">{{ __($field['label']) }}</div>
                                    <div class="fw-bold">{{ $field['value'] ?? __('N/A') }}</div>
                                </div>
                            </div>
                            @endforeach

                            <div class="col-md-3">
                                <div class="border rounded p-2 bg-light">
                                    <div class="text-muted small">{{ __('Dispatch Date') }}</div>
                                    <div class="fw-bold">{{ formatDate($challanDetail->created_at) }}</div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="border rounded p-2 bg-light">
                                    <div class="text-muted small">{{ __('Challan Number') }}</div>
                                    <div class="fw-bold">{{ $challanDetail->challan_number ?? '--' }}</div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Booking List Card -->
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header text-white"
                        style="background: linear-gradient(135deg, #28a745, #1e7e34); padding: 12px 20px; border-radius: 8px;">
                        <h3 class="card-title fw-semibold m-0 d-flex align-items-center">
                            <i class="fas fa-list-alt me-2"></i> {{ __('Loading Challan Booking List') }}
                        </h3>
                    </div>

                    <form id="bookingForm" action="{{ url('admin/bookings/booking-received') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $challanDetail->id }}" name="chalan_id">

                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0 align-middle">
                                    <thead class="table-dark">
                                        <tr>
                                            <th width="5%">
                                                <div class="form-check ms-1">
                                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                                    <label class="form-check-label small" for="selectAll">
                                                        {{ __('Select All') }}
                                                    </label>
                                                </div>
                                            </th>
                                            <th>{{ __('Created By') }}</th>
                                            <th>{{ __('Bilti Number') }}</th>
                                            <th>{{ __('Offline Bilti / Date') }}</th>
                                            <th>{{ __('Chalan Number') }}</th>
                                            <th>{{ __('Origin') }}</th>
                                            <th>{{ __('Consignor') }}</th>
                                            <th>{{ __('Consignee') }}</th>
                                            <th>{{ __('Destination') }}</th>
                                            <th class="text-center">{{ __('QTY') }}</th>
                                            <th>{{ __('Cantain') }}</th>
                                            <th>{{ __('Booking Type') }}</th>
                                            <th>{{ __('Booked at') }}</th>
                                            <th>{{ __('Actions') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($bookings as $booking)
                                        <tr>
                                            <td>
                                                @if($booking->visible_for === auth()->user()->branch_user_id)
                                                <input type="checkbox" name="selectedBookings[]" value="{{ $booking->id }}">
                                                @endif
                                            </td>

                                            <td><span class="badge bg-danger">{{ $booking->booking_created_by }}</span></td>
                                            <td>{{ $booking->bilti_number }}</td>
                                            <th> {{ $booking->manual_bilty_number ?? '--' }} /
                                                {{ $booking->offline_booking_date ? formatOnlyDate($booking->offline_booking_date) : '--' }}
                                            </th>
                                            <td>{{ $challanDetail->challan_number ?? '--' }}</td>
                                            <td>{{ $booking->consignorBranch->branch_name ?? '--' }}</td>
                                            <td>{{ $booking->consignor_name }}</td>
                                            <td>{{ $booking->consignee_name }}</td>
                                            <td>{{ $booking->consigneeBranch->branch_name ?? '--' }}</td>
                                            <td class="text-center fw-bold">{{ $booking->no_of_artical }}</td>
                                            <td>{{ $booking->cantain ?? '--' }}</td>
                                            <td><span class="badge bg-primary">{{ $booking->booking_type_name }}</span></td>
                                            <td>{{ formatDate($booking->created_at) }}</td>

                                            <td>
                                                @if(($challanDetail->user->branch_user_id === $branchId) && ($booking->is_revert_button_visible))
                                                <a class="btn btn-sm btn-danger revertbooking"
                                                    data-reverturl='{{ url("admin/challans/$challanDetail->id/revert-booking/$booking->id") }}'>
                                                    <i class="fas fa-undo me-1"></i> {{ __('Revert') }}
                                                </a>
                                                @else
                                                --
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot class="table-light fw-bold">
                                        <tr>
                                            <td colspan="9" class="text-end"><strong>{{ __('Total Quantity') }}</strong></td>
                                            <td class="text-center bg-secondary text-white">{{ $bookings->sum('no_of_artical') }}</td>
                                            <td colspan="4"></td>
                                        </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>

                        <div class="card-footer bg-light border-top">
                            @if($challanDetail->is_received_button_visible)
                            <button type="button" id="receivedButton"
                                class="btn btn-success fw-bold px-4 py-2 float-end shadow-sm mark-read-btn">
                                <i class="fas fa-check-circle me-1"></i> {{ __('Mark as Received') }}
                            </button>
                            @endif
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </section>

</div>
@endsection


@section('script')
@parent
<script>
    document.getElementById('receivedButton').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[name="selectedBookings[]"]:checked');
        if (checkboxes.length === 0) {
            alert('{{ __("Please select at least one booking.") }}');
        } else {
            document.getElementById('bookingForm').submit();
        }
    });

    // Select All functionality
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('input[name="selectedBookings[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });
</script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
    $(document).ready(function(e) {
        // Handle select all checkbox
        $(document).on('click', '#selectAll', function(e) {
            if ($(this).prop('checked') == true) {
                // Select all checkboxes
                $('.form-check-input').prop('checked', true);
            } else {
                // Deselect all checkboxes
                $('.form-check-input').prop('checked', false);
            }
        });

        //revert the booking.
        $(document).on('click', '.revertbooking', function(e) {
            e.preventDefault();
            const url = $(this).data('reverturl');
            if (confirm('{{ __("Are you sure want to revert this booking?") }}')) {
                window.location.href = url;
            }
        });
    });
</script>
@endsection

@section('styles')
@parent
<style>
    @media print {

        /* Hide everything first */
        body * {
            visibility: hidden !important;
        }

        /* Only print-area visible */
        .print-area,
        .print-area * {
            visibility: visible !important;
        }

        /* Remove buttons in print */
        .mark-read-btn,
        #selectAll,
        .revertbooking,
        .btn,
        .breadcrumb,
        header,
        footer {
            display: none !important;
            visibility: hidden !important;
        }

        /* Position content properly */
        .print-area {
            position: absolute;
            top: 0;
            left: 0;
            width: 100% !important;
            padding: 0;
            margin: 0;
        }

        /* Detail Row in 3 columns for print */
        .detail-row {
            display: grid !important;
            grid-template-columns: repeat(3, 1fr) !important;
            gap: 8px !important;
        }

        table {
            border-collapse: collapse !important;
            width: 100% !important;
            font-size: 12px !important;
        }

        th,
        td {
            border: 1px solid #000 !important;
            padding: 6px !important;
        }
    }

    .small-box-shadow {
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
    }
</style>
@endsection