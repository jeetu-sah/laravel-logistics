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
        </div>
        <div class="row mb-2">
            @include('common.notification')
        </div>
    </section>

    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <button onclick="window.print()" class="btn btn-success mr-1"><i class="fas fa-print"></i>&nbsp;Print</button>
                    @if($challanDetail->user->branch_user_id === $branchId)
                    <a href="{{ url('admin/challans') }}" class="btn btn-primary"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                    @endif

                    <a href="{{ url('admin/challans') }}" class="btn btn-warning"><i class="fas fa-angle-double-left"></i>&nbsp;Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Loading Challan Detail</strong></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                        <tr>
                                            <th>Created By</th>
                                            <th>Vehicle Number</th>
                                            <th>Driver Name</th>
                                            <th>Driver Mobile</th>
                                            <th>Lock Number</th>
                                            <th>Co-Loder</th>
                                            <th>Dispatch Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> <span class="badge badge-danger">{{ ($challanDetail->user->branch_user_id === $branchId) ? ' Self' :  (strtoupper($challanDetail->user->branch->branch_name) ?? 'N/A') }}</td>
                                            <td><a href="pages/examples/invoice.html">{{ strtoupper($challanDetail->busNumber ?? 'N/A') }}</a></td>
                                            <td>{{ strtoupper($challanDetail->driverName ?? 'N/A') }}</td>
                                            <td><span class="badge badge-success">{{ strtoupper($challanDetail->driverMobile ?? 'N/A') }}</span></td>
                                            <td>
                                                <span class="badge badge-info">{{ (strtoupper($challanDetail->locknumber) ?? 'N/A') }}
                                            </td>
                                            <td> {{ strtoupper($challanDetail->coLoder ?? 'N/A') }}</td>
                                            <td> {{ formatDate($challanDetail->created_at) }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <form id="bookingForm" action="{{ url('admin/bookings/booking-received') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $challanDetail->id }}" name="chalan_id">
                            <div class="card-header">
                                <h3 class="card-title"><strong>Loading Challan booking List</strong></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display">
                                        <thead>
                                            <tr>
                                                <th><!-- <input type="checkbox" class="form-check-input" id="selectAll"> --></th>
                                                <th>Created By</th>
                                                <th>Bilti Number</th>
                                                <th>Chalan Number</th>
                                                <th>Origin</th>
                                                <th>Consignor</th>
                                                <th>Consignee</th>
                                                <th>Destination</th>
                                                <th>QTY</th>
                                                <th>Cantain</th>
                                                <th>Booking Type</th>
                                                <th>Booked at</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = 1; @endphp
                                            @foreach ($bookings as $booking)
                                            <tr>
                                                <td>
                                                    @if($booking->visible_for === auth()->user()->branch_user_id)
                                                    <input type="checkbox" name="selectedBookings[]"
                                                        value="{{ $booking->id }}">
                                                    @endif
                                                </td>
                                                <th><span class="badge badge-danger"> {{ $booking->booking_created_by }}</span></th>
                                                <td>{{ $booking->bilti_number }}</td>
                                                <td>{{ $challanDetail->challan_number ?? '--' }}</td>
                                                <td>{{ $booking->consignorBranch->branch_name ?? '--' }}</td>

                                                <td>{{ $booking->consignor_name }}</td>
                                                <td>{{ $booking->consignee_name }}</td>

                                                <td>{{ $booking->consigneeBranch->branch_name ?? '--' }}</td>
                                                <td>{{ $booking->no_of_artical }}</td>
                                                <td>{{ $booking->cantain ?? '--' }}</td>
                                                <td><span class="badge badge-danger">{{$booking->booking_type_name ?? '--'}}</span></td>

                                                <td>{{ formatDate($booking->created_at) }}</td>
                                                <td>
                                                    @if(($challanDetail->user->branch_user_id === $branchId) && ($booking->is_revert_button_visible))
                                                    <a class="btn btn-danger revertbooking" href="#" data-reverturl='{{ url("admin/challans/$challanDetail->id/revert-booking/$booking->id") }}'>Revert Booking</a>
                                                    @else
                                                    {{'--'}}
                                                    @endif
                                                </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                @if($challanDetail->is_received_button_visible)
                                <button type="button" class="btn btn-primary" id="receivedButton">Received</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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

        //revert the booking.
        $(document).on('click', '.revertbooking', function(e) {
            e.preventDefault();
            const url = $(this).data('reverturl');
            if (confirm('Are you sure want to revert this booking?')) {
                window.location.href = url;
            }
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