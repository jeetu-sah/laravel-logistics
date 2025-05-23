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
                <h3 class="card-title">Branch Settings</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('branch-user.settings') }}" method="post" id="form" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="prefix_employee_id" class="form-label">Prefix Employee Id</label>
                                <input type="text"
                                    name="prefix_employee_id"
                                    class="form-control"
                                    id="prefix_employee_id"
                                    value="{{ $settings?->prefix_employee_id }}"
                                    placeholder="Prefix Employee Id" required />

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_for_single_parcel" class="form-label">Price For Single Parcel</label>
                                <input type="text"
                                    name="price_for_single_parcel"
                                    class="form-control"
                                    id="price_for_single_parcel"
                                    value="{{ $settings?->price_for_single_parcel }}"
                                    placeholder="Price For Single Parcel" required />

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="prefix_employee_id" class="form-label">Prefix Employee Id</label>
                                <input type="text"
                                    name="prefix_employee_id"
                                    class="form-control"
                                    id="prefix_employee_id"
                                    value="{{ $settings?->prefix_employee_id }}"
                                    placeholder="Prefix Employee Id" required />

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_for_single_parcel" class="form-label">Price For Single Parcel</label>
                                <input type="text"
                                    name="price_for_single_parcel"
                                    class="form-control"
                                    id="price_for_single_parcel"
                                    value="{{ $settings?->price_for_single_parcel }}"
                                    placeholder="Price For Single Parcel" required />

                            </div>
                        </div>

                    </div>
                  
                    <button class="btn btn-primary mt-3" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@endsection