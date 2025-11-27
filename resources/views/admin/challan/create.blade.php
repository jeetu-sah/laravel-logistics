@extends('admin.admin_layout.master')
@section('main_content')
<div class="content-wrapper" style="min-height: 1419.51px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0 text-primary">
                        <i class="fas fa-box"></i> Manifest
                    </h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="#">{{ __('Manifest') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Create Challan') }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            @include('common.notification')
        </div>
    </section>

    <!-- Send Details Modal -->
    <div class="modal fade" id="sendDetailsModal" tabindex="-1" aria-labelledby="sendDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="sendDetailsModalLabel">{{ __('Send Details') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
                </div>

                <!-- Modal Body -->
                <form action="{{ url('send-details') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="recipientName" class="form-label">{{ __('Recipient Name') }}</label>
                            <input type="text" class="form-control" id="recipientName" name="recipient_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipientEmail" class="form-label">{{ __('Recipient Email') }}</label>
                            <input type="email" class="form-control" id="recipientEmail" name="recipient_email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">{{ __('Message') }}</label>
                            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('Create Challan') }}</h3>
            </div>

            <form action="{{ url('admin/challans/create') }}" method="POST" id="challanForm">
                @csrf
                <div class="card-body">
                    <div class="row p-3 rounded" style="background:#f8f9fc; border:1px solid #e6e6e6; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">

                        <!-- Vehicle Number -->
                        <div class="col-md-3 mb-3">
                            <label class="fw-bold" for="busNumber">
                                <i class="fas fa-truck text-primary"></i> {{ __('Vehicle Number') }} <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                placeholder="{{ __('Bus Number') }}"
                                class="form-control form-control-lg"
                                id="busNumber"
                                name="busNumber"
                                value="{{ old('busNumber') }}"
                                required>
                        </div>

                        <!-- Driver Name -->
                        <div class="col-md-3 mb-3">
                            <label class="fw-bold" for="driverName">
                                <i class="fas fa-user text-primary"></i> {{ __('Driver Name') }} <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                class="form-control form-control-lg"
                                placeholder="{{ __('Driver Name') }}"
                                id="driverName"
                                name="driverName"
                                value="{{ old('driverName') }}"
                                required>
                        </div>

                        <!-- Driver Mobile -->
                        <div class="col-md-3 mb-3">
                            <label class="fw-bold" for="driverMobile">
                                <i class="fas fa-phone-alt text-primary"></i> {{ __('Driver Mobile') }} <span class="text-danger">*</span>
                            </label>
                            <input
                                type="text"
                                class="form-control form-control-lg"
                                placeholder="{{ __('Driver Mobile') }}"
                                id="driverMobile"
                                name="driverMobile"
                                value="{{ old('driverMobile') }}"
                                required>
                        </div>

                        <!-- Lock Number -->
                        <div class="col-md-3 mb-3">
                            <label class="fw-bold" for="locknumber">
                                <i class="fas fa-lock text-primary"></i> {{ __('Lock Number') }}
                            </label>
                            <input
                                type="text"
                                class="form-control form-control-lg"
                                placeholder="{{ __('Lock Number') }}"
                                id="locknumber"
                                name="locknumber"
                                value="{{ old('locknumber') }}">
                        </div>

                        <!-- Co Loader -->
                        <div class="col-md-3 mb-3">
                            <label class="fw-bold" for="co-loder">
                                <i class="fas fa-users text-primary"></i> {{ __('Co-Loader') }}
                            </label>
                            <input
                                type="text"
                                class="form-control form-control-lg"
                                placeholder="{{ __('Co Loader') }}"
                                id="co-loder"
                                name="coLoder"
                                value="{{ old('coLoder') }}">
                        </div>

                        <!-- Status -->
                        <div class="col-md-3 mb-3">
                            <label class="fw-bold" for="status">
                                <i class="fas fa-info-circle text-primary"></i> {{ __('Select Status') }} <span class="text-danger">*</span>
                            </label>
                            <select class="form-control form-control-lg" id="status" name="status">
                                <option value="">{{ __('Select Status') }}</option>
                                <option value="Dispatch" selected>{{ __('Dispatch') }}</option>
                                <option value="Pending">{{ __('Pending') }}</option>
                            </select>
                        </div>

                        <!-- For Challan -->
                        <div class="col-md-3 mb-3">
                            <label class="fw-bold" for="for_challan">
                                <i class="fas fa-code-branch text-primary"></i> {{ __('Select For Challan') }} <span class="text-danger">*</span>
                            </label>
                            <select class="form-control form-control-lg" id="for_challan" name="for_challan" required>
                                <option value="">{{ __('Select Branch') }}</option>
                                @forelse($forChallan as $branchChallan)
                                <option value="{{ $branchChallan->id ?? '--' }}">{{ $branchChallan->branch_name ?? '--' }}</option>
                                @empty
                                <option value="Pending">{{ __('No record available') }}</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="display" id="booking-list">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="selectAll" />
                                                <label class="form-check-label" for="selectAll">{{ __('Select All') }}</label>
                                            </div>
                                        </th>
                                        <th>{{ __('Bilti Number') }}</th>
                                        <th>{{ __('Offline Bilti') }}</th>
                                        <th>{{ __('Consignor Name') }}</th>
                                        <th>{{ __('Consignee Name') }}</th>
                                        <th>{{ __('Destination') }}</th>
                                        <th>{{ __('Payment Mode') }}</th>
                                        <th>{{ __('Next Transhipment') }}</th>
                                        <th>{{ __('Creation Date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be dynamically populated by DataTable -->
                                </tbody>
                            </table>
                            <button type="submit" style="margin-top:8px;" class="btn btn-primary float-right" id="openModalBtn">
                                <i class="nav-icon fas fa-save"></i>&nbsp;{{ __('Save & Print') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@section('script')
@parent
<script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>

<script>
    $(document).ready(function(e) {
        $(document).on('click', '#selectAll', function(e) {
            $('.form-check-input').prop('checked', $(this).prop('checked'));
        });

        $(document).on('change', '#for_challan', function(e) {
            table.ajax.reload();
        });

        var table = new DataTable('#booking-list', {
            responsive: true,
            ajax: {
                url: "{{ url('admin/bookings/challan-booking-list') }}",
                data: function(d) {
                    d.bilti_list_type = 'challan';
                    d.for_challan = $("#for_challan").val();
                    d.custom = $('#selectAll').prop('checked');
                },
                dataSrc: function(json) {
                    return json.data;
                }
            },
            columns: [{
                    data: 'sn',
                    orderable: false
                },
                {
                    data: 'bilti_number'
                },
                {
                    data: 'offline_bilti'
                },
                {
                    data: 'consignor_name'
                },
                {
                    data: 'consignee_name'
                },
                {
                    data: 'consignee_branch_id'
                },
                {
                    data: 'booking_type'
                },
                {
                    data: 'next_delivery_location'
                },
                {
                    data: 'created_at'
                }
            ],
            columnDefs: [{
                targets: 0,
                orderable: false
            }],
            processing: true,
            serverSide: true
        });
    });
</script>
@endsection

@section('styles')
@parent
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />


@endsection