@extends('admin.admin_layout.master')
@section('main_content')
    <div class="content-wrapper" style="min-height: 1419.51px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('admin/delivery') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                class=" fa-sm text-white-50"></i> <b>Back</b></a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><b>Delivery Chalan</b></li>
                        </ol>
                    </div>


                </div>
            </div>
            <div class="row mb-2">
                @include('common.notification')
            </div>
        </section>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($error->all() as $errors)
                        <li>{{ $errors }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="content">
            <div class="container-fluid">
                <form action="{{ url('admin/delivery/deliverd') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $booking->id }}" name="booking_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Delivery Receipt</h3>
                                </div>

                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Delivery Station - {{ $booking->consignee_branch_name }}</th>
                                                <th>Particular</th>
                                                <th>Rs-/</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Row 1 -->
                                            <tr>
                                                <td><label for="delivery_station_1">Booking Station -
                                                        {{ $booking->consignor_branch_name }}</label></td>
                                                <td><label for="particular_1">Freight Charges</label></td>
                                                <td><input type="number" class="form-control" id="rs_amount_1"
                                                        value="" required name="freight_charges" placeholder="₹.00"
                                                        oninput="calculateTotal()"></td>
                                            </tr>

                                            <!-- Row 2 -->
                                            <tr>
                                                <td><label for="delivery_station_2">Offline Bilti -
                                                        {{ $booking->bilti_number }}</label></td>
                                                <td><label for="particular_2">Hamali Charges</label></td>
                                                <td><input type="number" class="form-control" id="rs_amount_2"
                                                        value="" required name="hamali_charges" placeholder="₹.00"
                                                        oninput="calculateTotal()"></td>
                                            </tr>

                                            <!-- Row 3 -->
                                            <tr>
                                                <td><label for="delivery_station_3">Date Of Booking -
                                                        {{ $booking->created_at }}</label></td>
                                                <td><label for="particular_3">Demruge Charges</label></td>
                                                <td><input type="number" class="form-control" id="rs_amount_3"
                                                        value="" required name="demruge_charges" placeholder="₹.00"
                                                        oninput="calculateTotal()"></td>
                                            </tr>

                                            <!-- Row 4 -->
                                            <tr>
                                                <td><label for="delivery_station_4">Number Of Article -
                                                        {{ $booking->no_of_artical }}</label></td>
                                                <td><label for="particular_4">Other Charges</label></td>
                                                <td><input type="number" class="form-control" id="rs_amount_4"
                                                        value="" required name="others_charges" placeholder="₹.00"
                                                        oninput="calculateTotal()"></td>
                                            </tr>

                                            <!-- Row 5 (Grand Total) -->
                                            <tr>
                                                <td><label for="delivery_station_5">Privet Mark</label></td>
                                                <td><label for="particular_5">Grand Total</label></td>
                                                <td><input type="number" class="form-control" id="grand_total"
                                                        value="" required name="grand_total" placeholder="₹.00"
                                                        readonly></td>
                                            </tr>
                                            <tr>
                                                <td><label for="delivery_station_5">Recived By<input type="text" class="mt-2 form-control" id=""
                                                    value="" required name="recived_by" placeholder="Name" maxlength="40"
                                                    ></label></td>
                                                <td><label for="">Reciver mobile<input type="tel" class="form-control mt-2" id=""
                                                    value="" required name="reciver_mobile" placeholder="mobile" maxlength="12"
                                                    ></label></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <script>
                                        function calculateTotal() {
                                            // Get values from each input field
                                            var freightCharges = parseFloat(document.getElementById('rs_amount_1').value) || 0;
                                            var hamaliCharges = parseFloat(document.getElementById('rs_amount_2').value) || 0;
                                            var demrugeCharges = parseFloat(document.getElementById('rs_amount_3').value) || 0;
                                            var otherCharges = parseFloat(document.getElementById('rs_amount_4').value) || 0;

                                            // Calculate grand total
                                            var grandTotal = freightCharges + hamaliCharges + demrugeCharges + otherCharges;

                                            // Set the calculated grand total in the grand total field
                                            document.getElementById('grand_total').value = grandTotal.toFixed(2);
                                        }
                                    </script>


                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            {{-- <a href="{{ url('admin/booking/to-pay-booking') }}" class="btn btn-secondary">Reset</a> --}}
                            <input type="submit" value="Save & Print" class="btn btn-success float-right">
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection


@section('script')
    @parent
    <script>
        function calculateTotal() {
            // Get values from each input field
            var freightCharges = parseFloat(document.getElementById('rs_amount_1').value) || 0;
            var hamaliCharges = parseFloat(document.getElementById('rs_amount_2').value) || 0;
            var demrugeCharges = parseFloat(document.getElementById('rs_amount_3').value) || 0;
            var otherCharges = parseFloat(document.getElementById('rs_amount_4').value) || 0;


            // Calculate grand total
            var grandTotal = freightCharges + hamaliCharges + demrugeCharges + otherCharges;

            // Set the calculated grand total in the grand total field
            document.getElementById('grand_total').value = grandTotal.toFixed(2);
        }
    </script>
    <script src="{{ asset('admin_webu/plugins/select2/js/select2.full.min.js') }} "></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        })

        $(document).ready(function() {
            $(document).on('click', '.dropdown-mobile-code', function(e) {
                e.preventDefault()
                const mobileNumberCode = $(this).text();
                $(this).parent().parent().find('button').text(mobileNumberCode);
                $(this).parent().parent().find('.mobileNumberCode').val(mobileNumberCode);
            });
        });
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
