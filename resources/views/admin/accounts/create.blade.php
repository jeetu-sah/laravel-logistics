@extends('admin.admin_layout.master')

@section('main_content')
<div class="content-wrapper" style="min-height: 1419.51px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ url('admin/branches/create') }}"
                        class="d-none d-sm-inline-block shadow-sm">
                        <i class=" fa-sm text-white-50"></i> </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Create Accounts </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            @include('common.notification')
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h2 class="card-title mb-0">Create Accounts</h2>
                    <a href="{{ url('admin/accounts/index') }}"
                        class="btn btn-sm btn-success shadow-sm">
                        <i class="fa fa-list fa-sm text-white-50"></i>&nbsp;Accounts List
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <form action="{{ url('admin/accounts/store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="branch_id" id="branch_id" value="{{$branch->id}}" class="form-control mb-1 mb-1" />
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="date">Select Client</label>
                                    <select class="form-select select2 form-control js-select2" name="consignor_branch_id"
                                        id="consignor_branch_id">
                                            <option value="">Select Client</option>
                                            @forelse ($combineClients as $client)
                                            <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                                            @empty
                                              <option value="">No Record found</option>
                                            @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="date">Type</label>
                                     <select class="form-select form-control js-select2" 
                                        name="type" id="type">
                                            <option value="credit">Credit</option>
                                            <option value="debit">Debit</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="date">Amount</label>
                                    <input type="number" name="amount" placeholder="Amount" class="form-control mb-1 mb-1" />
                                </div>
                            </div>
                            <div class="row mt-1 mb-1">
                                <div class="col-md-12">
                                    <label for="date">Transaction Date</label>
                                     <input type="date" name="transaction_date" 
                                        value="{{ date('Y-m-d') }}" 
                                        placeholder="Amount" class="form-control mb-1 mb-1" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="date">Remark</label>
                                    <textarea name="remark" id="remark" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-12">

                                    <input type="submit" value="Save" class="btn btn-primary float-right">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
@parent
<script src="{{ asset(path: 'admin_webu/plugins/select2/js/select2.full.min.js') }} "></script>
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