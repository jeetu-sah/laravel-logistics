@extends('admin.admin_layout.master')
@section('main_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('admin/branches') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                class="fa-sm text-white-50"></i> Branch List</a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Create Branch</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                @include('common.notification')
            </div>
        </section>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Branch</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form action="{{ url('admin/distances/store') }}" method="post" id="form" name="pForm"
                            enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-row">

                                <!-- Branch Name -->
                                <div class="col-md-6 mb-2">
                                    <label for="from_branch_id" class="form-label">Branch Name</label>
                                    <select class="form-select select2 form-control js-select2" name="from_branch_id"
                                        id="from_branch_id">
                                        <option value="">From</option>
                                        @foreach ($branch as $branchList)
                                            <option value="{{ $branchList->id }}">{{ $branchList->branch_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Enter Branch name</div>
                                    @error('from_branch_id')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="to_branch_id" class="form-label">To</label>
                                    <select class="form-select select2 form-control js-select2" name="to_branch_id"
                                        id="to_branch_id">
                                        <option value="">Select Branch Name</option>
                                        @foreach ($branch as $branchList)
                                            <option value="{{ $branchList->id }}">{{ $branchList->branch_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Enter Branch name</div>
                                    @error('to_branch_id')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="distance" class="form-label">Distance Between</label>
                                    <input class="form-control" name="distance" id="distance" />

                                    <div class="invalid-feedback">Enter Branch name</div>
                                    @error('distance')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select select2 form-control js-select2" name="status"
                                        id="status">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>

                                    </select>
                                    <div class="invalid-feedback">Enter Status</div>
                                    @error('status')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button class="btn btn-primary mt-3" type="submit">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
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

    <style>
        .select2.select2-container {
            width: 100% !important;
        }

        .select2.select2-container .select2-selection {
            border: 1px solid #ccc;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            height: 42px;
            margin-bottom: 15px;
            outline: none !important;
            transition: all .15s ease-in-out;
        }

        .select2.select2-container .select2-selection .select2-selection__rendered {
            color: #333;
            line-height: 32px;
            padding-right: 33px;
        }

        .select2.select2-container .select2-selection .select2-selection__arrow {
            background: #f8f8f8;
            border-left: 1px solid #ccc;
            -webkit-border-radius: 0 3px 3px 0;
            -moz-border-radius: 0 3px 3px 0;
            border-radius: 0 3px 3px 0;
            height: 40px;
            width: 42px;
        }

        .select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
            background: #f8f8f8;
        }

        .select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
            -webkit-border-radius: 0 3px 0 0;
            -moz-border-radius: 0 3px 0 0;
            border-radius: 0 3px 0 0;
        }

        .select2.select2-container.select2-container--open .select2-selection.select2-selection--multiple {
            border: 1px solid #34495e;
        }

        .select2.select2-container .select2-selection--multiple {
            height: auto;
            min-height: 34px;
        }

        .select2.select2-container .select2-selection--multiple .select2-search--inline .select2-search__field {
            margin-top: 0;
            height: 32px;
        }

        .select2.select2-container .select2-selection--multiple .select2-selection__rendered {
            display: block;
            padding: 0 4px;
            line-height: 29px;
        }

        .select2.select2-container .select2-selection--multiple .select2-selection__choice {
            background-color: #f8f8f8;
            border: 1px solid #ccc;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            margin: 4px 4px 0 0;
            padding: 0 6px 0 22px;
            height: 24px;
            line-height: 24px;
            font-size: 12px;
            position: relative;
        }

        .select2.select2-container .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
            position: absolute;
            top: 0;
            left: 0;
            height: 22px;
            width: 22px;
            margin: 0;
            text-align: center;
            color: #e74c3c;
            font-weight: bold;
            font-size: 16px;
        }

        .select2-container .select2-dropdown {
            background: transparent;
            border: none;
            margin-top: -5px;
        }

        .select2-container .select2-dropdown .select2-search {
            padding: 0;
        }

        .select2-container .select2-dropdown .select2-search input {
            outline: none !important;
            border: 1px solid #34495e !important;
            border-bottom: none !important;
            padding: 4px 6px !important;
        }

        .select2-container .select2-dropdown .select2-results {
            padding: 0;
        }

        .select2-container .select2-dropdown .select2-results ul {
            background: #fff;
            border: 1px solid #34495e;
        }

        .select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
            background-color: #3498db;
        }
    </style>
@endsection
