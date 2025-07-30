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
                        <li class="breadcrumb-item active">Accounts</li>
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
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h2 class="card-title mb-0">Accounts List</h2>
                    <a href="{{ url('admin/accounts/create') }}" class="btn btn-sm btn-success shadow-sm">
                        <i class="fa fa-user fa-sm text-white-50"></i> Add Accounts
                    </a>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="table-responsive ">
                        <table class="display" id="account-list">
                            <thead>
                                <tr>
                                    <th>TRANSACTION ID</th>
                                    <th>CLIENT NAME</th>
                                    <th>CREDIT AMOUNT</th>
                                    <th>DEBIT AMOUNT</th>
                                    <th>REMARK</th>
                                    <th>TRANSACTION DATE</th>
                                    <th>CREATED DATE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
@parent
<script>
    $(document).ready(function(e) {
        new DataTable('#account-list', {
            responsive: true,
            ajax: {
                url: "{{ url('admin/accounts/list') }}",
                data: function(d) {
                    // Custom parameters can be added here if needed
                    // Example:
                    // d.filter = $('#filter-input').val();
                }
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'client_name'
                },
                {
                    data: 'credit_amount'
                },
                {
                    data: 'debit_amount'
                },
                {
                    data: 'description'
                },
                {
                    data: 'transaction_date'
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