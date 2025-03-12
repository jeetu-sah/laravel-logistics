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
                        <li class="breadcrumb-item active">Branch Dashboard</li>
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
                                    <th>Consignee Name</th>
                                    <th>Destinaton</th>
                                    <th>Consignee Address</th>

                                    <th>Payment Mode</th>
                                    <th>Booking Date</th>
                                    {{-- <th>Action</th> --}}
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

@section('styles')
@parent
.dashboard-link {
color: #292828 !important;
}
@endsection
@section('script')
    @parent
    <!-- <script src="{{ asset('datatables/jquery.min.js') }}"></script> -->
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>

    <script>
        $(document).ready(function(e) {
            new DataTable('#booking-list', {
                responsive: true,
                ajax: {
                    url: "{{ url('admin/bookings/upcoming-booking') }}",
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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
@endsection