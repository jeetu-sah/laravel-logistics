@extends('admin.admin_layout.master')
@section('main_content')
    <div class="content-wrapper" style="min-height: 1419.51px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('admin/branch/branch-list') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                class=" fa-sm text-white-50"></i> Booking List</a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active"><b>Client Booking</b></li>
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
                                                <select class="form-control select2" name="consignor_branch_name"
                                                    style="width: 100%;">
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
                                                <input type="text" class="form-control" name="consignor_name"
                                                    placeholder="Consignor Name">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" name="address" placeholder="Address"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="phone_number_1"
                                                    placeholder="Phone Number 1">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="phone_number_2"
                                                    placeholder="Phone Number 2">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="gst_number"
                                                    placeholder="GST Number">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="text" class="form-control" name="pin_code"
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
                                                <select class="form-control select2" name="consignee_branch_name"
                                                    style="width: 100%;">
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
                                                <input type="text" class="form-control" name="consignee_name"
                                                    placeholder="Consignee Name">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea class="form-control" name="consignee_address" placeholder="Address"></textarea>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    name="consignee_phone_number_1" placeholder="Phone Number 1">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control"
                                                    name="consignee_phone_number_2" placeholder="Phone Number 2">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="consignee_email"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="consignee_gst_number"
                                                    placeholder="GST Number">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="text" class="form-control" name="consignee_pin_code"
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
                                                <input type="text" class="form-control" name="dest_pin_code"
                                                    placeholder="Dest Pin code">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="services_line"
                                                    placeholder="Services Line">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="no_of_pkg"
                                                    placeholder="No Of Pkg">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="actual_weight"
                                                    placeholder="Actual weight">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="gateway"
                                                    placeholder="Gate Way">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="packing_type"
                                                    placeholder="Packing Type">
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
                                                <input type="text" class="form-control bill-input"
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
                                                <input type="text" class="form-control bill-input" name="os_amount"
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
                                                <input type="text" class="form-control bill-input" name="fov_amount"
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
                                                <input type="text" class="form-control bill-input"
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
                                                <input type="text" class="form-control bill-input"
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
                                                <input type="text" class="form-control bill-input"
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
                                                <input type="text" class="form-control bill-input"
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
                                                <input type="text" class="form-control bill-input"
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
                                                <input type="text" class="form-control" name="grand_total_amount"
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
                            <a href="{{ url('admin/booking/to-client-booking') }}" class="btn btn-secondary">Reset</a>
                            <input type="submit" value="Save Booking" class="btn btn-success float-right">
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
