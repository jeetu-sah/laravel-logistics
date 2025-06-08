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
                                        <th>Challan Number</th>
                                        <th>Vehicle Number</th>
                                        <th>Driver</th>
                                        <th>Type</th>
                                        <th>Created date</th>
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
            var table = new DataTable('#booking-list', {
                responsive: true,
                ajax: {
                    url: "{{ url('admin/challans/list') }}",
                    data: function(d) {
                        // Optional: You can send more parameters here if needed.
                    }
                },
                columns: [
                    {
                        data: 'challan_number'
                    },
                    {
                        data: 'busNumber'
                    },
                    {
                        data: 'driverName'
                    },
                    {
                        data: 'type'
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

            // Handle click on challan_number
            $(document).on('click', '.challan-number', function(e) {
                var challanNumber = $(this).data('challan-number');
                // Use Ajax to fetch challan details
                $.ajax({
                    url: "{{ url('admin/challans') }}/" + challanNumber,
                    method: 'GET',
                    success: function(response) {
                        // Show challan details in a modal or any other UI component
                        $('#challanDetailsModal').html(response);
                        $('#challanDetailsModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        alert('Error fetching challan details!');
                    }
                });
            });
        });
    </script>
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
@endsection
