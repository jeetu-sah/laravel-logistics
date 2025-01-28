<div class="col-md-9">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Paid Booking</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="">
                        <label for="date">Date:</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="">
                        <input type="datetime-local" id="booking-time" name="booking_date" />

                        <script>
                            const now = new Date();
                            const formattedDate = now.toISOString().slice(0, 16);
                            document.getElementById('booking-time').value = formattedDate;
                        </script>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="">
                        <label for="date">Transhipment 1:</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="">
                        <select class="form-select select2 form-control js-select2" name="transhipmen_one"
                            id="transhipmen_one" required>
                            <option value="">Select Branch Name</option>
                            @foreach ($branch as $branchList)
                                <option value="{{ $branchList->id }}">{{ $branchList->branch_name }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="">
                        <label for="date">From:</label>
                    </div>
                </div>
                <div class="col-md-3 mb-1">
                    <select class="form-select select2 form-control js-select2" name="consignor_branch_id"
                        id="consignor_branch_id" required>
                        <option value="">Select Branch Name</option>
                        @foreach ($branch as $branchList)
                            <option value="{{ $branchList->id }}">{{ $branchList->branch_name }}
                            </option>
                        @endforeach
                    </select>

                </div>
                <div class="col-md-2">

                    <label for="text">Transhipment 2:</label>

                </div>
                <div class="col-md-3">

                    <select class="form-select select2 form-control js-select2" name="transhipmen_two"
                        id="transhipmen_two" required>
                        <option value="">Select Branch Name</option>
                        @foreach ($branch as $branchList)
                            <option value="{{ $branchList->id }}">{{ $branchList->branch_name }}
                            </option>
                        @endforeach
                    </select>


                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="">
                        <label for="date">To:</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select select2 form-control js-select2" name="consignee_branch_id"
                        id="consignee_branch_id" required>
                        <option value="">Select Branch Name</option>
                        @foreach ($branch as $branchList)
                            <option value="{{ $branchList->id }}">{{ $branchList->branch_name }}
                            </option>
                        @endforeach
                    </select>

                </div>
                <div class="col-md-2">
                    <div class="">
                        <label for="text">Transhipment 3:</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select select2 form-control js-select2" name="transhipment_three"
                        id="transhipment_three" required>
                        <option value="">Select Branch Name</option>
                        @foreach ($branch as $branchList)
                            <option value="{{ $branchList->id }}">{{ $branchList->branch_name }}
                            </option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="">
                        <label for="no_of_artical">Total Number Of Articles:</label>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="">
                        <input type="text" oninput="calculateTransshipment()" id="no_of_articles"
                            name="no_of_artical" class="form-control mb-1" />
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="">
                        <label for="actual_weight">Weight (kg):</label>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="">
                        <input type="text" name="actual_weight" value="" class="form-control mb-1" />
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="">
                        <label for="no_of_pkg">Cantain</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="">
                        <input type="text" value="" name="no_of_pkg" class="form-control mb-1" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="">
                        <label for="good_of_value">Goods Of Value:</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="">
                        <input type="text" value="" name="good_of_value" class="form-control mb-1" />
                    </div>
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
                </div>

                <div class="col-md-3">

                    <label for="date">Name:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="" name="consignee_name" class="form-control mb-1" />

                </div>

            </div>
            <div class="row">
                <div class="col-md-3">

                    <label for="date">Address:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" name="consignor_address" class="form-control mb-1" />

                </div>

                <div class="col-md-3">

                    <label for="date">Address:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="" name="consignee_address" class="form-control mb-1" />

                </div>

            </div>
            <div class="row">
                <div class="col-md-3">

                    <label for="date">mobile:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" name="consignor_phone_number" class="form-control mb-1" />

                </div>

                <div class="col-md-3">

                    <label for="date">mobile:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="" name="consignee_phone_number" class="form-control mb-1" />

                </div>

            </div>
            <div class="row">
                <div class="col-md-3">

                    <label for="date">GST:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" name="consignor_gst_number" class="form-control mb-1" />

                </div>

                <div class="col-md-3">

                    <label for="date">GST:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="" name="consignee_gst_number" class="form-control mb-1" />

                </div>

            </div>
            <div class="row">
                <div class="col-md-3">

                    <label for="date">Email:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" class="form-control mb-1" />

                </div>

                <div class="col-md-3">

                    <label for="date">Email:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="" class="form-control mb-1" />

                </div>

            </div>
            <div class="row">
                <div class="col-md-3">

                    <label for="date">Invoice Number</label>

                </div>
                <div class="col-md-3">

                    <input type="text" class="form-control mb-1" />

                </div>

                <div class="col-md-3">

                    <label for="date">Eway Bill Number:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="" class="form-control mb-1" />

                </div>

            </div>
            <div class="row">
                <div class="col-md-6">

                    <label for="date">Upload Parcel Image:</label>
                    <input type="file" class="form-control mb-1 mb-1" />



                </div>
                <div class="col-md-3">

                    <label for="date">Capture Parcel Image</label>
                    <input type="file" class="form-control mb-1 mb-1" />


                </div>
                <div class="col-md-3">

                    <label for="date"></label>
                    <button type="button" class="btn btn-primary mt-4">Open WebCam</button>

                </div>



            </div>
            <div class="row">
                <div class="col-md-6">

                    <label for="date">Upload Photo ID Image:</label>
                    <input type="file" class="form-control mb-1 mb-1" />

                </div>
                <div class="col-md-3">

                    <label for="date">Capture Image</label>
                    <input type="file" class="form-control mb-1 mb-1" />


                </div>
                <div class="col-md-3">

                    <label for="date"></label>
                    <button type="button" class="btn btn-primary mt-4">Open WebCam</button>

                </div>

            </div>
        </div>

    </div>

</div>
<script>
    function calculateTransshipment() {
        // Get the number of articles from the input field
        var noOfArticles = document.getElementById('no_of_articles').value;
        var tans_one = document.getElementById('transhipmen_one').value;

        // Ensure noOfArticles is a valid number
        if (isNaN(noOfArticles) || noOfArticles <= 0) {
            document.getElementById('result').innerText = "Please enter a valid number of articles.";
            return;
        }

        // Check if tans_one is blank
        if (tans_one === "") {
            // If tans_one is blank, set transshipment value to 0
            document.getElementById('transhipmen_one_amount').innerText = "Amount: 0 Rupees";
        } else {
            // If tans_one is not blank, calculate transshipment value as noOfArticles * 2
            var transshipmentValue = noOfArticles * 2;
            document.getElementById('transhipmen_one_amount').value = transshipmentValue ;
        }
    }
</script>
