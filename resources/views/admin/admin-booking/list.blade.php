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
                        <li class="breadcrumb-item active">Booking List</li>
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
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Booking List</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive ">
                        <table class="display" id="booking-list">
                            <thead>
                                <tr>
                                    <th>{{ __('Bilti Number') }}</th>
                                    <th>{{ __('Offline Bitli') }}</th>
                                    <th>{{ __('Consinger Branch') }}</th>
                                    <th>{{ __('Consinger Name') }}</th>
                                    <th>{{ __('Consignee Branch') }}</th>
                                    <th>{{ __('Consignee Name') }}</th>
                                    <th>{{ __('Article') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Payment Mode') }}</th>
                                    <th>{{ __('Next Delivery Location') }}</th>
                                    <th>{{ __('Creation Date') }}</th>
                                    <th>{{ __('Action') }}</th>
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
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteConfirmLabel">
                        <i class="fas fa-exclamation-triangle mr-1"></i> Confirm Delete
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <form id="deleteBookingForm" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="modal-body text-center">
                        <i class="fas fa-trash-alt" style="font-size:40px;color:#dc3545;"></i>
                        <p class="mt-3">Are you sure you want to delete this booking?<br>
                            <strong>This action cannot be undone.</strong>
                        </p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light border" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

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
                url: "{{ url('admin/admin-bookings/list') }}",
                data: function(d) {
                    // Custom parameters can be added here if needed
                    // Example:
                    // d.filter = $('#filter-input').val();
                }
            },
            columns: [{
                    data: 'bilti_number'
                },
                {
                    data: 'offline_bilti'
                },
                {
                    data: 'consignor_branch_id'
                },
                {
                    data: 'consignor_name'
                },
                {
                    data: 'consignee_branch_id'

                },
                {
                    data: 'consignee_name'
                },
                {
                    data: 'no_of_artical'
                },
                {
                    data: 'grand_total_amount',
                },

                {
                    data: 'booking_type'

                },
                {
                    data: 'next_delivery_location'

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
        //delete confirmation 
        $(document).on('click', '.deleteBooking', function(e) {
            e.preventDefault();
            let deleteUrl = $(this).attr('href');
            // Set form action dynamically
            $('#deleteBookingForm').attr('action', deleteUrl);
            // Open modal
            $('#deleteConfirmModal').modal('show');
        });
    });
</script>
@endsection

@section('styles')
@parent
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
<style>
    .modal-content {
        width: 152% !important;
        border-radius: 14px !important;
        overflow: hidden;
        border: none;
        box-shadow: 0px 6px 25px rgba(0, 0, 0, 0.25);
    }

    .modal-header {
        padding: 18px 20px;
        border-bottom: none;
    }

    .modal-body {
        font-size: 16px;
        color: #333;
        padding: 25px 20px;
        text-align: center;
    }

    .modal-body i {
        font-size: 42px;
        color: #dc3545;
        margin-bottom: 15px;
    }

    .modal-footer {
        border-top: none;
        padding: 15px;
        justify-content: center;
        gap: 10px;
    }

    .modal-footer .btn {
        width: 120px;
        font-weight: 600;
        border-radius: 8px;
    }
</style>

@endsection