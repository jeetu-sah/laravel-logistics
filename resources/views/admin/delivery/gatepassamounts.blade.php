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
                        <li class="breadcrumb-item active">Gatepass Amounts</li>
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
                <h3 class="card-title">Gatepass Amounts</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive ">
                        <table class="display" id="gatepass-amount-list">
                            <thead>
                                <tr>
                                    <th>Bilti Number</th>
                                    <th>Delivery Number</th>
                                    <th>Reciver mobile</th>
                                    <th>Recived by</th>
                                    <th>Total Amount</th>
                                    <th>Received Amount</th>
                                    <th>Pending Amount</th>
                                    <th>Created At</th>
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

        new DataTable('#gatepass-amount-list', {
            responsive: true,
            ajax: {
                url: "{{ url('admin/delivery/gatepass/amount/ajax-list') }}",
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
                    data: 'delivery_number'
                },
                {
                    data: 'reciver_mobile'
                },
                {
                    data: 'recived_by'
                },
                {
                    data: 'grand_total'
                },
                {
                    data: 'received_amount'

                },
                {
                    data: 'pending_amount'

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