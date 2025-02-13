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
                <form action="{{ url('admin/clients/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        @include('admin.booking.shared.client_details')
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
                                            <input type="text" value="" name="freight_amount" id="freight_amount"
                                                class="form-control mb-1" readonly />
                                        </div>

                                        <!-- WBC -->
                                        <div class="col-md-6">
                                            <label for="wbc_charges">WBC:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input value="40" type="text" name="wbc_charges" id="wbc_charges"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Handling Charges -->
                                        <div class="col-md-6">
                                            <label for="handling_charges">Handling Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input value="30" type="text" name="handling_charges"
                                                id="handling_charges" class="form-control mb-1"
                                                oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Fuel Charges -->
                                        <div class="col-md-6">
                                            <label for="fuel_amount">Fuel Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="150" name="fuel_amount" id="fuel_amount"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
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
                                            <input type="text" value="20" name="hamali_Charges" id="hamali_Charges"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Bilti Charges -->
                                        <div class="col-md-6">
                                            <label for="bilti_Charges">Bilti Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="10" name="bilti_Charges" id="bilti_Charges"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Discount -->
                                        <div class="col-md-6">
                                            <label for="discount">Discount:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="discount" id="discount" class="form-control mb-1"
                                                oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Company Charges -->
                                        <div class="col-md-6">
                                            <label for="compney_charges">Company Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="40" name="compney_charges" id="compney_charges"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Misc Charges -->
                                        <div class="col-md-6">
                                            <label for="misc_charge_amount">Misc. Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="misc_charge_amount" id="misc_charge_amount"
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

                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            {{-- <a href="{{ url('admin/booking/to-pay-booking') }}" class="btn btn-secondary">Reset</a> --}}
                            <input type="submit" value="Save & Print" class="btn btn-success float-right">
                        </div>
                    </div>
                </form>
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        function calculateInvoice() {
                            // Retrieve the input distance value
                            const distance = parseFloat(document.getElementById('distance').value) ||
                            0; // Input distance in kilometers
                            const perKmRate = 0.20; // Freight rate per kilometer in rupees

                            // Calculate the freight charge based on the distance
                            const freight = distance * perKmRate;
                            document.getElementById('freight_amount').value = freight.toFixed(
                            2); // Setting freight value in the input field

                            // GST rates for Freight
                            const cgstRate = 2.5; // CGST rate percentage
                            const sgstRate = 2.5; // SGST rate percentage
                            const igstRate = 5; // IGST rate percentage (if applicable)

                            // Calculate GST for Freight (CGST and SGST for intra-state, IGST for inter-state)
                            const freightCgst = (freight * cgstRate) / 100;
                            const freightSgst = (freight * sgstRate) / 100;

                            // If both CGST and SGST are 0, we calculate IGST (for inter-state transactions)
                            let freightIgst = 0;
                            if (freightCgst === 0 && freightSgst === 0) {
                                freightIgst = (freight * igstRate) / 100;
                            }

                            // Display the calculated GST values
                            document.getElementById('cgst').value = freightCgst.toFixed(2);
                            document.getElementById('sgst').value = freightSgst.toFixed(2);
                            document.getElementById('igst').value = freightIgst.toFixed(2);

                            // Retrieve other charges as before
                            const wbc = parseFloat(document.getElementById('wbc_charges').value) || 0;
                            const handling = parseFloat(document.getElementById('handling_charges').value) || 0;
                            const fuel = parseFloat(document.getElementById('fuel_amount').value) || 0;
                            const pickup = parseFloat(document.getElementById('pickup_charges').value) || 0;
                            const hamali = parseFloat(document.getElementById('hamali_Charges').value) || 0;
                            const bilti = parseFloat(document.getElementById('bilti_Charges').value) || 0;
                            const discount = parseFloat(document.getElementById('discount').value) || 0;
                            const companyCharges = parseFloat(document.getElementById('compney_charges').value) || 0;
                            const miscCharges = parseFloat(document.getElementById('misc_charge_amount').value) || 0;

                            // Calculate Sub Total (without GST, but including other charges)
                            const subTotal = wbc + handling + fuel + pickup + hamali + bilti + companyCharges + miscCharges +
                                freight;
                            document.getElementById('sub_total').value = subTotal.toFixed(2);

                            // Calculate Grand Total including Freight GST (CGST and SGST, or IGST)
                            const grandTotal = subTotal + freightCgst + freightSgst + freightIgst;

                            // Final Amount after applying discount
                            const finalAmount = grandTotal - discount;

                            // Set the Grand Total and Final Amount
                            document.getElementById('grand_total').value = grandTotal.toFixed(2);
                            document.getElementById('grand_total_amount').value = finalAmount.toFixed(2);
                            calculateInvoice();
                        }

                        // Add event listeners to input fields to recalculate totals when values change
                        const fields = [
                            'distance', 'wbc_charges', 'handling_charges', 'fuel_amount', 'pickup_charges',
                            'hamali_Charges', 'bilti_Charges', 'discount', 'compney_charges', 'misc_charge_amount'
                        ];

                        // Add event listeners for all fields to trigger the calculation on change
                        fields.forEach(fieldId => {
                            const field = document.getElementById(fieldId);
                            if (field) {
                                field.addEventListener('input', calculateInvoice);
                            } else {
                                console.warn(`Element with ID ${fieldId} not found.`);
                            }
                        });

                        // Initialize the calculation on page load
                        calculateInvoice();
                    });
                </script>

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
  <script>
    $(document).ready(function() {
        $('#consignor_branch_id, #consignee_branch_id').on('change', function() {
            var consignor_branch_id = $('#consignor_branch_id').val();
            var consignee_branch_id = $('#consignee_branch_id').val();

            // Check if both values are selected
            if (consignor_branch_id && consignee_branch_id) {
                // Make an AJAX request to fetch the distance
                $.ajax({
                    url: '{{ url('admin/get-distance') }}', // Corrected the duplicate `url` field
                    method: 'GET',
                    data: {
                        consignor_branch_id: consignor_branch_id,
                        consignee_branch_id: consignee_branch_id
                    },
                    success: function(response) {
                        // Check if response contains distance
                        if (response.distance) {
                            // Update the page with the distance
                            $('#distance').val(response.distance); // Assuming 'distance' is an input field

                            // Call calculateInvoice() after updating the distance
                            calculateInvoice(response.distance);
                        } else {
                            // Handle error if distance is not found
                            $('#distance').val('');
                            alert('Error: ' + (response.error || 'Unknown error'));
                        }
                    },
                    error: function() {
                        // Handle failed request
                        $('#distance').val('');
                        alert('Failed to fetch distance. Please try again.');
                    }
                });
            } else {
                // If either branch ID is not selected, clear the displayed distance
                $('#distance').val('');
            }
        });
    });

    // Calculate freight based on the distance
    function calculateInvoice(distance) {
        const perKmRate = 0.20; // Freight rate per kilometer in rupees

        // Calculate the freight charge based on the distance
        const freight = distance * perKmRate;
        $('#freight_amount').val(freight.toFixed(2)); // Set the freight value in the input field

        // GST rates for Freight
        const cgstRate = 2.5; // CGST rate percentage
        const sgstRate = 2.5; // SGST rate percentage
        const igstRate = 5; // IGST rate percentage (if applicable)

        // Calculate GST for Freight (CGST and SGST for intra-state, IGST for inter-state)
        const freightCgst = (freight * cgstRate) / 100;
        const freightSgst = (freight * sgstRate) / 100;

        // If both CGST and SGST are 0, we calculate IGST (for inter-state transactions)
        let freightIgst = 0;
        if (freightCgst === 0 && freightSgst === 0) {
            freightIgst = (freight * igstRate) / 100;
        }

        // Display the calculated GST values
        $('#cgst').val(freightCgst.toFixed(2));
        $('#sgst').val(freightSgst.toFixed(2));
        $('#igst').val(freightIgst.toFixed(2));

        // Retrieve other charges as before
        const wbc = parseFloat($('#wbc_charges').val()) || 0;
        const handling = parseFloat($('#handling_charges').val()) || 0;
        const fuel = parseFloat($('#fuel_amount').val()) || 0;
        const pickup = parseFloat($('#pickup_charges').val()) || 0;
        const hamali = parseFloat($('#hamali_Charges').val()) || 0;
        const bilti = parseFloat($('#bilti_Charges').val()) || 0;
        const discount = parseFloat($('#discount').val()) || 0;
        const companyCharges = parseFloat($('#compney_charges').val()) || 0;
        const miscCharges = parseFloat($('#misc_charge_amount').val()) || 0;

        // Calculate Sub Total (without GST, but including other charges)
        const subTotal = wbc + handling + fuel + pickup + hamali + bilti + companyCharges + miscCharges + freight;
        $('#sub_total').val(subTotal.toFixed(2));

        // Calculate Grand Total including Freight GST (CGST and SGST, or IGST)
        const grandTotal = subTotal + freightCgst + freightSgst + freightIgst;

        // Final Amount after applying discount
        const finalAmount = grandTotal - discount;

        // Set the Grand Total and Final Amount
        $('#grand_total').val(grandTotal.toFixed(2));
        $('#grand_total_amount').val(finalAmount.toFixed(2));
    }

    // Add event listeners to input fields to recalculate totals when values change
    const fields = [
        'distance', 'wbc_charges', 'handling_charges', 'fuel_amount', 'pickup_charges',
        'hamali_Charges', 'bilti_Charges', 'discount', 'compney_charges', 'misc_charge_amount'
    ];

    fields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (field) {
            field.addEventListener('input', function() {
                const distance = parseFloat($('#distance').val()) || 0;
                if (distance > 0) {
                    calculateInvoice(distance);
                }
            });
        } else {
            console.warn(`Element with ID ${fieldId} not found.`);
        }
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
