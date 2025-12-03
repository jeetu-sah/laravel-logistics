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
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive ">
                        <table class="display" id="incoming-booking-list">
                            <thead>
                                <tr>
                                    <th>{{ __('Bilti No.') }}</th>
                                    <th>{{ __('Offline Bilti No / Date.') }}</th>
                                    <th>{{ __('Consignor Name') }}</th>
                                    <th>{{ __('Consignee Name') }}</th>
                                    <th>{{ __('Article') }}</th>
                                    <th>{{ __('Payment Mode') }}</th>
                                    <th>{{ __('Driver Details') }}</th>
                                    <th>{{ __('Challan No.') }}</th>
                                    <th>{{ __('Transhipment') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Creation Date') }}</th>

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
        new DataTable('#incoming-booking-list', {
            responsive: true,
            ajax: {
                url: "{{ url('admin/incoming-booking/list') }}",
                data: function(d) {}
            },
            columns: [{
                    data: 'bilti_number'
                },
                {
                    data: null,
                    name: 'offline_bilti_number',
                    render: function(data, type, row) {
                        let bilty = row.manual_bilty_number ? row.manual_bilty_number : '-';
                        let date = row.offline_booking_date ? row.offline_booking_date : '-';

                        return bilty + ' / ' + date;
                    }
                },

                {
                    data: 'consignor_name'
                },
                {
                    data: 'consignee_name'
                },
                {
                    data: 'no_of_artical'
                },
                {
                    data: 'booking_type'

                },
                {
                    data: 'driver_name_details',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'challan_number',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'transhipment',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'grand_total_amount'
                },
                {
                    data: 'created_at'
                }
            ],
            columnDefs: [{
                targets: [3, 5],
                orderable: false
            }],

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