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
                            <div class="form-group">
                                <label for="article_type" class="form-label">Select Article Type</label>
                                <select class="form-select form-control" name="article_type" id="article_type" required>
                                    <option selected disabled value="">Select Status</option>
                                    @foreach($articleTypes as $articleType)
                                    <option value="{{ $articleType->id }}">{{$articleType->name}}</option>
                                    @endforeach
                                    <!-- <option value="inactive">Inactive</option> -->
                                </select>
                                <div class="invalid-feedback">Select the valid article type</div>
                                @error('article_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="item_type" class="form-label">Select Item Type</label>
                                <select class="form-select form-control" name="item_type" id="item_type" required>
                                    <option selected disabled value="">Select Item Type</option>
                                    @foreach($itemTypes as $itemType)
                                    <option value="{{ $itemType->id }}">{{ $itemType->name}}</option>
                                    @endforeach

                                </select>
                                <div class="invalid-feedback">Select the valid item type</div>
                                @error('item_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title_page" class="form-label">Description</label>
                                <input type="text" class="form-control" name="title_page" id="title_page" placeholder="Title Page" value="{{ old('title_page') }}" required>
                                <div class="invalid-feedback">Select the valid article type</div>
                                @error('article_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label>Select Reviewers</label>
                                <select class="form-control select2" name="reviewer" style="width: 100%;">
                                    @foreach($reviewers as $reviewer)
                                    <option value="{{ $reviewer->id }}">{{ $reviewer->full_name }} [{{ $reviewer->userId }}]</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Add New Reviewers</label>
                                <a target="_blank" href="{{ url('admin/reviewers/create') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                    <i class=" fa-sm text-white-50"></i>Create Reviewers </a>
                            </div>
                        </div>

                    </div>
                    <div class="row">
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

@section('script')
@parent
<script src="{{ asset('admin_webu/plugins/select2/js/select2.full.min.js') }} "></script>

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    })
</script>

@endsection


@section('styles')
@parent
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('admin_webu/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin_webu/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

@endsection