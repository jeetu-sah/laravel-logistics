@extends('admin.admin_layout.master')
@section('main_content')
<div class="content-wrapper" style="min-height: 1419.51px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <a href="{{ url('branch-user/employees') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class=" fa-sm text-white-50"></i> Employees List</a> -->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Settings</a></li>
                        <li class="breadcrumb-item active">Change Password</li>
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
                <h3 class="card-title">Change Password</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('branch-user/settings/change-password') }}" method="POST" id="form" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="prefix_employee_id" class="form-label">New Password</label>
                                <input type="text"
                                    name="password"
                                    value="{{old('password')}}"
                                    id="password"
                                    class="form-control"
                                    placeholder="Enter Password" required />

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="text"
                                    name="password_confirmation"
                                    value="{{old('password_confirmation')}}"
                                    id="password_confirmation"
                                    class="form-control"
                                    placeholder="Confirm Password" required />
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-3" type="submit">Change Password</button>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@endsection