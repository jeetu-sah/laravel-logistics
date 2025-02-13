<div class="col-md-9">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $tittle }}</h3>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-md-2">
                    <div class="">
                        <label for="date">From:</label>
                    </div>
                </div>
                <div class="col-md-3 mb-1">
                    <select class="form-select select2 form-control js-select2" name="consignor_branch_id"
                        id="consignor_branch_id">
                        <option value="">Select Branch Name</option>
                        @foreach ($branch as $branchList)
                            <option value="{{ $branchList->id }}">{{ $branchList->branch_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('consignor_branch_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="col-md-2">
                    <div class="">
                        <label for="date">To:</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select select2 form-control js-select2" name="consignee_branch_id"
                        id="consignee_branch_id">
                        <option value="">Select Branch Name</option>
                        @foreach ($branch as $branchList)
                            <option value="{{ $branchList->id }}">{{ $branchList->branch_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('consignee_branch_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="row">
                <div class="col-md-6"> <label for="date" style="font-size:20px;">Consignor Details:</label></div>
                <div class="col-md-6"> <label for="date" style="font-size:20px;">Consignee Details:</label></div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="date">Name:</label>

                </div>
                <div class="col-md-3">
                    <input type="text" name="consignor_name" class="form-control mb-1" />
                    @error('consignor_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">

                    <label for="date">Name:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="" name="consignee_name" class="form-control mb-1" />
                    @error('consignee_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

            </div>
            <div class="row">
                <div class="col-md-3">

                    <label for="date">Address:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" name="consignor_address" class="form-control mb-1" />
                    @error('consignor_address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="col-md-3">

                    <label for="date">Address:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="" name="consignee_address" class="form-control mb-1" />
                    @error('consignee_address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

            </div>
            <div class="row">
                <div class="col-md-3">

                    <label for="date">mobile:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" name="consignor_phone_number" class="form-control mb-1" />
                    @error('consignor_phone_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="col-md-3">

                    <label for="date">mobile:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="" name="consignee_phone_number" class="form-control mb-1" />
                    @error('consignee_phone_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

            </div>
            <div class="row">
                <div class="col-md-3">

                    <label for="date">GST:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" name="consignor_gst_number" class="form-control mb-1" />
                    @error('consignor_gst_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="col-md-3">

                    <label for="date">GST:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="" name="consignee_gst_number" class="form-control mb-1" />
                    @error('consignee_gst_number')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

            </div>
            <div class="row">
                <div class="col-md-3">

                    <label for="date">Email:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" name="consignor_email" class="form-control mb-1" />
                    @error('consignor_email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="col-md-3">

                    <label for="date">Email:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="" name="consignee_email" class="form-control mb-1" />
                    @error('consignee_email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

            </div>

            <div class="row">
                <div class="col-md-4">

                    <label for="date">Aadhar card</label>
                    <input type="text" name="aadhar_card" class="form-control mb-1 mb-1" />
                    @error('aadhar_card')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror


                </div>

            </div>

        </div>

    </div>

</div>




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
