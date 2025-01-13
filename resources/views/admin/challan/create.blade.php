@extends('admin.admin_layout.master')
@section('main_content')
    <div class="content-wrapper" style="min-height: 1419.51px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('admin/branches/create') }}" class="d-none d-sm-inline-block shadow-sm">
                            <i class="fa-sm text-white-50"></i>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Create Challan</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="modal fade" id="sendDetailsModal" tabindex="-1" aria-labelledby="sendDetailsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="sendDetailsModalLabel">Send Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <form action="{{ url('send-details') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <!-- Input Fields -->
                            <div class="mb-3">
                                <label for="recipientName" class="form-label">Recipient Name</label>
                                <input type="text" class="form-control" id="recipientName" name="recipient_name"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="recipientEmail" class="form-label">Recipient Email</label>
                                <input type="email" class="form-control" id="recipientEmail" name="recipient_email"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                            </div>
                        </div>

                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Challan</h3>
                </div>
                <form action="{{ url('admin/challans/create') }}" method="POST" id="challanForm">
                    @csrf
                    <div class="card-body">
                        
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="busNumber">Bus Number</label>
                                    <input type="text" placeholder="Bus Number" class="form-control" id="busNumber"
                                        name="busNumber" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="driverName">Driver Name</label>
                                    <input type="text" placeholder="Driver Name" class="form-control" id="driverName"
                                        name="driverName" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="driverMobile">Driver Mobile</label>
                                    <input type="text" placeholder="Driver Mobile" class="form-control" id="driverMobile"
                                        name="driverMobile" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="locknumber">Lock Number</label>
                                    <input type="text" placeholder="Lock Number" class="form-control" id="locknumber"
                                        name="locknumber" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="locknumber">Select Status</label>
                                <select class="form-control" >
                                    <option value="">Select Status</option>
                                    <option value="Dipasture">Dipasture</option>
                                    <option value="Pending">Pending</option>
                                   
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
                                                    <label class="form-check-label" for="selectAll">Select All</label>
                                                </div>
                                            </th>
                                            <th>Bilti Number</th>
                                            <th>Consignor Name</th>
                                            <th>Consignor Address</th>
                                            <th>Consignee Name</th>
                                            <th>Consignee Address</th>
                                            <th>Payment Mode</th>
                                            <th>Creation Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data will be dynamically populated by DataTable -->
                                    </tbody>
                                </table>
                                <button type="submit" style="margin-top:8px;" class="btn btn-primary float-right" id="openModalBtn">
                                    <i class="nav-icon fas fa-save"></i>&nbsp;Save & Print
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
            // Handle select all checkbox
            $(document).on('click', '#selectAll', function(e) {
                if ($(this).prop('checked') == true) {
                    // Select all checkboxes
                    $('.form-check-input').prop('checked', true);
                } else {
                    // Deselect all checkboxes
                    $('.form-check-input').prop('checked', false);
                }
            });

            // Initialize DataTable
            new DataTable('#booking-list', {
                responsive: true,
                ajax: {
                    url: "{{ url('admin/bookings/challan-booking-list') }}", // Endpoint to get the booking data
                    data: function(d) {
                        // Send additional data with the request
                        d.bilti_list_type = 'challan'; // Custom parameter for 'challan'
                        d.custom = $('#selectAll').prop(
                            'checked'); // Send the state of the "select all" checkbox
                    },
                    dataSrc: function(json) {
                        // Optional: Process the response before passing to the DataTable
                        return json
                            .data; // Make sure data is correctly formatted as 'data' in the response
                    }
                },
                columns: [{
                        data: 'sn', // Serial Number or Select Checkbox
                        orderable: false // Prevent sorting on the checkbox column
                    },
                    {
                        data: 'bilti_number' // Bilti Number
                    },
                    {
                        data: 'consignor_name' // Consignee Branch
                    },
                    // {
                    //     data: 'consignor_branch_id' // Consignee Name
                    // },

                    {
                        data: 'address' // Consignee Address
                    },
                    {
                        data: 'consignee_name' // Consignee Name
                    },
                    // {
                    //     data: 'consignee_branch_id' // Consignee Branch
                    // },
                    {
                        data: 'consignee_address' // Consignee Address
                    },
                    {
                        data: 'booking_type' // Booking Type
                    },
                    {
                        data: 'created_at' // Created At (Date)
                    }
                ],
                columnDefs: [{
                    targets: 0,
                    orderable: false // Disable sorting for the first column
                }],
                processing: true, // Show processing indicator while data is loading
                serverSide: true // Enable server-side processing
            });
        });
    </script>
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
@endsection
