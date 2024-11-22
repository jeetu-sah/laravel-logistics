@extends('admin.admin_layout.master')
@section('main_content')
    <div class="content-wrapper" style="min-height: 1419.51px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('admin/branches/create') }}"
                            class="d-none d-sm-inline-block shadow-sm">
                            <i class=" fa-sm text-white-50"></i> </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Loading Challan List</li>
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
                    <h3 class="card-title">Loading Challan List</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive ">
                            <table class="display" id="booking-list">
                                <thead>
                                    <tr>
                                        <th>SN.</th>
                                        <th>Challan Number</th>
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
        $(document).ready(function(e) {

            new DataTable('#booking-list', {
                responsive: true,
                ajax: {
                    url: "{{ url('admin/bookings/list') }}",
                    data: function(d) {
                        //d.myKey = 'myValue';
                        // d.custom = $('#myInput').val();
                        // etc
                    }
                },
                columns: [{
                        data: 'sn'
                    },
                    {
                        data: 'bilti_number'
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
