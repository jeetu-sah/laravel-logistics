<div class="col-md-6">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Consignor</h3>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
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
                <div class="col-md-12">
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
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="mobileCode">Consignor Mobile</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <input type="hidden"
                                    value="+91"
                                    name="consignorMobileCodeFirst"
                                    class="mobileNumberCode" />
                                <button type="button" class="btn btn-default dropdown-toggle mobile-number-code" data-toggle="dropdown" id="consignerMobileNumberCodeFirst">
                                    +91
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item dropdown-mobile-code" href="#">+91</a>
                                    <a class="dropdown-item dropdown-mobile-code" href="#">+92</a>
                                </div>
                            </div>
                            <!-- /btn-group -->
                            <input required type="text" class="form-control" name="phone_number_1"
                                onkeypress="return /^-?[0-9]*$/.test(this.value+event.key)"
                                minlength="10" maxlength="10" placeholder="Phone Number 1">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="mobileCodeTwo">Consignor Mobile 2</label>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <input type="hidden" value="+91"
                                    name="consignorMobileCodeTwo"
                                    class="mobileNumberCode" />

                                <button type="button" class="btn btn-default dropdown-toggle mobile-number-code"
                                    data-toggle="dropdown"
                                    id="consignorMobileNumberCodeSecond">
                                    +91
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item dropdown-mobile-code" href="#">+91</a>
                                    <a class="dropdown-item dropdown-mobile-code" href="#">+92</a>
                                </div>
                            </div>
                            <!-- /btn-group -->
                            <input type="text" class="form-control" name="phone_number_2"
                                onkeypress="return /^-?[0-9]*$/.test(this.value+event.key)"
                                minlength="10" maxlength="10" placeholder="Phone Number 2">
                        </div>
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

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="misc_charge">Destination</label>
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
                <div class="col-md-12">
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
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="misc_charge">Consignee Mobile</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <input type="hidden" value="+91"
                                    name="consignee_mobile_code_first"
                                    class="mobileNumberCode" />
                                <button type="button" class="btn btn-default dropdown-toggle mobile-number-code"
                                    data-toggle="dropdown"
                                    id="consignorMobileNumberCodeSecond">
                                    +91
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item dropdown-mobile-code" href="#">+91</a>
                                    <a class="dropdown-item dropdown-mobile-code" href="#">+92</a>
                                </div>
                            </div>
                            <!-- /btn-group -->
                            <input required type="text" class="form-control"
                                name="consignee_phone_number_1"
                                onkeypress="return /^-?[0-9]*$/.test(this.value+event.key)"
                                minlength="10" maxlength="10" placeholder="Phone Number 1">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="misc_charge">Consignee Mobile 2</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <input type="hidden" value="+91"
                                    name="consignee_mobile_code_second"
                                    class="mobileNumberCode" />
                                <button type="button" class="btn btn-default dropdown-toggle mobile-number-code"
                                    data-toggle="dropdown"
                                    id="consignorMobileNumberCodeSecond">
                                    +91
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item dropdown-mobile-code" href="#">+91</a>
                                    <a class="dropdown-item dropdown-mobile-code" href="#">+92</a>
                                </div>
                            </div>
                            <!-- /btn-group -->
                            <input type="text" class="form-control"
                                name="consignee_phone_number_2"
                                onkeypress="return /^-?[0-9]*$/.test(this.value+event.key)"
                                minlength="10" maxlength="10" placeholder="Phone Number 2">
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="misc_charge">Consignee Email</label>
                        <input required type="email" class="form-control"
                            name="consignee_email" placeholder="Email">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="misc_charge">Consignee GST No.</label>
                        <input required type="text" class="form-control"
                            name="consignee_gst_number" placeholder="GST Number">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">

                        <label for="misc_charge"> Pin Code</label>
                        <input required type="text" class="form-control"
                            name="consignee_pin_code" placeholder="Pin code">
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>