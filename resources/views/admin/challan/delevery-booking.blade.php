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
                    <button onclick="window.print()" class="btn btn-primary">Print</button>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->

        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header row">
                    <div class="col-sm-2">
                        <h3 class="card-title"><strong>Loading Challan List</strong></h3>
                    </div>
                    <div class="col-sm-2">
                        <strong> Vehicle Number</strong>
                        <hr>
                        <h4>{{ strtoupper($bookings[0]->busNumber) }}</h4>
                    </div>
                    <div class="col-sm-2">
                        <strong>Driver Name</strong>
                        <hr>
                        <h4>{{ strtoupper($bookings[0]->driverName) }}</h4>
                    </div>
                    <div class="col-sm-2">
                        <strong>Driver Mobile</strong>
                        <hr>
                        <h4>{{ strtoupper($bookings[0]->driverMobile) }}</h4>
                    </div>
                    <div class="col-sm-2">
                        <strong> Lock Number</strong>
                        <hr>

                        <h4>{{ strtoupper($bookings[0]->locknumber) }}</h4>
                    </div>
                    <div class="col-sm-1">
                        <strong> Co Loder</strong>
                        <hr>

                        <h4>{{ strtoupper($bookings[0]->coLoder) }}</h4>
                    </div>
                    <div class="col-sm-1">
                        <strong> Dispatch Date</strong>

                        <h6>{{ strtoupper($bookings[0]->created_at) }}</h6>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <div class="row">
                                <form id="bookingForm" action="{{ url('admin/booking/recived') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" value="{{ $bookings[0]->chalanId }}" name="chalan_id">
                                    <div class="table-responsive" style="width:100%">
                                        <table id="example" class="display nowrap" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>S.n</th>
                                                    @if (Auth::user()->branch_user_id == $bookings[0]->consignee_branch_id)
                                                        <th>
                                                            @if ($selectAllButtonDisable->count() > 0)
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="selectAll">
                                                                Select All
                                                            @endif
                                                        </th>
                                                    @endif
                                                    <th>Bilti Number</th>
                                                    <th>Chalan Number</th>
                                                    <th>Origin</th>
                                                    <th>Consignor Name/Mobile/GST</th>
                                                    <th>Destination</th>
                                                    <th>Consignee Name/Mobile/GST</th>

                                                    <th>QTY</th>
                                                    <th>Booking Type</th>
                                                    <th>Booked at</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 1; // Initialize $i outside of the loop
                                                @endphp
                                                @foreach ($bookings as $booking)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        @if (Auth::user()->branch_user_id == $booking->consignee_branch_id)
                                                            <td>
                                                                @if ($booking->status != 3)
                                                                    <input type="checkbox" class="form-check-input"
                                                                        name="selectedBookings[]"
                                                                        value="{{ $booking->id }}" />
                                                                @endif
                                                            </td>
                                                        @endif
                                                        <td>{{ $booking->bilti_number }}</td>
                                                        <td>{{ $booking->challan_number }}</td>
                                                        <td>{{ $booking->consignorBranchName }}</td>

                                                        <td>{{ $booking->consignor_name }}<br>
                                                            {{ $booking->consignor_phone_number }}<br>
                                                            {{ $booking->consignor_gst_number }} </td>

                                                        <td>{{ $booking->consignorBranchName }}<br>
                                                            {{ $booking->consignee_phone_number }} <br>
                                                            {{ $booking->consignee_gst_number }}
                                                        </td>
                                                        <td>{{ $booking->consigneeBranchName }}</td>

                                                        <td>{{ $booking->no_of_artical }}</td>
                                                        <td>
                                                            @if ($booking->booking_type == 'Paid')
                                                                Paid
                                                            @elseif($booking->booking_type == 'Topay')
                                                                To Pay
                                                            @endif
                                                        </td>

                                                        <td>{{ $booking->created_at }}</td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if (Auth::user()->branch_user_id == $booking->consignee_branch_id)
                                        <button type="button" class="btn btn-primary" id="receivedButton">Received</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection

@section('script')
    @parent
    <script>
        document.getElementById('receivedButton').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('input[name="selectedBookings[]"]:checked');
            if (checkboxes.length === 0) {
                alert('Please select at least one booking.');
            } else {
                document.getElementById('bookingForm').submit();
            }
        });

        // Select All functionality
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('input[name="selectedBookings[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
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

            // new DataTable('#challan-booking-list', {
            //     responsive: true,
            //     processing: true,
            //     scrollX: true

            // });

            new DataTable('#example', {
                scrollX: true
            });
        });
    </script>
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
    <style>
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        div.dt-container {
            width: 1237px;
            margin: 0 auto;
        }
    </style>
@endsection
