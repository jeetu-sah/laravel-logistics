@extends('admin.admin_layout.master')
@section('main_content')
<div class="content-wrapper" style="min-height: 1419.51px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ url('admin/branches/create') }}"
                        class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                        <i class=" fa-sm text-white-50"></i>Create Branch </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Branch List</li>
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
                <h3 class="card-title">Branch List</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive ">
                        <table class="display" id="branch-list">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Branch Code</th>
                                    <th>Branch Name</th>
                                    <th>Branch Owner Name</th>
                                    <th>GST No.</th>
                                    <th>Status</th>
                                    <th>Password</th>
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

<script>
    $(document).ready(function(e) {

        new DataTable('#branch-list', {
            responsive: true,
            ajax: {
                url: "{{ url('admin/branches/list') }}",
                data: function(d) {
                    //d.myKey = 'myValue';
                    // d.custom = $('#myInput').val();
                    // etc
                }
            },
            columns: [{
                    data: 'sn'
                },
                {
                    data: 'branch_code'
                },
                {
                    data: 'branch_name'
                },
                {
                    data: 'owner_name'
                },
                {
                    data: 'gst'

                },
                {
                    data: 'user_status'
                },
                {
                    data: 'identity'
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