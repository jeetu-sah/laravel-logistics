@extends('admin.admin_layout.master')
@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        Branch Dashboard
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Branch</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-12">
                    @if(Session::has('msg'))
                    {!! Session::get("msg") !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <a href="#" class="dashboard-link" style="color:black;">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Employee</span>
                                <span class="info-box-number">
                                    10
                                    <small>%</small>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-4">
                    <a href="{{ url('/admin/bookings') }}" class="dashboard-link" style="color:black;">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-list"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Booking</span>
                                <span class="info-box-number">{{ $totalBooking ?? 0}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-4">
                    <a href="#" class="dashboard-link" style="color:black;">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-list"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Completed</span>
                                <span class="info-box-number">760</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <!-- <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Area Chart</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div> -->


                    <!-- DONUT CHART -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Booking Charts</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="bookingChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card -->

                    <!-- PIE CHART -->
                    <!-- <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Pie Chart</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div> -->
                </div>
                <!-- /.col (LEFT) -->
                <div class="col-md-6">
                    <!-- <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Line Chart</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div> -->

                    <!-- <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Bar Chart</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div> -->


                    <!--               
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Stacked Bar Chart</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                      
                    </div> -->


                </div>
                <!-- /.col (RIGHT) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Incoming Load</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive ">
                        <table class="display" id="booking-list">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Bilti Number</th>
                                    <th>Offline Bitli</th>
                                    <th>Consinger Name</th>
                                    <th>Consinger Address</th>
                                    <th>Consinger Branch</th>
                                    <th>Destinaton</th>
                                    <th>Payment Mode</th>
                                    <th>Booking Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>



</div>
<!-- /.row -->

@endsection

@section('script')
@parent
<!-- <script src="{{ asset('datatables/jquery.min.js') }}"></script> -->
<script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>

<script>
    $(document).ready(function(e) {
        let bookingReportData;

        // Make the AJAX call
        $.ajax({
            url: "{{ url('branch-user/dashboard/reports') }}",
            method: 'GET',
            data: {
                'test': 'test'
            },
            success: function(response) {
                // Check if response data exists
                if (response && response.data) {
                    var bookingReportData = response.data;
                    // Get chart context
                    var donutChartCanvas = $('#bookingChart').get(0).getContext('2d');

                    // Setup chart data
                    var donutData = {
                        labels: [
                            'No Booking',
                            'Normal Booking',
                            'Client Booking'
                        ],
                        datasets: [{
                            data: bookingReportData?.numberOfbookingReports,
                            backgroundColor: ['#f56954', '#00a65a', '#f39c12'],
                        }]
                    };

                    var donutOptions = {
                        maintainAspectRatio: false,
                        responsive: true,
                    };

                    // Create the chart after data is ready
                    new Chart(donutChartCanvas, {
                        type: 'doughnut',
                        data: donutData,
                        options: donutOptions
                    });
                } else {
                    alert('Invalid data format from server.');
                }
            },
            error: function() {
                alert('Failed to fetch report data. Please try again.');
            }
        });











        new DataTable('#booking-list', {
            responsive: true,
            ajax: {
                url: "{{ url('branch-user/dashboard/bookings/upcoming-booking') }}",
                data: function(d) {
                    // Custom parameters can be added here if needed
                    // Example:
                    // d.filter = $('#filter-input').val();
                }
            },
            columns: [{
                    data: 'sn'
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
                    data: 'address'

                },
                {
                    data: 'consignor_branch_id'
                },
                {
                    data: 'consignee_branch_id'
                },
                {
                    data: 'booking_type'

                },
                {
                    data: 'created_at'

                },
                // {
                //     data: 'action',

                //     orderable: false
                // }
            ],

            processing: true,
            serverSide: true
        });
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
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
@endsection