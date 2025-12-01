@extends('admin.admin_layout.master')
@section('main_content')
<div class="content-wrapper" style="min-height: 1419.51px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h4 class="m-0 text-primary">
                        <i class="fas fa-user"></i> {{ __('Delivery') }}
                    </h4>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ url('admin/dashboard') }}">
                                <i class="bi bi-house-door"></i> {{ __('Home') }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ __('Receiver Details') }}
                        </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-sm-12" id="notification">
                @include('common.notification')
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <form action='{{ url("admin/delivery/gatepass-amount/add-receiver/$deliveryReceipt->id") }}' method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $deliveryReceipt->booking->id }}" name="booking_id">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('Delivery receipt') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="container my-4">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped align-middle"
                                            style="font-size: 18px;">

                                            <tbody>
                                                <tr>
                                                    <td><strong>{{ __('Consignor Name') }}</strong></td>
                                                    <td>{{ $deliveryReceipt->booking->consignor_name }}</td>
                                                    <td><strong>{{ __('Consignee Name') }}</strong></td>
                                                    <td>{{ $deliveryReceipt->booking->consignee_name }}</td>
                                                </tr>
                                                <tr>

                                                    <td><strong>{{ __('Booking Station') }}</strong></td>
                                                    <td>{{ $deliveryReceipt->booking->consignorBranch->branch_name }}</td>
                                                    <td><strong>{{ __('Delivery Station') }}</strong></td>
                                                    <td>{{ $deliveryReceipt->booking->consigneeBranch->branch_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>{{ __('Offline Bilti Number') }}</strong></td>
                                                    <td>{{ $deliveryReceipt->booking->manual_bilty_number ?: 'NA' }}</td>
                                                    <td><strong>{{ __('Offline Booking Date') }}</strong></td>
                                                    <td>{{ formatOnlyDate($deliveryReceipt->booking->offline_booking_date) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>{{ __('Online Bilti / Booking Date') }}</strong></td>
                                                    <td>
                                                        <span style="color: blue; font-weight: bold;">
                                                            {{ $deliveryReceipt->booking->bilti_number }}
                                                        </span>
                                                        /
                                                        {{ formatDate($deliveryReceipt->booking->created_at) }}
                                                    </td>
                                                    <td><strong>{{ __('Article') }}</strong></td>
                                                    <td>{{ $deliveryReceipt->booking->no_of_artical }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>{{ __('Contain') }}</strong></td>
                                                    <td>{{ $deliveryReceipt->booking->cantain }}</td>
                                                    <td><strong>{{ __('Carrier By') }}</strong></td>
                                                    <td>{{ $deliveryReceipt->recived_by }} </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>{{ __('Carrier Mobile') }}</strong></td>
                                                    <td>{{ $deliveryReceipt->reciver_mobile }}</td>
                                                    <td><strong>{{ __('Remark') }}</strong></td>
                                                    <td>{{ $deliveryReceipt->remark ?? '--' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>{{ __('Booking Type') }}</strong></td>
                                                    <td>{{ $deliveryReceipt?->booking?->booking_type ?? '--' }}</td>
                                                    <td class="text-success"><strong>{{ __('Total Received Amount') }}</strong></td>
                                                    <td>{{ $deliveryReceipt->bookingReceivedAmount() ?? '--' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>{{ __('Freight Charges') }}</strong></td>
                                                    <td>&#8377;{{ $deliveryReceipt->freight_charges }}</td>
                                                    <td><strong>{{ __('Hamali Charges') }}</strong></td>
                                                    <td>&#8377;{{ $deliveryReceipt->hamali_charges ?? '--' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>{{ __('Demurrage Charges') }}</strong></td>
                                                    <td>&#8377;{{ $deliveryReceipt->demruge_charges }}</td>
                                                    <td><strong>{{ __('Other Charges') }}</strong></td>
                                                    <td>&#8377;{{ $deliveryReceipt->others_charges ?? '--' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>{{ __('Discount') }}</strong></td>
                                                    <td>&#8377;{{ $deliveryReceipt->discount }}</td>
                                                    <td><strong>{{ __('Grand Total') }}</strong></td>
                                                    <td>&#8377;{{ $deliveryReceipt->grand_total ?? '--' }}</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pay Remaining -->
                    <div class="col-md-6">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('Receiver Details') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold">{{ __('Receiver Name') }}<span style="color: red"> *</span></label>
                                            <input type="text" class="form-control"
                                                value="{{ old('receiver_name', $deliveryReceipt?->booking?->receiver_name) }}" name="receiver_name"
                                                placeholder="{{ __('Receiver Name') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-0">
                                            <label class="font-weight-bold">{{ __('Receiver Mobile') }}<span style="color: red"> *</span></label>
                                            <input type="tel"
                                                class="form-control"
                                                name="receiver_mobile"
                                                placeholder="{{ __('Receiver Mobile') }}"
                                                maxlength="100"
                                                value="{{ old('receiver_mobile', $deliveryReceipt?->booking?->receiver_mobile_number) }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <input type="submit" value="{{ __('Submit') }}" class="btn btn-success float-right">
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
@section('styles')
@parent
<style>
    /* --- Card Styling --- */
    .card-danger {
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        border: none;
    }

    .card-danger .card-header {
        background: linear-gradient(45deg, #dc3545, #b52b37);
        color: #fff;
        border-radius: 10px 10px 0 0;
        padding: 12px 20px;
    }

    /* --- Table Styling --- */
    table.table {
        border-radius: 8px;
        overflow: hidden;
    }

    table.table th {
        background: #f1f1f1;
        font-size: 16px;
        font-weight: 600;
    }

    table.table td {
        vertical-align: middle !important;
        font-size: 16px;
    }

    /* Hover effect */
    table.table tbody tr:hover {
        background: #fafafa;
        transition: .2s;
    }

    /* --- Form Inputs --- */
    .form-control {
        border-radius: 6px !important;
        height: 45px;
        font-size: 18px;
    }

    textarea.form-control {
        height: 90px;
    }

    /* Input highlight on focus */
    .form-control:focus {
        border-color: #ffffffff;
        box-shadow: 0 0 5px rgba(40, 167, 69, 0.4);
    }

    /* --- Labels --- */
    label {
        font-weight: 600;
        margin-bottom: 5px;
    }

    /* --- Submit Button --- */
    .btn-success {
        font-size: 18px;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        box-shadow: 0 3px 8px rgba(0, 128, 0, 0.3);
    }

    .btn-success:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 128, 0, 0.4);
    }

    /* --- Section spacing --- */
    .content-wrapper {
        padding-bottom: 40px;
    }

    /* Payment list table */
    .card-title {
        font-size: 22px;
        font-weight: 700;
    }

    /* Responsive tweaks */
    @media (max-width:768px) {
        label {
            font-size: 18px !important;
        }

        .form-control {
            font-size: 16px;
            height: 40px;
        }
    }
</style>
@endsection