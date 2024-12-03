@extends('admin.admin_layout.master')
@section('main_content')
<div class="content-wrapper" style="min-height: 1419.51px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ url('admin/branches/create') }}"
                        class="d-none d-sm-inline-block shadow-sm">
                        <i class="fa-sm text-white-50"></i>
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Create Challan</li>
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
                <h3 class="card-title">Create Challan</h3>
            </div>
            <form action="{{ url('admin/challans/create') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <button type="submit" class="btn btn-primary">
                            <i class="nav-icon fas fa-save"></i>&nbsp;Save
                        </button>
                        &nbsp;
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="display" id="booking-list">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="selectAll" />
                                                <label class="form-check-label" for="selectAll">Select All</label>
                                            </div>
                                        </th>
                                        <th>Bilti Number</th>
                                        <th>Consignee Name</th>
                                        <th>Destinaton</th>
                                        <th>Consignee Address</th>
                                        <th>Payment Mode</th>
                                        <th>Creation Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@section('script')
@parent
<script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>

<script>
    $(document).ready(function(e) {
        $(document).on('click', '#selectAll', function(e) {
            //e.preventDefault();
            if ($(this).prop('checked') == true) {

                //do something
                //alert('test')
            } else {
                // alert('test vdsvs')
            }

            // $('#booking-list').DataTable().draw({
            //     stateSave: true
            // });
            //const allPagesCheckboxes = myTable.api().cells().nodes();
        });



        new DataTable('#booking-list', {
            responsive: true,
            ajax: {
                url: "{{ url('admin/bookings/challan-booking-list') }}",
                data: function(d) {
                    d.bilti_list_type = 'challan';
                    d.custom = $('#selectAll').val();

                }
            },
            columns: [{
                    data: 'sn'
                },
                {
                    data: 'bilti_number'
                },
                {
                    data: 'consignee_name'
                },
                {
                    data: 'consignee_branch_id'

                },
                {
                    data: 'consignee_address'

                },
                {
                    data: 'booking_type'

                },
                {
                    data: 'created_at'

                }
            ],
            'columnDefs': [{
                targets: 0,
                'orderable': false
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