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
    });
</script>
@endsection

@section('styles')
@parent
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
@endsection