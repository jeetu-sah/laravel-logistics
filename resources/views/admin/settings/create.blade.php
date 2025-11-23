@extends('admin.admin_layout.master')
@section('main_content')
<div class="content-wrapper" style="min-height: 1419.51px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Settings Management') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Settings') }}</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                @include('common.notification')
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-cogs mr-2"></i>{{ __('Booking Settings Configuration') }}
                    </h3>
                    <a href="{{ url('admin/admin-settings') }}" class="btn btn-sm btn-outline-primary shadow-sm">
                        <i class="fas fa-list fa-sm mr-1"></i> {{ __('View All Settings') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                @role('Admin')
                <form action="{{ url('admin/admin-settings/store') }}" method="post" id="form" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf

                    <!-- Booking Settings Card -->
                    <div class="card card-info mb-4">
                        <div class="card-header bg-info text-white">
                            <h4 class="card-title mb-0">
                                <i class="fas fa-truck-loading mr-2"></i>{{ __('Booking Charges Configuration') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Transportation Charges -->
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100 border-left-primary">
                                        <div class="card-header bg-light">
                                            <h5 class="card-title mb-0 text-primary">
                                                <i class="fas fa-gas-pump mr-2"></i>{{ __('Transportation Charges') }}
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="freight_amount" class="form-label font-weight-bold">{{ __('Freight Charges') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₹</span>
                                                    </div>
                                                    <input type="text" name="freight_amount" class="form-control" id="freight_amount" value="{{$settings['freight_amount'] ?? ''}}" placeholder="{{ __('Enter freight charges') }}" required />
                                                </div>
                                                <small class="form-text text-muted">
                                                    <i class="fas fa-info-circle mr-1"></i> {{ __('Charges per kilometer distance') }}
                                                </small>
                                            </div>

                                            <div class="form-group">
                                                <label for="fuel_amount" class="form-label font-weight-bold">{{ __('Fuel Charges') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₹</span>
                                                    </div>
                                                    <input type="text" name="fuel_amount" class="form-control" id="fuel_amount" value="{{$settings['fuel_amount'] ?? ''}}" placeholder="{{ __('Enter fuel charges') }}" required />
                                                </div>
                                                <small class="form-text text-muted">
                                                    <i class="fas fa-info-circle mr-1"></i> {{ __('Additional fuel charges per parcel') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Service Charges -->
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100 border-left-success">
                                        <div class="card-header bg-light">
                                            <h5 class="card-title mb-0 text-success">
                                                <i class="fas fa-concierge-bell mr-2"></i>{{ __('Service Charges') }}
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="wbc_charges" class="form-label font-weight-bold">{{ __('WBC Charges') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₹</span>
                                                    </div>
                                                    <input type="text" name="wbc_charges" class="form-control" id="wbc_charges" value="{{$settings['wbc_charges'] ?? ''}}" placeholder="{{ __('Enter WBC charges') }}" required />
                                                </div>
                                                <small class="form-text text-muted">
                                                    <i class="fas fa-info-circle mr-1"></i> {{ __('Weight-based charges per parcel') }}
                                                </small>
                                            </div>

                                            <div class="form-group">
                                                <label for="handling_charges" class="form-label font-weight-bold">{{ __('Handling Charges') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₹</span>
                                                    </div>
                                                    <input type="text" name="handling_charges" class="form-control" id="handling_charges" value="{{$settings['handling_charges'] ?? ''}}" placeholder="{{ __('Enter handling charges') }}" required />
                                                </div>
                                                <small class="form-text text-muted">
                                                    <i class="fas fa-info-circle mr-1"></i> {{ __('Material handling charges per parcel') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Charges -->
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100 border-left-warning">
                                        <div class="card-header bg-light">
                                            <h5 class="card-title mb-0 text-warning">
                                                <i class="fas fa-tags mr-2"></i>{{ __('Additional Charges') }}
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="transhipmen_amount" class="form-label font-weight-bold">{{ __('Transhipment Charges') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₹</span>
                                                    </div>
                                                    <input type="text" name="transhipmen_amount" class="form-control" id="transhipmen_amount" value="{{$settings['transhipmen_amount'] ?? ''}}" placeholder="{{ __('Enter transhipment charges') }}" required />
                                                </div>
                                                <small class="form-text text-muted">
                                                    <i class="fas fa-info-circle mr-1"></i> {{ __('Transfer charges between vehicles') }}
                                                </small>
                                            </div>

                                            <div class="form-group">
                                                <label for="hamali_charges" class="form-label font-weight-bold">{{ __('Hamali Charges') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₹</span>
                                                    </div>
                                                    <input type="text" name="hamali_charges" class="form-control" id="hamali_charges" value="{{$settings['hamali_charges'] ?? ''}}" placeholder="{{ __('Enter hamali charges') }}" required />
                                                </div>
                                                <small class="form-text text-muted">
                                                    <i class="fas fa-info-circle mr-1"></i> {{ __('Loading/unloading labor charges') }}
                                                </small>
                                            </div>

                                            <div class="form-group">
                                                <label for="bilti_charges" class="form-label font-weight-bold">{{ __('Bilti Charges') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₹</span>
                                                    </div>
                                                    <input type="text" name="bilti_charges" class="form-control" id="bilti_charges" value="{{$settings['bilti_charges'] ?? ''}}" placeholder="{{ __('Enter bilti charges') }}" required />
                                                </div>
                                                <small class="form-text text-muted">
                                                    <i class="fas fa-info-circle mr-1"></i> {{ __('Documentation and paperwork charges') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Insurance & Company Charges -->
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100 border-left-info">
                                        <div class="card-header bg-light">
                                            <h5 class="card-title mb-0 text-info">
                                                <i class="fas fa-shield-alt mr-2"></i>{{ __('Insurance & Company Charges') }}
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="fov_amount" class="form-label font-weight-bold">{{ __('FOV (Goods Value)') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₹</span>
                                                    </div>
                                                    <input type="text" name="fov_amount" class="form-control" id="fov_amount" value="{{$settings['fov_amount'] ?? ''}}" placeholder="{{ __('Enter FOV charges') }}" required />
                                                </div>
                                                <small class="form-text text-muted">
                                                    <i class="fas fa-info-circle mr-1"></i> {{ __('Insurance for high-value goods') }}
                                                </small>
                                            </div>

                                            <div class="form-group">
                                                <label for="compney_charges" class="form-label font-weight-bold">{{ __('Company Charges') }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₹</span>
                                                    </div>
                                                    <input type="text" name="compney_charges" class="form-control" id="compney_charges" value="{{$settings['compney_charges'] ?? ''}}" placeholder="{{ __('Enter company charges') }}" required />
                                                </div>
                                                <small class="form-text text-muted">
                                                    <i class="fas fa-info-circle mr-1"></i> {{ __('Administrative and overhead charges') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tax Configuration -->
                                <div class="col-12 mb-4">
                                    <div class="card border-left-danger">
                                        <div class="card-header bg-light">
                                            <h5 class="card-title mb-0 text-danger">
                                                <i class="fas fa-percentage mr-2"></i>{{ __('Tax Configuration') }}
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="cgst" class="form-label font-weight-bold">{{ __('CGST Rate') }}</label>
                                                        <div class="input-group">
                                                            <input type="text" name="cgst" class="form-control" id="cgst" value="{{$settings['cgst'] ?? ''}}" placeholder="{{ __('CGST percentage') }}" required />
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                        <small class="form-text text-muted">
                                                            <i class="fas fa-info-circle mr-1"></i> {{ __('Central GST (9% of subtotal)') }}
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="sgst" class="form-label font-weight-bold">{{ __('SGST Rate') }}</label>
                                                        <div class="input-group">
                                                            <input type="text" name="sgst" class="form-control" id="sgst" value="{{$settings['sgst'] ?? ''}}" placeholder="{{ __('SGST percentage') }}" required />
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                        <small class="form-text text-muted">
                                                            <i class="fas fa-info-circle mr-1"></i> {{ __('State GST (9% of subtotal)') }}
                                                        </small>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="igst" class="form-label font-weight-bold">{{ __('IGST Rate') }}</label>
                                                        <div class="input-group">
                                                            <input type="text" name="igst" class="form-control" id="igst" value="{{$settings['igst'] ?? ''}}" placeholder="{{ __('IGST percentage') }}" required />
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">%</span>
                                                            </div>
                                                        </div>
                                                        <small class="form-text text-muted">
                                                            <i class="fas fa-info-circle mr-1"></i> {{ __('Integrated GST (18% of subtotal for interstate)') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bank Details Section -->
                    <div class="card card-secondary mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h4 class="card-title mb-0">
                                <i class="fas fa-university mr-2"></i>{{ __('Bank Account Details') }}
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card h-100 border-left-dark">
                                        <div class="card-header bg-light">
                                            <h5 class="card-title mb-0 text-dark">
                                                <i class="fas fa-landmark mr-2"></i>{{ __('Primary Bank Account') }}
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <!-- First Column -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="bank_name" class="form-label font-weight-bold">{{ __('Bank Name') }}</label>
                                                        <input type="text" name="bank_name" class="form-control" id="bank_name" value="{{$settings['bank_name'] ?? ''}}" placeholder="{{ __('Enter bank name') }}" required />
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="account_holder_name" class="form-label font-weight-bold">{{ __('Account Holder Name') }}</label>
                                                        <input type="text" name="account_holder_name" class="form-control" id="account_holder_name" value="{{$settings['account_holder_name'] ?? ''}}" placeholder="{{ __('Enter account holder name') }}" required />
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="branch_name" class="form-label font-weight-bold">{{ __('Branch Name') }}</label>
                                                        <input type="text" name="branch_name" class="form-control" id="branch_name" value="{{$settings['branch_name'] ?? ''}}" placeholder="{{ __('Enter branch name') }}" required />
                                                    </div>
                                                </div>

                                                <!-- Second Column -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="account_number" class="form-label font-weight-bold">{{ __('Account Number') }}</label>
                                                        <input type="text" name="account_number" class="form-control" id="account_number" value="{{$settings['account_number'] ?? ''}}" placeholder="{{ __('Enter account number') }}" required />
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="ifsc_code" class="form-label font-weight-bold">{{ __('IFSC Code') }}</label>
                                                        <input type="text" name="ifsc_code" class="form-control" id="ifsc_code" value="{{$settings['ifsc_code'] ?? ''}}" placeholder="{{ __('Enter IFSC code') }}" required />
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="upi_id" class="form-label font-weight-bold">{{ __('UPI ID') }}</label>
                                                        <input type="text" name="upi_id" class="form-control" id="upi_id" value="{{$settings['upi_id'] ?? ''}}" placeholder="{{ __('Enter UPI ID') }}" />
                                                        <small class="form-text text-muted">
                                                            <i class="fas fa-info-circle mr-1"></i> {{ __('Optional - for digital payments') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body text-center py-3">
                                    <button class="btn btn-success btn-lg px-5" type="submit">
                                        <i class="fas fa-save mr-2"></i>{{ __('Save All Settings') }}
                                    </button>
                                    <a href="{{ url('admin/admin-settings') }}" class="btn btn-outline-secondary btn-lg px-5 ml-2">
                                        <i class="fas fa-times mr-2"></i>{{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @else
                <div class="alert alert-warning text-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    {{ __("You don't have permission to access settings configuration.") }}
                </div>
                @endrole
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<style>
    .card {
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        border: 1px solid #e3e6f0;
    }

    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }

    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }

    .border-left-warning {
        border-left: 0.25rem solid #f6c23e !important;
    }

    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }

    .border-left-danger {
        border-left: 0.25rem solid #e74a3b !important;
    }

    .border-left-dark {
        border-left: 0.25rem solid #5a5c69 !important;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .input-group-text {
        background-color: #f8f9fc;
        border: 1px solid #d1d3e2;
    }

    .form-text {
        font-size: 0.85rem;
    }

    .card-header.bg-light {
        background-color: #f8f9fc !important;
        border-bottom: 1px solid #e3e6f0;
    }
</style>
@endsection