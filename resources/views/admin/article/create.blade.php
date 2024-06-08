@extends('admin.admin_layout.master')
@section('main_content')
<div class="content-wrapper" style="min-height: 1419.51px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ url('admin/reviewers') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class=" fa-sm text-white-50"></i> Article List</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Create Article</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Article</h3>
            </div>
            <div class="card-body">

                <form action="{{ route('admin.add_reviewers') }}" method="post" id="form" name="pForm" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">Select Article Type</label>
                            <select class="form-select select2 form-control" name="user_status" id="user_status" required>
                                <option selected disabled value="">Select Status</option>
                                @foreach($articleTypes as $articleType)
                                <option value="{{ $articleType->id }}">{{$articleType->name}}</option>
                                @endforeach
                                <!-- <option value="inactive">Inactive</option> -->
                            </select>
                            <div class="invalid-feedback">Enter First Name</div>
                            @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" required>
                            <div class="invalid-feedback">Enter Last Name</div>
                            @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputFile">Browse File</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    
                                </div>
                                <small id="emailHelp" class="form-text text-danger">Please upload one file (Title page), containing the title of your manuscript, all author names (in the correct order), affiliation(s) and address(es) of correspondence.</small>
                            </div>
                         

                            <div class="invalid-feedback">Enter First Name</div>
                            @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
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