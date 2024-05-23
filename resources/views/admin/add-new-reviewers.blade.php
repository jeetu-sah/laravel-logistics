@extends('admin.layout.layout')
@section('main-content')
    <style>
        label {
            font-weight: 600
        }
    </style>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ $heading }}</h1>
            <a href="{{ url($listUrl) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class=" fa-sm text-white-50"></i> Reviewers List</a>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xl-12">
                <div class="card">

                    <div class="card-body">
                        <form action="{{ route('admin.add_reviewers') }}" method="post" id="form" name="pForm"
                            enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name"
                                        placeholder="First Name" required>
                                    <div class="invalid-feedback">Enter First Name</div>
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name"
                                        placeholder="Last Name" required>
                                    <div class="invalid-feedback">Enter Last Name</div>
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input type="tel" class="form-control" name="mobile" id="mobile"
                                        placeholder="Mobile" onkeypress="return /^\d*$/.test(this.value+event.key)"
                                        maxlength="10" required>
                                    @error('mobile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="invalid-feedback">Enter Mobile</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Email" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="invalid-feedback">Enter Email</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="userType" class="form-label">User Type</label>
                                    <select class="form-select select2 form-control" name="user_type" id="userType"
                                        required>
                                        <option selected disabled value="">Select User Type</option>
                                        <option value="1">Admin</option>
                                        <option value="2">User</option>
                                    </select>
                                    @error('user_type')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="invalid-feedback">Select User Type</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="Password" required>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="invalid-feedback">Enter Password</div>
                                </div>
                                <div class="col-md-6">
                                    <label for="user_status" class="form-label">Status</label>
                                    <select class="form-select select2 form-control" name="user_status" id="user_status"
                                        required>
                                        <option selected disabled value="">Select Status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    @error('user_status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="invalid-feedback">Select Status</div>
                                </div>
                            </div>
                            <button class="btn btn-primary mt-3" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->
@endsection
