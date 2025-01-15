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
    <p class="no-print mx-2">
        <a href="{{ url('admin/challans') }}" class="btn btn-primary">Go Back</a>
        <button onclick="window.print()" class="btn btn-danger">Print</button>
    </p>
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
                    <h3>{{ strtoupper($bookings[0]->busNumber) }}</h3>
                </div>
                <div class="col-sm-2">
                    <strong>Driver Name</strong>
                    <hr>
                    <h3>{{ strtoupper($bookings[0]->driverName) }}</h3>
                </div>
                <div class="col-sm-2">
                    <strong>Driver Mobile</strong>
                    <hr>
                    <h3>{{ strtoupper($bookings[0]->driverMobile) }}</h3>
                </div>
                <div class="col-sm-2">
                    <strong> Lock Number</strong>
                    <hr>

                    <h3>{{ strtoupper($bookings[0]->locknumber) }}</h3>
                </div>
                <div class="col-sm-2">
                    <strong> Dispatch Date</strong>
                    <hr>
                    <h3>{{ strtoupper($bookings[0]->created_at) }}</h3>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <form id="bookingForm" action="{{ url('admin/booking/recived') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{  $bookings[0]->chalanId }}" name="chalan_id">
                        <div class="table-responsive" style="width:100%">
                            <table id="example" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.n</th>
                                        @if (Auth::user()->id == $bookings[0]->consignee_branch_id)

                                        <th>
                                            @if($selectAllButtonDisable->count() > 0)
                                            <input type="checkbox" class="form-check-input" id="selectAll"> 
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
                                        <th>Item Type</th>
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
                                        @if (Auth::user()->id == $booking->consignee_branch_id)

                                        <td>
                                            @if ($booking->status != 3)
                                            <input type="checkbox"
                                                class="form-check-input"
                                                name="selectedBookings[]"
                                                value="{{ $booking->id }}" />
                                            @endif
                                        </td>

                                        @endif
                                        <td>{{ $booking->bilti_number }}</td>
                                        <td>{{ $booking->challan_number }}</td>
                                        <td>{{ $booking->consignorBranchName }}</td>
                                        <td>{{ $booking->consignor_name }}<br> {{ $booking->phone_number_1 }}
                                            {{-- {{ $booking->phone_number_2 }}
                                        </td> --}}

                                        <td>{{ $booking->consigneeBranchName }}</td>
                                        <td>{{ $booking->consignorBranchName }}<br>{{ $booking->consignee_phone_number_1 }}
                                            {{-- {{ $booking->consignee_phone_number_2 }} --}}
                                            <br>{{ $booking->consignee_gst_number }}
                                        </td>

                                        <td>{{ $booking->packing_type }}</td>
                                        <td>{{ $booking->no_of_artical }}</td>
                                        <td>
                                            @if ($booking->booking_type == 1)
                                            Paid
                                            @elseif($booking->booking_type == 2)
                                            To Pay
                                            @elseif($booking->booking_type == 3)
                                            Client Booking
                                            @else
                                            Unknown
                                            @endif
                                        </td>

                                        <td>{{ $booking->created_at }}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-primary" id="receivedButton">Received</button>
                    </form>
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