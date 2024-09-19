@extends('admin.admin_layout.master')
@section('main_content')
<div class="content-wrapper" style="min-height: 1419.51px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ url('branch-user/employees') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class=" fa-sm text-white-50"></i> Reviewers List</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Employees</li>
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
                <h3 class="card-title">Edit Employees</h3>
            </div>
            <div class="card-body">
                <form action='{{ url("branch-user/employees/update/$reviwer->id") }}' method="post" id="form" name="pForm" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" value="{{$reviwer->first_name ?? ''}}" required>
                                <div class="invalid-feedback">Enter First Name</div>
                                @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" value="{{$reviwer->last_name ?? ''}}" class="form-control" name="last_name" id="last_name" placeholder="Last Name" required>
                                <div class="invalid-feedback">Enter Last Name</div>
                                @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mobile" class="form-label">Mobile</label>
                                <input type="tel" class="form-control" name="mobile" id="mobile" value="{{$reviwer->mobile ?? ''}}" placeholder="Mobile" onkeypress="return /^\d*$/.test(this.value+event.key)" maxlength="10" required>
                                @error('mobile')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="invalid-feedback">Enter Mobile</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" value="{{$reviwer->email ?? ''}}" class="form-control" id="email" placeholder="Email" required>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="invalid-feedback">Enter Email</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="position" class="form-label">Position</label>
                                <input type="text" class="form-control" name="position" id="position" placeholder="Position" value="{{$reviwer->position ?? ''}}" required>
                                @error('position')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="department" class="form-label">Department</label>
                                <input type="text" name="department" class="form-control" id="department" value="{{$reviwer->department ?? ''}}"  placeholder="Department" required>
                                @error('department')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="user_status" class="form-label">Status</label>
                                <select class="form-select select2 form-control" name="user_status" id="user_status" required>
                                    <option selected disabled value="">Select Status</option>
                                    <option value="active" {{ ($reviwer->user_status == 'active' ? 'selected' : '') }}>Active</option>
                                    <option value="inactive" {{ ($reviwer->user_status == 'inactive' ? 'selected' : '') }}>Inactive</option>
                                </select>
                                @error('user_status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                   
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="comment" class="form-label">Comment</label>
                                <textarea type="text" class="form-control" name="comment" id="comment" placeholder="Comment">{{$reviwer->reason ?? ''}}</textarea>
                                @error('comment')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
<!-- 
                    <div class="form-row">
                        <div class="ml-3">
                            @foreach($roles as $role)
                            <div class="col-sm-3">
                                <div class="role_user">
                                    <input class="form-check-input" id="role-{{ $role->id }}" type="checkbox" value="{{ $role->id }}" name="roles[]" {{ $reviwer->hasRole($role->name) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="role-{{ $role->id }}">{{ $role->name ?? ''}}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div> -->
                    <div class="row">
                        <button class="btn btn-primary mt-3" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection