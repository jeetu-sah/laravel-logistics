@extends('admin.admin_layout.master')
@section('main_content')
<div class="content-wrapper" style="min-height: 1419.51px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <a href="{{ url('admin/reviewers/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                        <i class=" fa-sm text-white-50"></i>Create Reviewers </a> -->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Role List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Role List</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive ">
                        <table class="table table-bordered table-striped" id="role-list">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Role</th>
                                    <th>Slug</th>
                                    <th>Guard</th>
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
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script>
    $(document).ready(function(e) {

        new DataTable('#role-list', {
            ajax: {
                url: "{{ url('admin/role/list') }}",
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
                    data: 'name'
                },
                {
                    data: 'slug'
                },
                {
                    data: 'guard'
                },
                {
                    data: 'created_at',
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
<link href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
</script>

@endsection