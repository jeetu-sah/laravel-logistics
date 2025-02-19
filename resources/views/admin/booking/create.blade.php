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
                <form action="{{ url('admin/bookings/store') }}" method="POST" enctype="multipart/form-data">
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
                                            <input type="text" value="" name="distance" id="distance"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Freight -->
                                        <div class="col-md-6">
                                            <label for="freight_amount">Freight:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="" name="freight_amount" id="freight_amount"
                                                class="form-control mb-1" />
                                        </div>

                                        <!-- WBC -->
                                        <div class="col-md-6">
                                            <label for="wbc_charges">WBC:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="40" readonly name="wbc_charges"
                                                id="wbc_charges" class="form-control mb-1" />
                                        </div>

                                        <!-- Handling Charges -->
                                        <div class="col-md-6">
                                            <label for="handling_charges">Handling Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="20" name="handling_charges"
                                                id="handling_charges" class="form-control mb-1" />
                                        </div>

                                        <!-- FOV -->
                                        <div class="col-md-6">
                                            <label for="fov_amount">FOV:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="" readonly name="fov_amount" id="fov_amount"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Fuel Charges -->
                                        <div class="col-md-6">
                                            <label for="fuel_amount">Fuel Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="150" name="fuel_amount" id="fuel_amount"
                                                class="form-control mb-1" />
                                        </div>

                                        <!-- Transhipment 1 -->
                                        <div class="col-md-6">
                                            <label for="transhipmen_one_amount">Transhipment 1:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="" readonly name="transhipmen_one_amount"
                                                id="transhipmen_one_amount" class="form-control mb-1"
                                                oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Transhipment 2 -->
                                        <div class="col-md-6">
                                            <label for="transhipmen_two_amount">Transhipment 2:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="" readonly name="transhipmen_two_amount"
                                                id="transhipmen_two_amount" class="form-control mb-1"
                                                oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Transhipment 3 -->
                                        <div class="col-md-6">
                                            <label for="transhipment_three_amount">Transhipment 3:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="" readonly name="transhipment_three_amount"
                                                id="transhipment_three_amount" class="form-control mb-1"
                                                oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Pickup Charges -->
                                        <div class="col-md-6">
                                            <label for="pickup_charges">Pickup Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="" name="pickup_charges" id="pickup_charges"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Hamali Charges -->
                                        <div class="col-md-6">
                                            <label for="hamali_Charges">Hamali Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="20" readonly name="hamali_Charges"
                                                id="hamali_Charges" class="form-control mb-1" />
                                        </div>

                                        <!-- Bilti Charges -->
                                        <div class="col-md-6">
                                            <label for="bilti_Charges">Bilti Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="10" readonly value="10"
                                                name="bilti_Charges" id="bilti_Charges" class="form-control mb-1"
                                                oninput="calculateInvoice()" />
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
                                            <input type="text" value="30" name="compney_charges"
                                                id="compney_charges" class="form-control mb-1"
                                                oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Misc Charges -->
                                        <div class="col-md-6">
                                            <label for="misc_charge_amount">Misc. Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="" name="misc_charge_amount"
                                                id="misc_charge_amount" class="form-control mb-1"
                                                oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Sub Total -->
                                        <div class="col-md-6">
                                            <label for="sub_total">Sub Total:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="" name="sub_total" id="sub_total"
                                                class="form-control mb-1" readonly />
                                        </div>

                                        <!-- GST: CGST, SGST, IGST -->
                                        <div class="col-md-6">
                                            <label for="cgst">CGST:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="" name="cgst" id="cgst"
                                                class="form-control mb-1" readonly />
                                        </div>

                                        <div class="col-md-6">
                                            <label for="sgst">SGST:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="" name="sgst" id="sgst"
                                                class="form-control mb-1" readonly />
                                        </div>

                                        <div class="col-md-6">
                                            <label for="igst">IGST:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="" name="igst" id="igst"
                                                class="form-control mb-1" readonly />
                                        </div>

                                        <!-- Grand Total -->
                                        <div class="col-md-6">
                                            <label for="grand_total">Grand Total:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="" name="grand_total" id="grand_total"
                                                class="form-control mb-1" readonly />
                                        </div>

                                        <!-- Final Amount -->
                                        <div class="col-md-6">
                                            <label for="grand_total_amount">Final Amount:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="" name="grand_total_amount"
                                                id="grand_total_amount" class="form-control mb-1" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <script>
                        function calculateInvoice() {
                            // Get all input values
                            const distance = parseFloat(document.getElementById('distance').value) || 0;
                            const freightAmount = parseFloat(document.getElementById('freight_amount').value) || 0;
                            const wbcCharges = parseFloat(document.getElementById('wbc_charges').value) || 0;
                            const handlingCharges = parseFloat(document.getElementById('handling_charges').value) || 0;
                            const fovAmount = parseFloat(document.getElementById('fov_amount').value) || 0;
                            const fuelAmount = parseFloat(document.getElementById('fuel_amount').value) || 0;
                            const transhipmentOneAmount = parseFloat(document.getElementById('transhipmen_one_amount').value) || 0;
                            const transhipmentTwoAmount = parseFloat(document.getElementById('transhipmen_two_amount').value) || 0;
                            const transhipmentThreeAmount = parseFloat(document.getElementById('transhipment_three_amount').value) || 0;
                            const pickupCharges = parseFloat(document.getElementById('pickup_charges').value) || 0;
                            const hamaliCharges = parseFloat(document.getElementById('hamali_Charges').value) || 0;
                            const biltiCharges = parseFloat(document.getElementById('bilti_Charges').value) || 0;
                            const discount = parseFloat(document.getElementById('discount').value) || 0;
                            const companyCharges = parseFloat(document.getElementById('compney_charges').value) || 0;
                            const miscChargeAmount = parseFloat(document.getElementById('misc_charge_amount').value) || 0;

                            // Calculate Sub Total
                            const subTotal = freightAmount + wbcCharges + handlingCharges + fovAmount + fuelAmount +
                                transhipmentOneAmount + transhipmentTwoAmount + transhipmentThreeAmount +
                                pickupCharges + hamaliCharges + biltiCharges + companyCharges + miscChargeAmount - discount;

                            // Set Sub Total
                            document.getElementById('sub_total').value = subTotal.toFixed(2);

                            // Calculate Grand Total (without GST)
                            const grandTotal = subTotal;

                            // Set Grand Total and Final Amount
                            document.getElementById('grand_total').value = grandTotal.toFixed(2);
                            document.getElementById('grand_total_amount').value = grandTotal.toFixed(2);
                        }

                        // Calculate on page load
                        window.onload = calculateInvoice;
                    </script>
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
        $(document).ready(function() {
            // Event listener for changes in consignor and consignee branch
            $('#consignor_branch_id, #consignee_branch_id').on('change', function() {
                var consignor_branch_id = $('#consignor_branch_id').val();
                var consignee_branch_id = $('#consignee_branch_id').val();

                if (consignor_branch_id && consignee_branch_id) {
                    $.ajax({
                        url: '{{ url('admin/get-distance') }}', // Correct URL for AJAX request
                        method: 'GET',
                        data: {
                            consignor_branch_id: consignor_branch_id,
                            consignee_branch_id: consignee_branch_id
                        },
                        success: function(response) {
                            if (response.distance) {
                                $('#distance').val(response.distance);
                                calculateInvoice(response
                                    .distance
                                ); // Calculate invoice right after fetching distance
                            } else {
                                $('#distance').val('');
                                alert('Error: ' + (response.error || 'Unknown error'));
                            }
                        },
                        error: function() {
                            $('#distance').val('');
                            alert('Failed to fetch distance. Please try again.');
                        }
                    });
                } else {
                    $('#distance').val('');
                }
            });

            // Event listener for changes in the number of articles
            $('#no_of_articles').on('input', function() {
                const noOfArticles = parseFloat($('#no_of_articles').val()) ||
                    1; // Default to 1 if empty or invalid
                calculateInvoiceWithArticles(noOfArticles); // Recalculate based on number of articles
                calculateTransshipment(noOfArticles); // Adjust transshipment charges as well
                calculateFOV(noOfArticles); // Adjust FOV charges as well
            });

            // Event listener for goods value (FOV calculation)
            $('#good_of_value').on('input', function() {
                calculateFOV(); // Recalculate FOV based on goods value
            });
        });

        // Recalculate invoice with number of articles, including transshipment
        function calculateInvoiceWithArticles(noOfArticles) {
            const distance = parseFloat($('#distance').val()) || 0;
            const freightAmount = parseFloat($('#freight_amount').val()) || 0;

            // Call calculateInvoice() directly after updating freight amount based on distance
            calculateInvoice(distance, noOfArticles);
        }

        // Calculate freight based on the distance, including transshipment
        function calculateInvoice(distance, noOfArticles = 1) {
            const perKmRate = 0.20; // Freight rate per kilometer in rupees

            // Calculate freight based on the distance
            const freight = distance * perKmRate;
            const totalFreight = freight * noOfArticles; // Multiply by number of articles
            $('#freight_amount').val(totalFreight.toFixed(2)); // Set the freight value

            // GST rates for Freight
            const cgstRate = 2.5; // CGST rate percentage
            const sgstRate = 2.5; // SGST rate percentage
            const igstRate = 5; // IGST rate percentage (for inter-state)

            // Calculate GST for Freight
            const freightCgst = (totalFreight * cgstRate) / 100;
            const freightSgst = (totalFreight * sgstRate) / 100;

            // For inter-state transactions (no CGST and SGST)
            let freightIgst = 0;
            if (freightCgst === 0 && freightSgst === 0) {
                freightIgst = (totalFreight * igstRate) / 100;
            }

            // Display the calculated GST values
            $('#cgst').val(freightCgst.toFixed(2));
            $('#sgst').val(freightSgst.toFixed(2));
            $('#igst').val(freightIgst.toFixed(2));

            // Retrieve other charges
            const fovAmount = parseFloat($('#fov_amount').val()) || 0;
            const wbc = parseFloat($('#wbc_charges').val()) || 0;
            const handling = parseFloat($('#handling_charges').val()) || 0;
            const fuel = parseFloat($('#fuel_amount').val()) || 0;
            const pickup = parseFloat($('#pickup_charges').val()) || 0;
            const hamali = parseFloat($('#hamali_Charges').val()) || 0;
            const bilti = parseFloat($('#bilti_Charges').val()) || 0;
            const discount = parseFloat($('#discount').val()) || 0;
            const companyCharges = parseFloat($('#compney_charges').val()) || 0;
            const miscCharges = parseFloat($('#misc_charge_amount').val()) || 0;
            const transhipmentOne = parseFloat($('#transhipmen_one_amount').val()) || 0;
            const transhipmentTwo = parseFloat($('#transhipmen_two_amount').val()) || 0;
            const transhipmentThree = parseFloat($('#transhipment_three_amount').val()) || 0;

            // Multiply all charges by the number of articles
            const totalWbc = wbc * noOfArticles;
            const totalHandling = handling * noOfArticles;
            const totalFuel = fuel * noOfArticles;
            const totalPickup = pickup * noOfArticles;
            const totalHamali = hamali * noOfArticles;
            const totalBilti = bilti * noOfArticles;
            const totalFov = fovAmount * noOfArticles;
            const totalCompanyCharges = companyCharges * noOfArticles;
            const totalMiscCharges = miscCharges * noOfArticles;
            const totalTranshipmentOne = transhipmentOne * noOfArticles;
            const totalTranshipmentTwo = transhipmentTwo * noOfArticles;
            const totalTranshipmentThree = transhipmentThree * noOfArticles;

            // Set values for each charge input
            $('#wbc_charges').val(totalWbc.toFixed(2));
            $('#handling_charges').val(totalHandling.toFixed(2));
            $('#fuel_amount').val(totalFuel.toFixed(2));
            $('#pickup_charges').val(totalPickup.toFixed(2));
            $('#hamali_Charges').val(totalHamali.toFixed(2));
            $('#bilti_Charges').val(totalBilti.toFixed(2));
            $('#fov_amount').val(totalFov.toFixed(2));
            $('#compney_charges').val(totalCompanyCharges.toFixed(2));
            $('#misc_charge_amount').val(totalMiscCharges.toFixed(2));
            $('#transhipmen_one_amount').val(totalTranshipmentOne.toFixed(2));
            $('#transhipmen_two_amount').val(totalTranshipmentTwo.toFixed(2));
            $('#transhipment_three_amount').val(totalTranshipmentThree.toFixed(2));

            // Calculate Sub Total (without GST, but including other charges)
            const subTotal = totalFov + totalWbc + totalHandling + totalFuel + totalPickup + totalHamali + totalBilti +
                totalCompanyCharges + totalMiscCharges +
                totalFreight + totalFov + totalTranshipmentOne + totalTranshipmentTwo + totalTranshipmentThree;
            $('#sub_total').val(subTotal.toFixed(2));

            // **Calculate Grand Total** (including Freight GST)
            const grandTotal = subTotal + freightCgst + freightSgst + freightIgst; // Add GST values to Grand Total

            // Final Amount after applying discount
            const finalAmount = grandTotal - discount;

            // Set the Grand Total and Final Amount
            $('#grand_total').val(grandTotal.toFixed(2));
            $('#grand_total_amount').val(finalAmount.toFixed(2));

            // Debug: Log Grand Total
            console.log("Grand Total:", grandTotal.toFixed(2));
        }
    </script>
    <script>
        // Function to calculate Transshipment charges
        function calculateTransshipment() {
            var noOfArticles = parseFloat(document.getElementById('no_of_articles').value) ||
                1; // Default to 1 if invalid or empty

            // Get transhipment select values
            var transhipmentOne = document.getElementById('transhipmen_one').value;
            var transhipmentTwo = document.getElementById('transhipmen_two').value;
            var transhipmentThree = document.getElementById('transhipment_three').value;

            // Initialize transshipment values
            var transshipmentValueOne = 0;
            var transshipmentValueTwo = 0;
            var transshipmentValueThree = 0;

            // If transhipment one is selected, calculate its value
            if (transhipmentOne !== "") {
                transshipmentValueOne = noOfArticles * 40; // Example logic, modify as needed
                document.getElementById('transhipmen_one_amount').value = transshipmentValueOne.toFixed(2);
            } else {
                document.getElementById('transhipmen_one_amount').value = '0.00';
            }

            // If transhipment two is selected, calculate its value
            if (transhipmentTwo !== "") {
                transshipmentValueTwo = noOfArticles * 40; // Example logic, modify as needed
                document.getElementById('transhipmen_two_amount').value = transshipmentValueTwo.toFixed(2);
            } else {
                document.getElementById('transhipmen_two_amount').value = '0.00';
            }

            // If transhipment three is selected, calculate its value
            if (transhipmentThree !== "") {
                transshipmentValueThree = noOfArticles * 40; // Example logic, modify as needed
                document.getElementById('transhipment_three_amount').value = transshipmentValueThree.toFixed(2);
            } else {
                document.getElementById('transhipment_three_amount').value = '0.00';
            }

            // Get other charges (ensure these elements exist in the form)
            var freight_amount = parseFloat(document.getElementById('freight_amount').value) || 0;
            var wbc = parseFloat(document.getElementById('wbc_charges').value) || 0;
            var handling = parseFloat(document.getElementById('handling_charges').value) || 0;
            var fov_amount = parseFloat(document.getElementById('fov_amount').value) || 0;
            var fuel = parseFloat(document.getElementById('fuel_amount').value) || 0;
            var pickup = parseFloat(document.getElementById('pickup_charges').value) || 0;
            var hamali = parseFloat(document.getElementById('hamali_Charges').value) || 0;
            var bilti = parseFloat(document.getElementById('bilti_Charges').value) || 0;
            var discount = parseFloat(document.getElementById('discount').value) || 0;

            // Get company charges
            var totalCompanyCharges = parseFloat($('#compney_charges').val()) || 0;

            // Calculate Sub Total (without GST, but including other charges)
            const subTotal = freight_amount + fov_amount + wbc + handling + fuel + pickup + hamali + bilti +
                totalCompanyCharges +
                transshipmentValueOne + transshipmentValueTwo + transshipmentValueThree;

            // Set the Sub Total
            document.getElementById('sub_total').value = subTotal.toFixed(2);

            // Calculate Grand Total (just the sub-total, as no GST is calculated)
            const grandTotal = subTotal;

            // Final Amount after applying discount
            const finalAmount = grandTotal - discount;

            // Set the Grand Total and Final Amount
            document.getElementById('grand_total').value = grandTotal.toFixed(2);
            document.getElementById('grand_total_amount').value = finalAmount.toFixed(2);
        }
    </script>

    <script>
        // Function to calculate FOV charges
        function calculateFOV() {
            // Get the goods value (use jQuery for consistency)
            var goodsofvalue = parseFloat($('#good_of_value').val()) || 0;

            // FOV calculation (1.5% of goods value)
            if (goodsofvalue <= 0) {
                $('#fov_amount').val('0.00'); // Set FOV to 0 if the goods value is 0 or less
            } else {
                var fovValue = (goodsofvalue * 1.5) / 100; // FOV is 1.5% of the goods value
                $('#fov_amount').val(fovValue.toFixed(2)); // Set FOV value with 2 decimals
            }

            // Recalculate Transshipment and other charges
            calculateTransshipment(); // This will trigger the recalculation of the sub-total, grand total, etc.
        }
    </script>






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
