@extends('admin.admin_layout.master')
@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        Branch Dashboard
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Branch Dashboard</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-12">
                    @if(Session::has('msg'))
                    {!! Session::get("msg") !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <a href="#" class="dashboard-link" style="color:black;">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Employee</span>
                                <span class="info-box-number">
                                    10
                                    <small>%</small>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-4">
                    <a href="#" class="dashboard-link" style="color:black;">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-list"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Booking</span>
                                <span class="info-box-number">41,410</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-4">
                    <a href="#" class="dashboard-link" style="color:black;">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-list"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Completed</span>
                                <span class="info-box-number">760</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Change Settings</h3>
                        </div>
                        <div class="card-body">
                        {{--
                            <form action="{{ route('admin.settings.change') }}" method="post" id="form" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf
                                <div class="row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Change Role</label>
                                    <div class="col-sm-10">
                                        <select class="form-select select2 form-control" name="role" id="role" required>
                                            <option selected disabled value="">Select Role</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" 
                                                    {{ ($selectedRole->role_id == $role->id) ? 'selected' : '' }}
                                                >{{ $role->name }}</option>
                                            @endforeach()
                                            <!-- <option value="reviewer">Reviewer</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Change Language</label>
                                    <div class="col-sm-10">
                                        <select class="form-select select2 form-control" name="user_status" id="user_status" required>
                                            <option selected disabled value="">Select Language</option>
                                            <option value="english">English</option>
                                            <option value="chinese">Chinese</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-3" type="submit">Change</button>
                            </form>
                            --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
<!-- /.row -->

@endsection

@section('styles')
@parent
.dashboard-link {
color: #292828 !important;
}
@endsection