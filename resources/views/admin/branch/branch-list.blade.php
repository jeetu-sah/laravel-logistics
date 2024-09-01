@extends('admin.admin_layout.master')
@section('main_content')
    <div class="content-wrapper" style="min-height: 1419.51px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('admin/branch/create') }}"
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
                            <table class="table table-bordered table-striped" id="reviewers-list">
                                <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Branch Name</th>
                                        <th>Branch Code</th>
                                        <th>Branch Owner Name</th>
                                        <th>Contact Number</th>
                                        <th>GST No.</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Address 1</th>
                                        <th>Address 2</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($branchDetails as $branch)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $branch->branch_name }}</td>
                                            <td>{{ $branch->branch_code }}</td>
                                            <td>{{ $branch->owner_name }}</td>
                                            <td>{{ $branch->contact }}</td>
                                            <td>{{ $branch->gst }}</td>
                                            <td>{{ $branch->country_name }}</td>
                                            <td>{{ $branch->state_name }}</td>
                                            <td>{{ $branch->city_name }}</td>
                                            <td>{{ $branch->address1 }}</td>
                                            <td>{{ $branch->address2 }}</td>
                                            <td>{{ $branch->user_status }}</td>
                                            <td>
                                                {{-- {{ route('admin.edit-branch', $branch->id) }} --}}

                                                <a href="" class="btn btn-warning btn-sm">Edit</a>

                                            </td>
                                        </tr>
                                    @endforeach
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
                        data: 'sn',

                    },
                    {
                        data: 'branch_code',

                    },
                    {
                        data: 'owner_name',

                    },
                    {
                        data: 'contact_number',

                    },
                    {
                        data: 'gst',

                    },
                    {
                        data: 'country',

                    },
                    {
                        data: 'state',

                    },
                    {
                        data: 'city',

                    },
                    {
                        data: 'address1',

                    },
                    {
                        data: 'address2',

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