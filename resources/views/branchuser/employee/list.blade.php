@extends('admin.admin_layout.master')
@section('main_content')
    <div class="content-wrapper" style="min-height: 1419.51px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('branch-user/employees/create') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                            <i class=" fa-sm text-white-50"></i>Create Employee </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Employees List</li>

                        </ol>
                    </div>
                     <div id="toastContainer" class="position-absolute" style="position: absolute; top: 0; right: 0;">
                <div id="statusToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto text-primary">Notification</strong>
                        &nbsp;<small class="">Just now</small>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body text-success" id="toastMessage">
                        <!-- yahan message aayega -->
                    </div>
                </div>
            </div>
                </div>

                <div class="row mb-2">
                    @include('common.notification')
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="card">
                
                <div class="card-header">
                    <h3 class="card-title">Employee List</h3>
                </div>
                <div aria-live="polite" aria-atomic="true" class="position-relative min-height: 200px;">

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive ">
                            <table class="display" id="employee-list">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email / Login ID</th>
                                        <th>Mobile</th>
                                        <th>Status</th>
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
    <script>
        function showToast(message) {
            $('#toastMessage').text(message);
            var toast = new bootstrap.Toast(document.getElementById('statusToast'));
            toast.show();
        }
    </script>
    @parent
    <!-- <script src="{{ asset('datatables/jquery.min.js') }}"></script> -->
    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
    <script>
        $(document).ready(function(e) {

            new DataTable('#employee-list', {
                ajax: {
                    url: "{{ url('branch-user/employees/list') }}",
                    data: function(d) {
                        //d.myKey = 'myValue';
                        // d.custom = $('#myInput').val();
                        // etc
                    }
                },
                columns: [{
                        data: 'sn'
                    },
                    // {
                    //     data: 'id'
                    // },
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
                        data: 'user_status',
                        render: function(user_status, type, row, meta) {
                            let checked = (user_status === 'active') ? 'checked' : '';
                            return `
                          <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input status-toggle" 
                                  id="customSwitch${row.id}" data-id="${row.id}" ${checked}>
                              <label class="custom-control-label" for="customSwitch${row.id}"></label>
                          </div>
                      `;
                        }
                    },
                    {
                        data: 'action',
                        orderable: false
                    }
                ],
                processing: true,
                serverSide: true
            });
            $('#employee-list').on('change', '.status-toggle', function() {
                var id = $(this).data('id');
                var status = $(this).is(':checked') ? 'active' : 'inactive';

                $.ajax({
                    url: "{{ url('branch-user/employees/update-status') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        status: status
                    },
                    success: function(response) {
                        showToast(response.message); // toast function call
                        $('#employee-list').DataTable().ajax.reload(null,
                            false); // table reload
                    },
                    error: function() {
                        showToast("Something went wrong!");
                    }
                });
            });
        });
    </script>
@endsection

@section('styles')
    @parent
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
@endsection
