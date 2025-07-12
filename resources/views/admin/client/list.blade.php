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
                        <li class="breadcrumb-item active">Client List</li>
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
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h2 class="card-title mb-0">Client List</h2>
                    <a href="{{ url('admin/clients/create') }}"
                        class="btn btn-sm btn-success shadow-sm">
                        <i class="fa fa-user fa-sm text-white-50"></i> Create Client
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive ">
                        <table class="display" id="booking-list">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Client Name</th>
                                    <th>Address</th>
                                    <th> Mobile</th>
                                    <th>GST</th>
                                    <th>Branch</th>
                                    <th>Email</th>
                                    <th>Adhar Card</th>
                                    <th>Date</th>
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
    $(document).ready(function(e) {
        new DataTable('#booking-list', {
            responsive: true,
            ajax: {
                url: "{{ url('admin/clients/list') }}",
                data: function(d) {
                    // Custom parameters can be added here if needed
                    // Example:
                    // d.filter = $('#filter-input').val();
                }
            },
            columns: [{
                    data: 'sn'
                },

                {
                    data: 'client_name'
                },

                {
                    data: 'client_address'
                },
                {
                    data: 'client_phone_number'

                },

                {
                    data: 'client_gst_number'
                },


                {
                    data: 'client_branch_id'

                },
                {
                    data: 'client_email'

                },

                {
                    data: 'client_aadhar_card'

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

        $(document).on('click', '.delete-client', function(e) {
            e.preventDefault();

            const url = $(this).attr('href');
            const confirmed = confirm('Are you sure you want to delete this setting?');

            if (confirmed) {
                window.location.href = url;
            }
        });
    });
</script>
@endsection

@section('styles')
@parent
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
@endsection