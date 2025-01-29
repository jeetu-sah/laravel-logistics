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

        <section class="content">
            <div class="container-fluid">
                <form action="{{ url('admin/bookings/paid-booking') }}" method="POST">
                    @csrf
                    <div class="row">
                        @include('admin.booking.shared.consigner_details')
                        <div class="col-md-3">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Invoice</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Distance -->
                                        <div class="col-md-6">
                                            <label for="distance">Distance (KM):</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="distance" id="distance" class="form-control mb-1"
                                                oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Freight -->
                                        <div class="col-md-6">
                                            <label for="freight_amount">Freight:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="freight_amount" id="freight_amount"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- WBC -->
                                        <div class="col-md-6">
                                            <label for="wbc_charges">WBC:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" readonly name="wbc_charges" id="wbc_charges"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Handling Charges -->
                                        <div class="col-md-6">
                                            <label for="handling_charges">Handling Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="handling_charges" id="handling_charges"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- FOV -->
                                        <div class="col-md-6">
                                            <label for="fov_amount">FOV:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" readonly name="fov_amount" id="fov_amount"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Fuel Charges -->
                                        <div class="col-md-6">
                                            <label for="fuel_amount">Fuel Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="150" name="fuel_amount" id="fuel_amount"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Transhipment 1 -->
                                        <div class="col-md-6">
                                            <label for="transhipmen_one_amount">Transhipment 1:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" readonly name="transhipmen_one_amount" id="transhipmen_one_amount"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Transhipment 2 -->
                                        <div class="col-md-6">
                                            <label for="transhipmen_two_amount">Transhipment 2:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" readonly name="transhipmen_two_amount" id="transhipmen_two_amount"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Transhipment 3 -->
                                        <div class="col-md-6">
                                            <label for="transhipment_three_amount">Transhipment 3:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" readonly name="transhipment_three_amount"
                                                id="transhipment_three_amount" class="form-control mb-1"
                                                oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Pickup Charges -->
                                        <div class="col-md-6">
                                            <label for="pickup_charges">Pickup Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="pickup_charges" id="pickup_charges"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Hamali Charges -->
                                        <div class="col-md-6">
                                            <label for="hamali_Charges">Hamali Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" readonly name="hamali_Charges" id="hamali_Charges"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Bilti Charges -->
                                        <div class="col-md-6">
                                            <label for="bilti_Charges">Bilti Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" readonly value="10" name="bilti_Charges" id="bilti_Charges"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Discount -->
                                        <div class="col-md-6">
                                            <label for="discount">Discount:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="discount" id="discount"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Company Charges -->
                                        <div class="col-md-6">
                                            <label for="compney_charges">Company Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="compney_charges" id="compney_charges"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Sub Total -->
                                        <div class="col-md-6">
                                            <label for="sub_total">Sub Total:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="sub_total" id="sub_total"
                                                class="form-control mb-1" readonly />
                                        </div>

                                        <!-- GST: CGST, SGST, IGST -->
                                        <div class="col-md-6">
                                            <label for="cgst">CGST:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="cgst" id="cgst"
                                                class="form-control mb-1" readonly />
                                        </div>

                                        <div class="col-md-6">
                                            <label for="sgst">SGST:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="sgst" id="sgst"
                                                class="form-control mb-1" readonly />
                                        </div>

                                        <div class="col-md-6">
                                            <label for="igst">IGST:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="igst" id="igst"
                                                class="form-control mb-1" readonly />
                                        </div>

                                        <!-- Grand Total -->
                                        <div class="col-md-6">
                                            <label for="grand_total">Grand Total:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="grand_total" id="grand_total"
                                                class="form-control mb-1" readonly />
                                        </div>

                                        <!-- Misc Charges -->
                                        <div class="col-md-6">
                                            <label for="misc_charge_amount">Misc. Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="misc_charge_amount" id="misc_charge_amount"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Final Amount -->
                                        <div class="col-md-6">
                                            <label for="grand_total_amount">Final Amount:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="grand_total_amount" id="grand_total_amount"
                                                class="form-control mb-1" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function calculateInvoice() {
                                let freight = parseFloat(document.getElementById('freight_amount').value) || 0;
                                let wbc = parseFloat(document.getElementById('wbc_charges').value) || 0;
                                let handling = parseFloat(document.getElementById('handling_charges').value) || 0;
                                let fov = parseFloat(document.getElementById('fov_amount').value) || 0;
                                let fuel = parseFloat(document.getElementById('fuel_amount').value) || 0;
                                let transhipment1 = parseFloat(document.getElementById('transhipmen_one_amount').value) || 0;
                                let transhipment2 = parseFloat(document.getElementById('transhipmen_two_amount').value) || 0;
                                let transhipment3 = parseFloat(document.getElementById('transhipment_three_amount').value) || 0;
                                let pickup = parseFloat(document.getElementById('pickup_charges').value) || 0;
                                let hamali = parseFloat(document.getElementById('hamali_Charges').value) || 0;
                                let bilti = parseFloat(document.getElementById('bilti_Charges').value) || 0;
                                let discount = parseFloat(document.getElementById('discount').value) || 0;
                                let companyCharges = parseFloat(document.getElementById('compney_charges').value) || 0;
                                let miscCharges = parseFloat(document.getElementById('misc_charge_amount').value) || 0;

                                // Subtotal calculation
                                let subtotal = freight + wbc + handling + fov + fuel + transhipment1 + transhipment2 + transhipment3 + pickup +
                                    hamali + bilti + companyCharges + miscCharges - discount;

                                // GST calculation (example, adjust as needed)
                                let cgst = freight * 2.5 / 100; // Example 9% CGST
                                let sgst = freight *  2.5 / 100;// Example 9% SGST
                                let igst = 0; // If applicable

                                // Grand Total calculation
                                let grandTotal = subtotal + cgst + sgst + igst;

                                // Update fields
                                document.getElementById('sub_total').value = subtotal.toFixed(2);
                                document.getElementById('cgst').value = cgst.toFixed(2);
                                document.getElementById('sgst').value = sgst.toFixed(2);
                                document.getElementById('igst').value = igst.toFixed(2);
                                document.getElementById('grand_total').value = grandTotal.toFixed(2);
                                document.getElementById('grand_total_amount').value = grandTotal.toFixed(2);
                            }

                            // Initialize the calculations when the page loads
                            window.onload = calculateInvoice;
                        </script>

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
