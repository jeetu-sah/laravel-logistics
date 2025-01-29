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
                        <select onchange="calculateTransshipment()" class="form-select select2 form-control js-select2"
                            name="transhipmen_one" id="transhipmen_one">
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
                        id="consignor_branch_id">
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

                    <select onchange="calculateTransshipment()" class="form-select select2 form-control js-select2"
                        name="transhipmen_two" id="transhipmen_two">
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
                        id="consignee_branch_id">
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
                    <select onchange="calculateTransshipment()" class="form-select select2 form-control js-select2"
                        name="transhipment_three" id="transhipment_three">
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
                        <input type="text" value="" id="good_of_value" name="good_of_value"
                            oninput="calculatefov()" class="form-control mb-1" />
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

                    <input type="text" name="consignor_email" class="form-control mb-1" />

                </div>

                <div class="col-md-3">

                    <label for="date">Email:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="" name="consignee_email" class="form-control mb-1" />

                </div>

            </div>
            <div class="row">
                <div class="col-md-3">

                    <label for="date">Invoice Number</label>

                </div>
                <div class="col-md-3">

                    <input type="text" name="invoice_number" class="form-control mb-1" />

                </div>

                <div class="col-md-3">

                    <label for="date">Eway Bill Number:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="" name="eway_bill_number" class="form-control mb-1" />

                </div>

            </div>
            <div class="row">
                <div class="col-md-6">

                    <label for="date">Mark</label>
                    <input type="text" name="mark" class="form-control mb-1 mb-1" />



                </div>
                <div class="col-md-6">

                    <label for="date">Remark</label>
                    <input type="text" name="remark" class="form-control mb-1 mb-1" />


                </div>




            </div>
            <div class="row">
                <div class="col-md-6">

                    <label for="date">Upload Photo ID Image:</label>
                    <input type="file" class="form-control mb-1 mb-1" name="photo_id" />

                </div>
                <div class="col-md-3">

                    <label for="date">Capture Image</label>
                    <input type="text" name="parcel_image" class="form-control mb-1 mb-1" />


                </div>
                <script>
                    let stream;

                    // Function to open the webcam
                    function openWebCam() {
                        const video = document.getElementById('webcam');
                        const captureButton = document.getElementById('captureBtn');

                        // Check if browser supports getUserMedia
                        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                            navigator.mediaDevices.getUserMedia({
                                    video: true
                                })
                                .then(function(userStream) {
                                    stream = userStream;
                                    // Set the webcam stream to the video element
                                    video.srcObject = stream;
                                    video.style.display = 'block'; // Show the video element
                                    captureButton.style.display = 'inline-block'; // Show the capture button
                                })
                                .catch(function(err) {
                                    alert('Error accessing webcam: ' + err);
                                });
                        } else {
                            alert('Your browser does not support webcam access.');
                        }
                    }

                    // Function to capture the photo after stopping the webcam
                    function capturePhoto() {
                        const video = document.getElementById('webcam');
                        const canvas = document.getElementById('canvas');
                        const context = canvas.getContext('2d');

                        // Set canvas dimensions to match the video
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;

                        // Draw the current video frame on the canvas
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);

                        // Optionally, display the captured image in an img element
                        const image = document.getElementById('capturedImage');
                        image.src = canvas.toDataURL('image/png');
                        image.style.display = 'block';

                        // Stop the webcam stream (turn off the camera)
                        const tracks = stream.getTracks();
                        tracks.forEach(track => track.stop()); // Stop all tracks (video/audio)
                        video.style.display = 'none'; // Hide the video element
                        document.getElementById('captureBtn').style.display = 'none'; // Hide the capture button
                    }
                </script>

                <div class="col-md-3">

                    <label for="date"></label>
                    <!-- Button to open webcam -->
                    <button type="button" class="btn btn-primary mt-4" onclick="openWebCam()">Open Webcam</button>

                    <!-- Video element to display the webcam feed -->
                    <video id="webcam" width="225" height="200" style="display: none;" autoplay></video>

                    <!-- Capture button that will appear after webcam is opened -->
                    <button id="captureBtn" type="button" class="btn btn-secondary mt-4" style="display: none;"
                        onclick="capturePhoto()">Capture Photo</button>

                    <!-- Canvas element to display the captured photo -->
                    <canvas id="canvas" style="display: none;"></canvas>

                    <!-- Optionally, display the captured photo in an image element -->
                    <img id="capturedImage" width="225" height="200" style="display: none;"
                        alt="Captured Image" />
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

    function calculatefov() {
        var goodsofvalue = document.getElementById('good_of_value').value;
        if (goodsofvalue === "") {
            document.getElementById('fov_amount').innerText = "Amount: 0 Rupees";
        } else {
            var fovValue = goodsofvalue * 1.5 / 100;
            document.getElementById('fov_amount').value = fovValue;
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
