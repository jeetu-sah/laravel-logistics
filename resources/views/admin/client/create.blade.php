@extends('admin.admin_layout.master')

@section('main_content')
    <div class="content-wrapper" style="min-height: 1419.51px;">
        <!-- Content Header (Page header) -->

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ $tittle }}</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/clients/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="date">Name:</label>
                                <input type="text" placeholder="Name:" name="client_name" class="form-control mb-1" />
                                @error('client_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="date">Address:</label>
                                <input type="text" name="client_address" placeholder="Address" class="form-control mb-1" />
                                @error('client_address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <label for="date">mobile:</label>
                                <input type="text" name="client_phone_number" placeholder="mobile" class="form-control mb-1" />
                                @error('client_phone_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="date">GST:</label>
                                <input type="text" name="client_gst_number" placeholder="GST" class="form-control mb-1" />
                                @error('client_gst_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                       

                        <div class="row">
                            <div class="col-md-6">
                                <label for="date">Email:</label>
                                <input type="text" name="client_email" placeholder="Email" class="form-control mb-1" />
                                @error('client_email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="col-md-6">

                                <label for="date">Aadhar card</label>
                                <input type="text" name="client_aadhar_card" placeholder="Aadhar card" class="form-control mb-1 mb-1" />
                                @error('aadhar_card')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12">
                                {{-- <a href="{{ url('admin/booking/to-pay-booking') }}" class="btn btn-secondary">Reset</a> --}}
                                <input type="submit" value="Save" class="btn btn-success float-right">
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
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
