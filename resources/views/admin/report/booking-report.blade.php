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
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section>
            <div class="card">
                <div class="card-header">
                    <h5>Filter Bookings</h5>
                </div>
                <div class="card-body">
                    <form id="bookingFilterForm">
                        <!-- Booking Type Filter -->
                        <div class="form-group d-inline-block mr-3">
                            <label for="booking_type">Booking Type</label>
                            <select id="booking_type" name="booking_type" class="form-control">
                                <option value="">--Select Booking Type--</option>
                                <option value="Paid">Paid</option>
                                <option value="Topay">To Pay</option>

                            </select>
                        </div>
                        <div class="form-group d-inline-block mr-3">
                            <label for="status">Booking Status</label>
                            <select id="status" name="status" class="form-control">
                                <option value="">--Select Booking Type--</option>
                                <option value="1">Booked</option>
                                <option value="2">Dispatch</option>
                                <option value="3">Recived in Branch</option>
                                <option value="4">Delivered
                                </option>

                            </select>
                        </div>

                        <!-- From Date Filter -->
                        <div class="form-group d-inline-block mr-3">
                            <label for="from_date">From Date</label>
                            <input type="date" id="from_date" name="from_date" class="form-control">
                        </div>

                        <!-- To Date Filter -->
                        <div class="form-group d-inline-block mr-3">
                            <label for="to_date">To Date</label>
                            <input type="date" id="to_date" name="to_date" class="form-control">
                        </div>

                        <!-- Apply Filter Button -->
                        <button type="button" class="btn btn-primary" onclick="applyFilter()">Apply Filter</button>
                    </form>
                </div>
            </div>
        </section>


        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <div class="card-body">
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
                </div>
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

    <script>
        $(document).ready(function() {
            // Initialize the DataTable
            var table = $('#booking-list').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ url('admin/reports/bookings/list') }}",
                    data: function(d) {
                        // Add custom filter data to the DataTable request
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
    </script>
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
@endsection
