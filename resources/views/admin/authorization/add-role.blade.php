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
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card">

                    <div class="card-body">
                        <form action="{{ route('admin.add-role') }}" method="post" id="form" name="pForm"
                            enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Role Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Name" required>
                                    <div class="invalid-feedback">Enter Name</div>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
