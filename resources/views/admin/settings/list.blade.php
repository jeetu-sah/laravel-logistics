@extends('admin.admin_layout.master')
@section('main_content')
<div class="content-wrapper" style="min-height: 1419.51px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
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
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h2 class="card-title mb-0">Manage Branch Settings</h2>
                    <a href="{{ url('admin/admin-settings/create') }}"
                        class="btn btn-sm btn-success shadow-sm">
                        <i class="fa fa-cog fa-sm text-white-50"></i> Create Settings
                    </a>
                </div>
            </div>
            <div class="card-body">
                @role('Admin')
                <table class="table" id="settingsTable">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Setting Name</th>
                            <th>Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $sn = 1;
                        @endphp
                        @forelse($settings as $setting)

                        <tr>
                            <td>{{ $sn++ }}.</td>
                            <td>{{$setting->key_name ?? '--'}}</td>
                            <td>{{$setting->value ?? 0}}</td>
                            <td><a class="btn btn-danger" href='{{ url("admin/admin-settings/delete/$setting->id") }}'>Delete</a></td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No payments found.</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
                @endrole
            </div>
        </div>
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
        $('#settingsTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@endsection

@section('styles')
@parent
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.css" />
@endsection