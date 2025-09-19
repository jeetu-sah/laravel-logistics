@extends('admin.admin_layout.master')

@section('main_content')
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <!-- Page Title & Breadcrumb -->
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Branch Commissions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('branch-user/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('branch-user/commissions') }}">Branch</a></li>
                        <li class="breadcrumb-item active">Commissions</li>
                    </ol>
                </div>
            </div>

            <!-- Flash Messages -->
            <div class="row mb-2">
                <div class="col-sm-12">
                    @if(Session::has('msg'))
                    {!! Session::get('msg') !!}
                    @endif
                </div>
            </div>

            <!-- Filters Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-filter"></i> Filter Commissions</h3>
                </div>
                <div class="card-body">
                    <!-- Filters -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-filter"></i></span>
                                </div>
                                <select id="commissionFilter" class="form-control">
                                    <option value="">Select Filters</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                    <option value="yearly">Yearly</option>
                                    <option value="custom">Custom</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4" id="monthlyPickerWrapper" style="display:none;">
                            <div class="input-group">
                                <input type="text" class="form-control" id="month_picker" placeholder="Select Month & Year">

                            </div>
                        </div>
                        <div class="col-md-4" id="yearlyPickerWrapper" style="display:none;">
                            <div class="input-group">
                                <input type="text" class="form-control" id="year_picker" placeholder="Select Year">

                            </div>
                        </div>
                    </div>
                    <div class="row mb-3" id="customDateRange" style="display:none;">
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="start_date" placeholder="Select Start Date">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="end_date" placeholder="Select End Date">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <button class="btn btn-success" id="applyCustomFilter">
                                <i class="fas fa-check"></i> Apply
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Card -->
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-chart-bar"></i> Commission Summary | <span id="details-commision" class="text-success font-weight-bold">
                            Showing commissions for all time
                        </span></h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Outgoing -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <a href="javascript:void(0);" class="dashboard-link">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-danger elevation-1">
                                        <i class="fas fa-book"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Outgoing Load Commissions</span>
                                        <span class="info-box-number" id="outgoingCommisions">₹&nbsp;{{ indian_number_format($totalOutgoingCommisions ?? 0) }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Incoming -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <a href="javascript:void(0);" class="dashboard-link">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-info elevation-1">
                                        <i class="fas fa-users"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Incoming Load Commissions</span>
                                        <span class="info-box-number" id="incomingCommisions">₹&nbsp;{{ indian_number_format($totalIncmingCommisions ?? 0) }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Transhipment -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <a href="javascript:void(0);" class="dashboard-link">
                                <div class="info-box mb-3">
                                    <span class="info-box-icon bg-success elevation-1">
                                        <i class="fas fa-truck"></i>
                                    </span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Total Transhipment Commissions</span>
                                        <span class="info-box-number" id="transhipmentCommisions">₹&nbsp;{{ indian_number_format($totalTranshipmentCommisions ?? 0) }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /.content-header -->
</div>
@endsection

@section('script')
@parent

<script>
    $(function() {
        $('#start_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: true, // auto fill input
            startDate: moment(), // set today
            locale: {
                format: 'YYYY-MM-DD'
            }
        }, function(chosen_date) {
            $('#start_date').val(chosen_date.format('YYYY-MM-DD'));
        });

        // End date picker
        $('#end_date').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            autoUpdateInput: true, // auto fill input
            startDate: moment(), // set today
            locale: {
                format: 'YYYY-MM-DD'
            }
        }, function(chosen_date) {
            $('#end_date').val(chosen_date.format('YYYY-MM-DD'));
        });

        $('#month_picker').datepicker({
            format: "yyyy-mm", // output format
            startView: "months", // start with months view
            minViewMode: "months", // restrict to month selection only
            autoclose: true
        });

        $('#year_picker').datepicker({
            format: "yyyy",
            startView: "years",
            minViewMode: "years",
            autoclose: true
        });

        // Show/hide custom date range
        $('#commissionFilter').on('change', function() {
            console.log($(this).val());
            if ($(this).val() === 'custom') {
                $('#customDateRange').show();
                $('#customDateWrapper, #monthlyPickerWrapper, #yearlyPickerWrapper').hide();
            } else if ($(this).val() === 'monthly') {
                $('#customDateWrapper, #customEndWrapper, #yearlyPickerWrapper').hide();
                $('#monthlyPickerWrapper').show();
            } else if ($(this).val() === 'yearly') {
                $('#yearlyPickerWrapper').show();
                $('#customDateRange, #monthlyPickerWrapper').hide();
            } else {
                $('#customDateRange, #monthlyPickerWrapper, #yearlyPickerWrapper').hide();
            }
        });

        // Apply custom filter
        $('#applyCustomFilter').on('click', function() {
            let commissionFilter = $('#commissionFilter').val();
            let startDate = $('#start_date').val();
            let endDate = $('#end_date').val();
            let monthPicker = $('#month_picker').val();
            let yearPicker = $('#year_picker').val();

            if (!commissionFilter) {
                alert("Please select filters.");
            }
            if (!startDate || !endDate) {
                alert("Please select both start and end date.");
                return;
            }

            fetchCommissions({
                filter: commissionFilter,
                start_date: startDate,
                end_date: endDate,
                month_picker: monthPicker,
                year_picker: yearPicker
            });
        });

        // Fetch commissions from server
        function fetchCommissions(params) {
            $.ajax({
                url: "{{ route('branch-user.commissions.filter') }}",
                method: "get",
                data: params,
                success: function(response) {
                    console.log('response.data.totalOutgoingCommisions', response)
                    if (response.status == 'success') {
                        $('#outgoingCommisions').html("₹ " + response.data.totalOutgoingCommisions);
                        $('#incomingCommisions').html("₹ " + response.data.totalIncmingCommisions);
                        $('#transhipmentCommisions').html("₹ " + response.data.totalTranshipmentCommisions);
                    }
                },
                error: function() {
                    alert("Something went wrong while fetching commissions.");
                }
            });
        }
    });
</script>
@endsection


@section('styles')
@parent
<style>
    .dashboard-link {
        color: #292828 !important;
    }
</style>
@endsection