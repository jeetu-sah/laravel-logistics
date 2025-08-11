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
                            <label for="client_name">Select Client</label>
                            <select id="client_name" name="client_name" class="form-select select2 form-control js-select2">
                                <option value="">--Select Booking Type--</option>
                                @foreach ($client as $clients)
                                    <option value="{{ $clients->id }}">{{ $clients->client_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group d-inline-block mr-3">
                            <label for="booking_type">Booking Type</label>
                            <select id="booking_type" name="booking_type"
                                class="form-select select2 form-control js-select2">
                                <option value="">--Select Booking Type--</option>
                                <option value="Paid">Paid</option>
                                <option value="Topay">To Pay</option>

                            </select>
                        </div>
                        <div class="form-group d-inline-block mr-3">
                            <label for="status">Booking Status</label>
                            <select id="status" name="status" class="form-select select2 form-control js-select2">
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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
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
                        d.client_name = $('#client_name').val(); // Get selected booking type
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
@section('script')
    @parent

    <script src="{{ asset('admin_webu/plugins/select2/js/select2.full.min.js') }} "></script>
@endsection
@section('script')
    @parent
@section('styles')
    @parent
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('admin_webu/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_webu/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <style>
        .select2.select2-container {
            width: 100% !important;
        }

        .select2.select2-container .select2-selection {
            border: 1px solid #ccc;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            height: 42px;
            margin-bottom: 15px;
            outline: none !important;
            transition: all .15s ease-in-out;
        }

        .select2.select2-container .select2-selection .select2-selection__rendered {
            color: #333;
            line-height: 32px;
            padding-right: 33px;
        }

        .select2.select2-container .select2-selection .select2-selection__arrow {
            background: #f8f8f8;
            border-left: 1px solid #ccc;
            -webkit-border-radius: 0 3px 3px 0;
            -moz-border-radius: 0 3px 3px 0;
            border-radius: 0 3px 3px 0;
            height: 40px;
            width: 42px;
        }

        .select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
            background: #f8f8f8;
        }

        .select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
            -webkit-border-radius: 0 3px 0 0;
            -moz-border-radius: 0 3px 0 0;
            border-radius: 0 3px 0 0;
        }

        .select2.select2-container.select2-container--open .select2-selection.select2-selection--multiple {
            border: 1px solid #34495e;
        }

        .select2.select2-container .select2-selection--multiple {
            height: auto;
            min-height: 34px;
        }

        .select2.select2-container .select2-selection--multiple .select2-search--inline .select2-search__field {
            margin-top: 0;
            height: 32px;
        }

        .select2.select2-container .select2-selection--multiple .select2-selection__rendered {
            display: block;
            padding: 0 4px;
            line-height: 29px;
        }

        .select2.select2-container .select2-selection--multiple .select2-selection__choice {
            background-color: #f8f8f8;
            border: 1px solid #ccc;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            margin: 4px 4px 0 0;
            padding: 0 6px 0 22px;
            height: 24px;
            line-height: 24px;
            font-size: 12px;
            position: relative;
        }

        .select2.select2-container .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
            position: absolute;
            top: 0;
            left: 0;
            height: 22px;
            width: 22px;
            margin: 0;
            text-align: center;
            color: #e74c3c;
            font-weight: bold;
            font-size: 16px;
        }

        .select2-container .select2-dropdown {
            background: transparent;
            border: none;
            margin-top: -5px;
        }

        .select2-container .select2-dropdown .select2-search {
            padding: 0;
        }

        .select2-container .select2-dropdown .select2-search input {
            outline: none !important;
            border: 1px solid #34495e !important;
            border-bottom: none !important;
            padding: 4px 6px !important;
        }

        .select2-container .select2-dropdown .select2-results {
            padding: 0;
        }

        .select2-container .select2-dropdown .select2-results ul {
            background: #fff;
            border: 1px solid #34495e;
        }

        .select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
            background-color: #3498db;
        }
    </style>
@endsection
