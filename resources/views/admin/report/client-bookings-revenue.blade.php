@extends('admin.admin_layout.master')
@section('main_content')
    <div class="content-wrapper" style="min-height: 1419.51px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('admin/branches/create') }}" class="d-none d-sm-inline-block shadow-sm">
                            <i class=" fa-sm text-white-50"></i> </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }} </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->



        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }} </h3> &nbsp;<b style="font-size: 20px;"> ( {{ ucfirst($ClientDetails[0]->consignee_name) }} )</b>
                </div>
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-3">
                                <a href="{{ url('admin/reports/clients/bookings', ['id' => $clientId]) }}"
                                    class="dashboard-link" style="color:black;">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Total Booking</span>
                                            <span class="info-box-number">
                                                {{ $totalBookings ?? 0 }}
                                                <small></small>
                                            </span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </a>
                            </div>

                            <!-- /.col -->
                            <div class="col-12 col-sm-6 col-md-3">
                                <a href="{{ url('/admin/bookings') }}" class="dashboard-link" style="color:black;">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-list"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Pending Booking</span>
                                            <span
                                                class="info-box-number">{{ $totalBookings - ($deliveredBookings + $inBranchBookings) }}</span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </a>
                            </div>
                            <!-- /.col -->

                            <!-- fix for small devices only -->
                            <div class="clearfix hidden-md-up"></div>

                            <div class="col-12 col-sm-6 col-md-3">
                                <a href="#" class="dashboard-link" style="color:black;">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-success elevation-1"><i
                                                class="fas fa-list"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">In Branch</span>
                                            <span class="info-box-number">{{ $inBranchBookings ?? 0 }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <a href="#" class="dashboard-link" style="color:black;">
                                    <div class="info-box mb-3">
                                        <span class="info-box-icon bg-success elevation-1"><i
                                                class="fas fa-list"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Deleverd</span>
                                            <span class="info-box-number">{{ $deliveredBookings ?? 0 }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-12 col-sm-6 col-md-6">
                                    <a href="{{ url('admin/reports/clients/bookings', ['id' => $clientId]) }}"
                                        class="dashboard-link" style="color:black;">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-info elevation-1"><i
                                                    class="fas fa-list"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Total Booking Revenue</span>
                                                <span class="info-box-number">
                                                    {{ number_format($totalRevenue, 2) ?? 0 }}
                                                    <!-- Format the revenue as needed -->
                                                    <strong>₹</strong> <!-- Add your ₹ symbol, e.g., $, €, etc. -->
                                                </span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <a href="{{ url('admin/reports/clients/bookings', ['id' => $clientId]) }}"
                                        class="dashboard-link" style="color:black;">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-success elevation-1"> ₹
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Paid Booking Revenue</span>
                                                <span class="info-box-number">
                                                    {{ number_format($paidRevenue, 2) ?? 0 }}
                                                    <strong>₹</strong>
                                                </span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6">
                                    <a href="{{ url('admin/reports/clients/bookings', ['id' => $clientId]) }}"
                                        class="dashboard-link" style="color:black;">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-warning elevation-1"><i
                                                    class="fas fa-credit-card"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">To Pay Booking Revenue</span>
                                                <span class="info-box-number">
                                                    {{ number_format($toPayRevenue, 2) ?? 0 }}
                                                    <strong>₹</strong>
                                                </span>
                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-12 col-sm-6 col-md-6">
                                    <a href="{{ url('admin/reports/clients/bookings', ['id' => $clientId]) }}"
                                        class="dashboard-link" style="color:black;">
                                        <div class="">
                                            <div class="info-box-content" style="font-size: 20px;">
                                                <style>
                                                    .info-box-text{
                                                        font-weight: 600
                                                    }
                                                </style>
                                                <!-- First Column -->
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <span class="info-box-text" style="color:blue">Total Booking Amount =
                                                        </span>
                                                    </div><br><br>
                                                    <div class="col-md-4">
                                                        {{ number_format($totalRevenue, 2) ?? 0 }} ₹
                                                    </div>

                                                    <div class="col-md-8">
                                                        <span class="info-box-text" style="color:rgb(166, 136, 47)">Total Delevery Amount =
                                                        </span>
                                                    </div><br><br>
                                                    <div class="col-md-4">
                                                        {{ number_format($totalRevenue, 2) ?? 0 }} ₹
                                                    </div>

                                                    <div class="col-md-8">
                                                        <span class="info-box-text" style="color:green">Total Recived Amount =
                                                        </span>
                                                    </div><br><br>
                                                    <div class="col-md-4">
                                                        {{ number_format($totalRevenue, 2) ?? 0 }} ₹
                                                    </div>

                                                    <div class="col-md-8">
                                                        <span class="info-box-text" style="color:red">Total Pending Amount =
                                                        </span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ number_format($totalRevenue, 2) ?? 0 }} ₹
                                                    </div>




                                                </div>


                                            </div>
                                            <!-- /.info-box-content -->
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- <div class="card-body">
                    <div class="row">
                        <div class="table-responsive ">
                            <table class="display" id="booking-list">
                                <thead>
                                    <tr>
                                        <th>SN.</th>
                                        <th>Bilti Number</th>
                                        <th>Consinger Name</th>
                                        <th>Consinger Address</th>
                                        <th>Consinger Branch</th>
                                        <th>Consignee Name</th>
                                        <th>Destinaton</th>
                                        <th>Consignee Address</th>

                                        <th>Payment Mode</th>
                                        <th>Creation Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> --}}
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection

@section('script')
    @parent
    <!-- <script src="{{ asset('datatables/jquery.min.js') }}"></script> -->
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>

    {{-- <script>
        $(document).ready(function() {
            // Initialize the DataTable
            var table = $('#booking-list').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('admin/reports/clients/bookings/list') }}",
                    data: function(d) {
                        // Add custom filter data to the DataTable request
                        d.client_id = $('#client_id').val(); // Get selected booking type
                        d.booking_type = $('#booking_type').val(); // Get selected booking type
                        d.status = $('#status').val(); // Get selected booking type
                        d.from_date = $('#from_date').val(); // Get "From Date"
                        d.to_date = $('#to_date').val(); // Get "To Date"
                    }
                },
                columns: [{
                        data: 'sn'
                    },
                    {
                        data: 'bilti_number'
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
                        data: 'consignee_name'
                    },
                    {
                        data: 'consignee_branch_id'
                    },
                    {
                        data: 'consignee_address'
                    },
                    {
                        data: 'booking_type'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'action',
                        orderable: false
                    }
                ]
            });

            // Function to apply the filters and reload DataTable
            window.applyFilter = function() {
                // Trigger the DataTable to reload with the applied filters
                table.ajax.reload();
            };
        });
    </script> --}}
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
@endsection
