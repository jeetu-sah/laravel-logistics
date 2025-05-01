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
                <form action="{{ url('admin/bookings/to-client-booking') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        @include('admin.booking.shared.client_booking')
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
                                            <input type="text" readonly value="" name="distance" id="distance"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Freight -->
                                        <div class="col-md-6">
                                            <label for="freight_amount">Freight:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" readonly value="" name="freight_amount"
                                                id="freight_amount" class="form-control mb-1" />
                                        </div>

                                        <!-- WBC -->
                                        <div class="col-md-6">
                                            <label for="wbc_charges">WBC:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="" readonly name="wbc_charges"
                                                id="wbc_charges" class="form-control mb-1" />
                                        </div>

                                        <!-- Handling Charges -->
                                        <div class="col-md-6">
                                            <label for="handling_charges">Handling Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="" name="handling_charges"
                                                id="handling_charges" class="form-control mb-1" />
                                        </div>

                                        <!-- FOV -->
                                        <div class="col-md-6">
                                            <label for="fov_amount">FOV:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="" name="fov_amount" id="fov_amount"
                                                class="form-control mb-1" oninput="calculateInvoice()" />
                                        </div>

                                        <!-- Fuel Charges -->
                                        <div class="col-md-6">
                                            <label for="fuel_amount">Fuel Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="" name="fuel_amount" id="fuel_amount"
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
                                            <input type="text" value="" readonly name="hamali_Charges"
                                                id="hamali_Charges" class="form-control mb-1" />
                                        </div>

                                        <!-- Bilti Charges -->
                                        <div class="col-md-6">
                                            <label for="bilti_Charges">Bilti Charges:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" value="" readonly value="10"
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
                                            <input type="text" value="" name="compney_charges"
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
                                            <input type="text" readonly value="" name="grand_total"
                                                id="grand_total" class="form-control mb-1" readonly />
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
                                let sgst = freight * 2.5 / 100; // Example 9% SGST
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
        $(document).ready(function() {
            $('#client_id').change(function() {
                var clientId = $(this).val();

                if (clientId) {
                    $.ajax({
                        url: '{{ url('admin/get-client-details') }}/' + clientId,
                        type: 'GET',
                        success: function(response) {
                            if (response.status == 'success') {
                                // Fill input fields
                                $('#consignee_name').val(response.data.client_name);
                                $('#consignee_phone').val(response.data.client_phone_number);
                                $('#consignee_address').val(response.data.client_address);
                                $('#consignee_gst_number').val(response.data.client_gst_number);
                                $('#consignee_email').val(response.data.client_email);
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function() {
                            alert('Failed to fetch client details.');
                        }
                    });
                }
            });

        })
    </script>
    <script>
        const wbcPerparcelChargesperParcel = 40; // for single parcel
        const handlingChargesPerparcel = 30; // for single parcel
        const fuelChargesPerparcel = 150; // for single parcel
        const transhipMentChargesPerparcel = 40; // for single parcel
        const hamaliChargesPerparcel = 20; // for single parcel
        const biltiChargesPerparcel = 10; // for single parcel
        const companyPerParcelCharges = 40; //  for single parcel
        const perKmRate = 0.20; // Freight rate per kilometer in rupees
        const defaultTotalNumberOfparcel = 0; // Freight rate per kilometer in rupees
        const defaultFovPercentage = 1.5; // defaultFovPercentage
        const setDefaultDistance = 100; // default distance 100 km
        const defaultTranshipment = 40;

        async function calculateFavtotalAmount() {
            //fov amount will be calculated when good of value amount should be available
            let fovValue;
            var goodsofvalue = parseFloat($('#good_of_value').val()) || 0;
            if (goodsofvalue <= 0) {
                $('#fov_amount').val('0.00'); // Set FOV to 0 if the goods value is 0 or less
                return 0;
            } else {
                fovValue = (goodsofvalue * defaultFovPercentage) / 100; // FOV is 1.5% of the goods value
                $('#fov_amount').val(fovValue.toFixed(2)); // Set FOV value with 2 decimals
                return fovValue;
            }
        }


        async function calculateGST(totalFreight) {
            // Check if the URL contains '?no-bill-bookings=true'
            const urlParams = new URLSearchParams(window.location.search);
            const noBillBookings = urlParams.get('no-bill-bookings');

            // If 'no-bill-bookings=true', skip GST calculation
            if (noBillBookings) {
                // Hide GST fields if necessary (optional if you need to hide them dynamically)
                $('.cgst').hide();
                $('.sgst').hide();
                $('.igst').hide();
                return {
                    'cGst': 0,
                    'sGst': 0
                }; // Return 0 for GST values when no-bill-bookings is true
            }

            // If 'no-bill-bookings' is not found, proceed with the calculation
            const cgstRate = 2.5; // CGST rate percentage
            const sgstRate = 2.5; // SGST rate percentage
            const igstRate = 5; // IGST rate percentage (for inter-state)

            // Calculate GST for Freight
            const freightCgst = (totalFreight * cgstRate) / 100;
            const freightSgst = (totalFreight * sgstRate) / 100;

            // Display the calculated GST values
            $('#cgst').val(freightCgst.toFixed(2));
            $('#sgst').val(freightSgst.toFixed(2));

            return {
                'cGst': freightCgst,
                'sGst': freightSgst
            };
        }

        async function calculateFreight(distance, numberOfParcel = 1) {
            console.log('calculateFreight numberOfParcel', numberOfParcel)
            const freightTotalAmount = (distance * perKmRate) * numberOfParcel;

            $('#freight_amount').val(freightTotalAmount); // set value in textbox
            return freightTotalAmount
        }
        async function calculateHamaliCharges(numberOfParcel = 0) {
            const calculatedHamaliCharges = hamaliChargesPerparcel * numberOfParcel;
            $('#hamali_Charges').val(calculatedHamaliCharges); // set value in textbox
            return calculatedHamaliCharges
        }

        async function calculateWbcCharges(numberOfParcel = 0) {
            const calculatedWbcCharges = numberOfParcel * wbcPerparcelChargesperParcel;
            $('#wbc_charges').val(calculatedWbcCharges);
            return calculatedWbcCharges
        }

        async function calculateHandlingCharges(numberOfParcel = 0) {
            const handlingCharges = numberOfParcel * handlingChargesPerparcel;
            $('#handling_charges').val(handlingCharges);
            return handlingCharges
        }
        async function calculateFuelCharges(numberOfParcel = 0) {
            const calculatedFuelAmount = numberOfParcel * fuelChargesPerparcel;
            $('#fuel_amount').val(calculatedFuelAmount);
            return calculatedFuelAmount
        }
        async function calculateBiltiCharges(numberOfParcel = 0) {
            const calculatedBiltiAmount = numberOfParcel * biltiChargesPerparcel;
            $('#bilti_Charges').val(calculatedBiltiAmount);
            return calculatedBiltiAmount
        }
        async function calculateCompanyCharges(numberOfParcel = 0) {
            const calculatedCompanyChargesAmount = numberOfParcel * companyPerParcelCharges;
            $('#compney_charges').val(calculatedCompanyChargesAmount);
            return calculatedCompanyChargesAmount
        }


        async function calculateInvoice(defaultDistance = 0, numberOfParcel = 0) {
            console.log('calculateInvoice calculateInvoice', defaultDistance)
            // Get all input values
            const distance = defaultDistance || 0;
            const noOfArticles = parseInt(document.getElementById('no_of_articles').value) || 1;
            // Calculate freight based on the distance
            const setNumberofparcelForFreight = (numberOfParcel > 0) ? numberOfParcel : 1
            const freight = await calculateFreight(distance, setNumberofparcelForFreight);
            const gst = await calculateGST(freight)
            const sumOfgst = gst.cGst + gst.sGst;
            const fovAmount = await calculateFavtotalAmount();
            const fuelAmount = await calculateFuelCharges(numberOfParcel);
            const hamaliCharges = await calculateHamaliCharges(numberOfParcel);
            const wbcCharges = await calculateWbcCharges(numberOfParcel);
            const handlingCharges = await calculateHandlingCharges(numberOfParcel);
            const biltiCharges = await calculateBiltiCharges(numberOfParcel);
            const companyCharges = await calculateCompanyCharges(numberOfParcel);;

            /*-----------------*/
            const [firstTranshipment, secondTranshipment, thirdShipment] = calculateTransshipment();

            const pickupCharges = parseFloat(document.getElementById('pickup_charges').value) || 0;
            const miscChargeAmount = parseFloat(document.getElementById('misc_charge_amount').value) || 0;
            const discount = parseFloat(document.getElementById('discount').value) || 0;


            // Calculate Sub Total
            const subTotal = (freight + wbcCharges + handlingCharges + fovAmount + fuelAmount +
                    firstTranshipment + secondTranshipment + thirdShipment +
                    pickupCharges + hamaliCharges + biltiCharges + companyCharges + miscChargeAmount + sumOfgst) -
                discount;

            // Set Sub Total
            document.getElementById('sub_total').value = subTotal.toFixed(2);
            // Calculate Grand Total (without GST)
            const grandTotal = subTotal;

            // Set Grand Total and Final Amount
            document.getElementById('grand_total').value = grandTotal.toFixed(2);
            document.getElementById('grand_total_amount').value = grandTotal.toFixed(2);
        }


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
            return [transshipmentValueOne, transshipmentValueTwo, transshipmentValueThree]

        }

        function calculateInvoiceWithArticles(noOfArticles) {
            const distance = parseFloat($('#distance').val()) || 0;
            const freightAmount = parseFloat($('#freight_amount').val()) || 0;
            calculateInvoice(distance, noOfArticles);
        }

        function calculateFOV() {
            const numberOfArticle = parseFloat($('#no_of_articles').val()) || 0;
            const distance = parseInt($('#distance').val()) || setDefaultDistance;
            calculateInvoice(distance, numberOfArticle)
        }


        $(document).ready(function() {
            $('#consignor_branch_id, #consignee_branch_id').on('change', function() {
                var consignor_branch_id = $('#consignor_branch_id').val();
                var consignee_branch_id = $('#consignee_branch_id').val();

                if (consignor_branch_id && consignee_branch_id) {
                    $.ajax({
                        url: "{{ url('admin/get-distance') }}",
                        method: 'GET',
                        data: {
                            consignor_branch_id: consignor_branch_id,
                            consignee_branch_id: consignee_branch_id
                        },
                        success: function(response) {
                            if (response.distance) {
                                $('#distance').val(response.distance);
                                const numberOfArticle = parseFloat($('#no_of_articles')
                                    .val()) || 0;

                                calculateInvoice(response.distance,
                                    numberOfArticle);
                            } else {
                                $('#distance').val(0);
                                alert('Error: ' + (response.error || 'Unknown error'));
                            }
                        },
                        error: function() {
                            $('#distance').val('');
                            alert('Failed to fetch distance. Please try again.');
                        }
                    });
                } else {
                    $('#distance').val(0);
                }
            });
            $(document).on('input', '#no_of_articles', function() {
                const noOfArticles = parseInt($('#no_of_articles').val()) ||
                    1; // Default to 1 if empty or invalid
                const distance = parseInt($('#distance').val()) || setDefaultDistance;

                calculateInvoice(distance, noOfArticles)
            });

            //manageCalculateInvoice
            $(document).on('input', '.manageCalculateInvoice', function() {
                const noOfArticles = parseInt($('#no_of_articles').val()) || 0;
                const distance = parseInt($('#distance').val()) || setDefaultDistance;
                calculateInvoice(distance, noOfArticles)
            });
            //manageCalculateInvoice
            $(document).on('input', '#misc_charge_amount', function() {
                const noOfArticles = parseInt($('#no_of_articles').val()) || 0;
                const distance = parseInt($('#distance').val()) || setDefaultDistance;
                calculateInvoice(distance, noOfArticles)
            });
            $(document).on('input', '#discount', function() {
                const noOfArticles = parseInt($('#no_of_articles').val()) || 0;
                const distance = parseInt($('#distance').val()) || setDefaultDistance;
                calculateInvoice(distance, noOfArticles)
            });


            // Event listener for goods value (FOV calculation)
            $('#good_of_value').on('input', function() {
                calculateFOV(); // Recalculate FOV based on goods value
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Check if the URL contains '?no-bill-bookings=true'
            const urlParams = new URLSearchParams(window.location.search);
            const noBillBookings = urlParams.get('no-bill-bookings');

            // If 'no-bill-bookings' is present, hide the GST fields
            if (noBillBookings) {
                // Hide the GST related fields (CGST, SGST, IGST)
                $('.cgst').hide();
                $('.sgst').hide();
                $('.igst').hide();
            } else {
                // Otherwise, show the GST fields (if necessary, optional based on the page flow)
                $('.cgst').show();
                $('.sgst').show();
                $('.igst').show();
            }
        });
    </script>

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
