@extends('admin.admin_layout.master')

@section('main_content')
<div class="content-wrapper" style="min-height: 1419.51px;">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Client Map to Branches</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            @include('common.notification')
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h2 class="card-title mb-0">Client <span class="text-danger">{{$clientDetails->client_name}}</span> map to branch</h2>
                    <a href="{{ url('admin/clients') }}"
                        class="btn btn-sm btn-success shadow-sm">
                        <i class="fa fa-users fa-sm text-white-50"></i> Client List
                    </a>
                </div>
            </div>
            <div class="card-body">
                @role('Admin')
                <h4>Map to as a Consignor</h4>
                <form class="mt-5" action='{{ url("admin/clients/maps/$clientDetails->id") }}' method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label class="form-label">Select Branches</label>
                            <input type="hidden" name="map_type" value="as_consignor" />

                            <div class="row">
                                @foreach ($branch as $branchList)
                                <div class="col-lg-4 col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            name="client_branch_id[]"
                                            value="{{ $branchList->id }}"
                                            id="branch_{{ $branchList->id }}"
                                            {{ in_array($branchList->id, $selectedConsignorBranches ?? []) ? 'checked' : '' }} />
                                        <label class="form-check-label" for="branch_{{ $branchList->id }}">
                                            {{ $branchList->branch_name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">Client map to branch as Consignor</button>
                </form>

                <hr />
                <h4 class="mt-5">Map to as a Consignee</h4>
                <form class="mt-5" action='{{ url("admin/clients/maps/$clientDetails->id") }}' method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-12 mb-2">
                            <label class="form-label">Select Branches</label>
                            <input type="hidden" name="map_type" value="as_consignee" />

                            <div class="row">
                                @foreach ($branch as $branchList)
                                <div class="col-lg-4 col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            name="client_branch_id[]"
                                            value="{{ $branchList->id }}"
                                            id="branch_consignee_{{ $branchList->id }}"
                                            {{ in_array($branchList->id, $selectedConsigneeBranches ?? []) ? 'checked' : '' }} />
                                        <label class="form-check-label" for="branch_consignee_{{ $branchList->id }}">
                                            {{ $branchList->branch_name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>


                    </div>
                    <button type="submit" class="btn btn-primary">Client map to branch as Consignee</button>
                </form>

                @endrole
            </div>
        </div>
    </section>


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
<script>
    function calculateTransshipment() {
        var noOfArticles = document.getElementById('no_of_articles').value;
        var tans_one = document.getElementById('transhipmen_one').value;
        var tans_two = document.getElementById('transhipmen_two').value;
        var tans_three = document.getElementById('transhipment_three').value;
        if (isNaN(noOfArticles) || noOfArticles <= 0) {
            document.getElementById('result').innerText = "Please enter a valid number of articles.";
            return;
        }
        if (tans_one === "") {
            document.getElementById('transhipmen_one_amount').innerText = "Amount: 0 Rupees";
        } else {
            var transshipmentValue = noOfArticles * 20;
            document.getElementById('transhipmen_one_amount').value = transshipmentValue;
        }
        if (tans_two === "") {
            document.getElementById('transhipmen_two_amount').innerText = "Amount: 0 Rupees";
        } else {
            var transshipmentValue = noOfArticles * 20;
            document.getElementById('transhipmen_two_amount').value = transshipmentValue;
        }
        if (tans_three === "") {
            document.getElementById('transhipment_three_amount').innerText = "Amount: 0 Rupees";
        } else {
            var transshipmentValue = noOfArticles * 20;
            document.getElementById('transhipment_three_amount').value = transshipmentValue;
        }
        if (noOfArticles === "") {
            document.getElementById('wbc_charges').innerText = "Amount: 0 Rupees";
        } else {
            var wbcValue = noOfArticles * 40;
            document.getElementById('wbc_charges').value = wbcValue;
        }
        if (noOfArticles === "") {
            document.getElementById('hamali_Charges').innerText = "Amount: 0 Rupees";
        } else {
            var hamali_Charges = noOfArticles * 20;
            document.getElementById('hamali_Charges').value = hamali_Charges;
        }
    }



    function calculategst() {
        var freight_amount = document.getElementById('freight_amount').value;
        var cgst = document.getElementById('cgst').value;
        var sgst = document.getElementById('sgst').value;

        if (freight_amount === "") {
            document.getElementById('cgst').innerText = "Amount: 0 Rupees";
        } else {
            var cgst = freight_amount * 2.5 / 100;
            document.getElementById('cgst').value = cgst;
        }
        if (freight_amount === "") {
            document.getElementById('sgst').innerText = "Amount: 0 Rupees";
        } else {
            var sgst = freight_amount * 2.5 / 100;
            document.getElementById('sgst').value = sgst;
        }

        if (cgst === "" || sgst === "") {
            if (freight_amount === "") {
                document.getElementById('igst').innerText = "Amount: 0 Rupees";
            } else {
                var igst = freight_amount * 5 / 100;
                document.getElementById('igst').value = igst;
            }
        }


    }

    function grandTotal() {

    }
</script>
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