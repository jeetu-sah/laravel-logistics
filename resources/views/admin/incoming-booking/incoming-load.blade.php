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
                                    <th>Bilti Number</th>
                                    <th>Consinger Branch</th>
                                    <th>Consignee Branch</th>
                                    <th>Number of article</th>
                                    <th>Payment Mode</th>
                                    <th>Transhipment</th>
                                    <th>Creation Date</th>
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
                    data: 'consignor_branch'
                },
                {
                    data: 'consignee_branch'
                },
                {
                    data: 'no_of_artical'
                },
                {
                    data: 'booking_type'

                },
                {
                    data: 'transhipment'
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