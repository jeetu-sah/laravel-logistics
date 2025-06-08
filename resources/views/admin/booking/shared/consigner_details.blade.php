<div class="col-md-9">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
        <div class="card-body">
            @if($bookingType === \App\Models\Booking::CLIENT_BOOKING)
            <div class="row">
                <div class="col-md-7 mb-1">
                    <label for="date">Select Client:</label>
                    <select required class="form-select select2 form-control js-select2" name="client_id" id="client_id">
                        <option value="">Select Client</option>
                        @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                        @endforeach
                    </select>
                    <div id="client_details"></div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-2">
                    <div class="">
                        <label for="date">Paid:</label>
                    </div>
                </div>
                <div class="col-md-1">
                    <input type="checkbox" name="booking" class="form-control" value="Paid" id="paid"
                        onclick="uncheckOther(this)" />
                </div>

                <div class="col-md-1 mb-2">
                    <div class="">
                        <label for="date">To Pay:</label>
                    </div>
                </div>
                <div class="col-md-1 mb-2">
                    <div class="">
                        <input type="checkbox" class="form-control" name="booking" value="Topay" id="to_pay"
                            onclick="uncheckOther(this)" />
                    </div>
                </div>
                <div class="col-md-2 mb-2">
                    <div class="">
                        <label for="manual_bilty">Offline Bilty No:</label>
                    </div>
                </div>
                <div class="col-md-3 mb-2">
                    <div class="">
                        <input type="text" class="form-control" name="manual_bilty" value="{{ old('manual_bilty') }}" id="manual_bilty" />
                    </div>
                </div>
                <script>
                    function uncheckOther(checkbox) {
                        // Get all checkboxes with the name 'paid' and 'to_pay'
                        var paidCheckbox = document.getElementById('paid');
                        var toPayCheckbox = document.getElementById('to_pay');

                        // If one is checked, uncheck the other
                        if (checkbox.id === 'paid' && checkbox.checked) {
                            toPayCheckbox.checked = false;
                        } else if (checkbox.id === 'to_pay' && checkbox.checked) {
                            paidCheckbox.checked = false;
                        }
                    }
                </script>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="">
                        <label for="date">Date:</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" value="{{ now()->format('Y-m-d') }}" id="booking-time"
                        name="booking_date" />
                </div>

                <div class="col-md-2">
                    <div class="">
                        <label for="date">Transhipment 1:</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="">
                        <select class="form-select select2 form-control js-select2 manageCalculateInvoice selectBranch"
                            disabled
                            name="transhipmen_one" id="transhipmen_one">
                            <option value="">Select Branch Name</option>
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
                    <select class="form-select select2 form-control js-select2 selectBranch" name="consignor_branch_id"
                        id="consignor_branch_id">
                        <option value="">Select Branch Name</option>
                        @foreach ($branch as $branchList)
                        <option value="{{ $branchList->id }}" @if ($branchList->id != $user->branch_user_id) disabled @endif
                            @if ($branchList->id == $user->branch_user_id) selected @endif>
                            {{ $branchList->branch_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="text">Transhipment 2:</label>
                </div>
                <div class="col-md-3">
                    <select class="form-select select2 form-control js-select2 manageCalculateInvoice selectBranch"
                        disabled
                        name="transhipmen_two" id="transhipmen_two">
                        <option value="">Select Branch Name</option>
                     
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
                    <select class="form-select select2 form-control js-select2 toBranch selectBranch" name="consignee_branch_id" id="consignee_branch_id">
                        <option value="">Select Branch Name</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <div class="">
                        <label for="text">Transhipment 3:</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select select2 form-control js-select2 manageCalculateInvoice selectBranch"
                        disabled
                        name="transhipment_three" id="transhipment_three">
                        <option value="">Select Branch Name</option>
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
                        <input min="0" type="number" id="no_of_articles" name="no_of_artical" class="form-control mb-1" value="{{ old('no_of_artical') }}" />
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="">
                        <label for="actual_weight">Weight (kg):</label>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="">
                        <input type="number" min="0" name="actual_weight" class="form-control mb-1" value="{{ old('actual_weight') }}" />
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="">
                        <label for="cantain">Cantain</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="">
                        <input type="text" name="cantain" value="{{ old('cantain') }}" class="form-control mb-1" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="">
                        <label for="good_of_value">Goods Of Value:</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="">
                        <input type="number" min="0" value="{{ old('good_of_value') }}" id="good_of_value" name="good_of_value"
                            oninput="calculateFOV()" class="form-control mb-1" />
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
                    <input type="text" name="consignor_name" value="{{ old('consignor_name') }}" class="form-control mb-1" />
                </div>

                <div class="col-md-3">
                    <label for="date">Name:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ old('consignee_name') }}" id="consignee_name" name="consignee_name" class="form-control mb-1" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="date">Address:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ old('consignor_address') }}" name="consignor_address" id="consignor_address" class="form-control mb-1" />
                </div>

                <div class="col-md-3">
                    <label for="date">Address:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ old('consignee_address') }}" name="consignee_address" id="consignee_address" class="form-control mb-1" />

                </div>

            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="date">mobile:</label>
                </div>
                <div class="col-md-3">
                    <input type="mobile" value="{{ old('consignor_phone_number') }}" name="consignor_phone_number" id="consignor_phone_number" class="form-control mb-1" />
                </div>
                <div class="col-md-3">
                    <label for="date">mobile:</label>
                </div>
                <div class="col-md-3">
                    <input type="mobile" value="{{ old('consignee_phone_number') }}" name="consignee_phone_number" id="consignee_phone_number" class="form-control mb-1" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="date">GST:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ old('consignor_gst_number') }}" name="consignor_gst_number" id="consignor_gst_number" class="form-control mb-1" />
                </div>
                <div class="col-md-3">
                    <label for="date">GST:</label>
                </div>
                <div class="col-md-3">

                    <input type="text" value="{{ old('consignee_gst_number') }}" name="consignee_gst_number" id="consignee_gst_number" class="form-control mb-1" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="date">Email:</label>=
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ old('consignor_email') }}" name="consignor_email" id="consignor_email" class="form-control mb-1" />
                </div>
                <div class="col-md-3">
                    <label for="date">Email:</label>
                </div>
                <div class="col-md-3">

                    <input type="text" value="{{ old('consignee_email') }}" id="consignee_email" name="consignee_email" class="form-control mb-1" />

                </div>

            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="date">Invoice Number</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ old('invoice_number') }}" name="invoice_number" id="invoice_number" class="form-control mb-1" />
                </div>
                @if($bookingType === \App\Models\Booking::NO_BOOKING)
                <div class="col-md-3">
                    <label for="date">Eway Bill Number:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ old('eway_bill_number') }}" name="eway_bill_number" class="form-control mb-1" />
                </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="date">Aadhar card</label>
                    <input type="text" value="{{ old('aadhar_card') }}" name="aadhar_card" class="form-control mb-1 mb-1" />
                </div>
                <div class="col-md-4">
                    <label for="date">Value Declare by Consignee.</label>
                    <input type="text" value="{{ old('mark') }}" name="mark" class="form-control mb-1 mb-1" />
                </div>
                <div class="col-md-4">
                    <label for="date">Remark</label>
                    <input type="text" value="{{ old('remark') }}" name="remark" class="form-control mb-1 mb-1" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="date">Upload Photo ID Image:</label>
                    <input type="file" class="form-control mb-1 mb-1" name="photo_id" />
                </div>
                <div class="col-md-3">
                    <label for="parcel_image">Capture Image</label>
                    <input type="file" name="parcel_image" id="parcel_image" class="form-control mb-1" />
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

                        // Set image type to JPEG (you can change this to 'image/png' for PNG format)
                        const imageType = 'image/jpeg'; // Enforcing JPEG format
                        const capturedImageData = canvas.toDataURL(imageType);

                        // Convert base64 to a Blob
                        const byteString = atob(capturedImageData.split(',')[1]);
                        const mimeString = capturedImageData.split(',')[0].split(':')[1].split(';')[0];
                        const ab = new ArrayBuffer(byteString.length);
                        const ia = new Uint8Array(ab);
                        for (let i = 0; i < byteString.length; i++) {
                            ia[i] = byteString.charCodeAt(i);
                        }
                        const blob = new Blob([ab], {
                            type: mimeString
                        });

                        // Create a File from the Blob
                        const file = new File([blob], 'parcel_image.jpg', {
                            type: mimeString
                        });

                        // Append the file to the form's file input (by setting it to the input field)
                        const parcelImageInput = document.getElementById('parcel_image');
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        parcelImageInput.files = dataTransfer.files;

                        // Optionally, display the captured image in an img element
                        const image = document.getElementById('capturedImage');
                        image.src = capturedImageData;
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