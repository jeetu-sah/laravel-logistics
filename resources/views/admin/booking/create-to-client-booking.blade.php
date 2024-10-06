@extends('admin.admin_layout.master')
@section('main_content')
    <div class="content-wrapper" style="min-height: 1419.51px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('admin/bookings') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                class=" fa-sm text-white-50"></i> <b>Booking List</b></a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><b>To Client Booking</b></li>
                        </ol>
                    </div>


                </div>
            </div><!-- /.container-fluid -->
        </section>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <section class="content">
            <div class="container-fluid">
                <form action="{{ url('admin/booking/to-client-booking') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">

                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Consignor</h3>
                                </div>

                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_branch">From</label>
                                                <select class="form-select select2 form-control js-select2"
                                                    name="consignor_branch_id" id="form_branch" required>
                                                    <option value="">Select Branch Name</option>
                                                    @foreach ($branch as $branchList)
                                                        <option value="{{ $branchList->id }}">{{ $branchList->branch_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="consignor_name">Consignor Name</label>
                                                <input required type="text" class="form-control" name="consignor_name"
                                                    placeholder="Consignor Name">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="misc_charge">Consignor Address</label>
                                                <textarea required class="form-control" name="address" placeholder="Address"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="misc_charge">Consignor Mobile</label>
                                                <input required type="text" class="form-control" name="phone_number_1"
                                                    onkeypress="return /^-?[0-9]*$/.test(this.value+event.key)"
                                                    minlength="10" maxlength="10" placeholder="Phone Number 1">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="misc_charge">Consignor Mobile 2</label>
                                                <input type="text" class="form-control" name="phone_number_2"
                                                    onkeypress="return /^-?[0-9]*$/.test(this.value+event.key)"
                                                    minlength="10" maxlength="10" placeholder="Phone Number 2">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="misc_charge">Consignor Email</label>
                                                <input required type="email" class="form-control" name="email"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="misc_charge">GST No.</label>
                                                <input required type="text" class="form-control" name="gst_number"
                                                    placeholder="GST Number">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <label for="misc_charge">Pin Code</label>
                                                <input required type="text" class="form-control" name="pin_code"
                                                    placeholder="Pin code">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Consignee</h3>
                                </div>

                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="misc_charge">Designation</label>
                                                <select class="form-select select2 form-control js-select2"
                                                    name="consignee_branch_id" id="designation" required>
                                                    <option value="">Select Branch Name</option>
                                                    @foreach ($branch as $branchList)
                                                        <option value="{{ $branchList->id }}">
                                                            {{ $branchList->branch_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="misc_charge">Consignee Name</label>
                                                <input required type="text" class="form-control" name="consignee_name"
                                                    placeholder="Consignor Name">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="misc_charge">Consignee Address</label>
                                                <textarea required class="form-control" name="consignee_address" placeholder="Address"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="misc_charge">Consignee Mobile</label>
                                                <input required type="text" class="form-control" name="consignee_phone_number_1"
                                                    onkeypress="return /^-?[0-9]*$/.test(this.value+event.key)"
                                                    minlength="10" maxlength="10" placeholder="Phone Number 1">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="misc_charge">Consignee Mobile 2</label>
                                                <input type="text" class="form-control" name="consignee_phone_number_2"
                                                    onkeypress="return /^-?[0-9]*$/.test(this.value+event.key)"
                                                    minlength="10" maxlength="10" placeholder="Phone Number 2">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="misc_charge">Consignee Email</label>
                                                <input required type="email" class="form-control" name="consignee_email"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="misc_charge">Consignee GST No.</label>
                                                <input required type="text" class="form-control" name="consignee_gst_number"
                                                    placeholder="GST Number">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <label for="misc_charge">Designation Pin Code</label>
                                                <input required type="text" class="form-control" name="consignee_pin_code"
                                                    placeholder="Pin code">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>


                        <div class="col-md-6">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Other Details</h3>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label required for="misc_charge">Dest Pin code</label>
                                                <input type="text" class="form-control" name="dest_pin_code"
                                                    placeholder="Dest Pin code">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="misc_charge">Services Line</label>
                                                <input required type="text" class="form-control" name="services_line"
                                                    placeholder="Services Line">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="misc_charge">No Of Pkg</label>
                                                <input required type="text" class="form-control" name="no_of_pkg"
                                                    placeholder="No Of Pkg">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="misc_charge">Actual weight</label>
                                                <input required type="text" class="form-control" name="actual_weight"
                                                    placeholder="Actual weight">
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="misc_charge">Packing Type</label>
                                                <input required type="text" class="form-control" name="packing_type"
                                                    placeholder="Packing Type">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="misc_charge">Transhipment 1</label>
                                                <select class="form-select select2 form-control js-select2"
                                                    name="transhipmen_one" id="transhipmen_one" >
                                                    <option value="">Select Branch Name</option>
                                                    @foreach ($branch as $branchList)
                                                        <option value="{{ $branchList->id }}">
                                                            {{ $branchList->branch_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="misc_charge">Transhipment 2</label>
                                                <select class="form-select select2 form-control js-select2"
                                                    name="transhipmen_two" id="transhipmen_two" >
                                                    <option value="">Select Branch Name</option>
                                                    @foreach ($branch as $branchList)
                                                        <option value="{{ $branchList->id }}">
                                                            {{ $branchList->branch_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="misc_charge">Transhipment 3</label>
                                                <select class="form-select select2 form-control js-select2"
                                                    name="transhipment_three" id="transhipment_three" >
                                                    <option value="">Select Branch Name</option>
                                                    @foreach ($branch as $branchList)
                                                        <option value="{{ $branchList->id }}">
                                                            {{ $branchList->branch_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Bills</h3>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <!-- Other form fields -->

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="freight">Freight</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input required type="number" class="form-control bill-input"
                                                    name="freight_amount" placeholder="₹.00">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="os">O.S</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input required type="number" class="form-control bill-input" name="os_amount"
                                                    placeholder="₹.00">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fov">FOV</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input required type="number" class="form-control bill-input" name="fov_amount"
                                                    placeholder="₹.00">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="transhipment">Transhipment</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input required type="number" class="form-control bill-input"
                                                    name="transhipment_amount" placeholder="₹.00">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="handling_charge">Handling Charge</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input required type="number" class="form-control bill-input"
                                                    name="handling_charge_amount" placeholder="₹.00">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="loading_charge">Loading Charge</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input required type="number" class="form-control bill-input"
                                                    name="loading_charge_amount" placeholder="₹.00">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="misc_charge">Misc Charge</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input required type="number" class="form-control bill-input"
                                                    name="misc_charge_amount" placeholder="₹.00">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="other_charge">Other Charges</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input required type="number" class="form-control bill-input"
                                                    name="other_charge_amount" placeholder="₹.00">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="grand_total">Grand Total</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input required type="number" class="form-control" name="grand_total_amount"
                                                    id="grand_total_amount" placeholder="₹.00" readonly>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function calculateTotal() {
                                let total = 0;
                                document.querySelectorAll('.bill-input').forEach(input => {
                                    let value = parseFloat(input.value) || 0;
                                    total += value;
                                });
                                document.getElementById('grand_total_amount').value = `${total.toFixed(2)}`;
                            }

                            document.querySelectorAll('.bill-input').forEach(input => {
                                input.addEventListener('input', calculateTotal);
                            });
                        </script>

                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            {{-- <a href="{{ url('admin/booking/to-pay-booking') }}" class="btn btn-secondary">Reset</a> --}}
                            <input type="submit" value="Save Booking" class="btn btn-success float-right">
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
