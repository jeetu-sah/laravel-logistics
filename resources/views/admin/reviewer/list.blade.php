@extends('admin.layout.layout')

@section('main-content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reviewers</h1>
        <a href="{{ url('admin/reviewers/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fa-sm text-white-50"></i> Add Reviewers</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive ">
                        <table class="table table-bordered table-striped" id="reviewers-list">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email / Login ID</th>
                                    <th>Mobile</th>
                                    <th>User Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
<!-- <script src="{{ asset('datatables/jquery.min.js') }}"></script> -->
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script>
    $(document).ready(function(e) {

        new DataTable('#reviewers-list', {
            ajax: {
                url: "{{ url('admin/reviewers/list') }}",
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
                    data: 'email'
                },
                {
                    data: 'mobile'
                },
                {
                    data: 'user_type'
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
<link href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.css" />
</script>

@endsection