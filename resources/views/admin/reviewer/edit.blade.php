@extends('admin.admin_layout.master')
@section('main_content')
<div class="content-wrapper" style="min-height: 1419.51px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ url('admin/reviewers') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class=" fa-sm text-white-50"></i> Reviewers List</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Reviewer</li>
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
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Reviewer</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action='{{ url("admin/reviewers/update/$reviwer->id") }}' method="post" id="form" name="pForm" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" value="{{$reviwer->first_name ?? ''}}" required>
                                <div class="invalid-feedback">Enter First Name</div>
                                @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" value="{{$reviwer->last_name ?? ''}}" class="form-control" name="last_name" id="last_name" placeholder="Last Name" required>
                                <div class="invalid-feedback">Enter Last Name</div>
                                @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="mobile" class="form-label">Mobile</label>
                                <input type="tel" class="form-control" name="mobile" id="mobile" value="{{$reviwer->mobile ?? ''}}" placeholder="Mobile" onkeypress="return /^\d*$/.test(this.value+event.key)" maxlength="10" required>
                                @error('mobile')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="invalid-feedback">Enter Mobile</div>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" value="{{$reviwer->email ?? ''}}" class="form-control" id="email" placeholder="Email" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="invalid-feedback">Enter Email</div>
                            </div>
                            <div class="col-md-6">
                                <label for="userType" class="form-label">User Type</label>
                                <select class="form-select select2 form-control" name="user_type" id="userType" required>
                                    <option selected disabled value="">Select User Type</option>
                                    <option value="author" {{ ($reviwer->user_type == 'author' ? 'selected' : '') }}>Author</option>
                                    <option value="reviewer" {{ ($reviwer->user_type == 'reviewer' ? 'selected' : '') }}>Reviewer</option>
                                </select>
                                @error('user_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="invalid-feedback">Select User Type</div>
                            </div>
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="invalid-feedback">Enter Password</div>
                            </div>
                            <div class="col-md-6">
                                <label for="user_status" class="form-label">Status</label>
                                <select class="form-select select2 form-control" name="user_status" id="user_status" required>
                                    <option selected disabled value="">Select Status</option>
                                    <option value="active" {{ ($reviwer->user_status == 'active' ? 'selected' : '') }}>Active</option>
                                    <option value="inactive" {{ ($reviwer->user_status == 'inactive' ? 'selected' : '') }}>Inactive</option>
                                </select>
                                @error('user_status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="invalid-feedback">Select Status</div>
                            </div>
                        </div>
                        <div class="form-row mt-3 ml-3">
                            @foreach($roles as $role)
                            <div class="col-md-3">
                                <div class="role_user">
                                    <input class="form-check-input" id="role-{{ $role->id }}" type="checkbox" value="{{ $role->id }}" name="roles[]" {{ $reviwer->hasRole($role->name) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->name ?? ''}}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button class="btn btn-primary mt-3" type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->


    </section>
    <!-- /.content -->
</div>

@endsection