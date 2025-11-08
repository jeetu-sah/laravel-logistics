@extends('admin.admin_layout.master')
@section('main_content')
<div class="content-wrapper" style="min-height: 1419.51px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ url('admin/branches/create') }}" class="d-none d-sm-inline-block shadow-sm">
                        <i class=" fa-sm text-white-50"></i> </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Generate Gatepass</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            @include('common.notification')
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ url('admin/delivery/gatepass/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $booking->id }}" name="booking_id">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Delivery receipt</h3>
                            </div>
                            <div class="card-body">
                                <div class="container my-4">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped align-middle"
                                            style="font-size: 18px;">

                                            <tbody>
                                                <tr>
                                                    <td><strong>Consignor Name</strong></td>
                                                    <td>{{ $booking->consignor_name }}</td>
                                                    <td><strong>Consignee Name</strong></td>
                                                    <td>{{ $booking->consignee_name }}</td>
                                                </tr>
                                                <tr>

                                                    <td><strong>Booking Station</strong></td>
                                                    <td>{{ $booking->consignorBranch->branch_name }}</td>
                                                    <td><strong>Delivery Station</strong></td>
                                                    <td>{{ $booking->consigneeBranch->branch_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Offline Bilti Number</strong></td>
                                                    <td>{{ $booking->manual_bilty_number ?: 'NA' }}</td>
                                                    <td><strong>Offline Booking Date</strong></td>
                                                    <td>{{ formatOnlyDate($booking->created_at) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Online Booking Date</strong></td>
                                                    <td>{{ formatDate($booking->created_at) }}
                                                    <td><strong>Article</strong></td>
                                                    <td>{{ $booking->no_of_artical }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Contain</strong></td>
                                                    <td colspan="3">{{ $booking->cantain }}</td>

                                                </tr>
                                                <tr>
                                                    <td><strong>Delivery / Gatepass number</strong></td>
                                                    <td colspan="3">
                                                        <input type="text"
                                                            value="{{ old('delivery_number') }}"
                                                            class="form-control"
                                                            name="delivery_number"
                                                            placeholder="Delivery / Gatepass number"
                                                            maxlength="40" />
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Carrier By</strong></td>
                                                    <td colspan="3">
                                                        <input type="text"
                                                            value="{{ old('recived_by') }}"
                                                            class="form-control"
                                                            name="recived_by" placeholder="Name"
                                                            maxlength="40" required>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td><strong>Carrier Mobile</strong></td>
                                                    <td colspan="3">
                                                        <input type="number"
                                                            step="0.01"
                                                            class="form-control"
                                                            value="{{ old('reciver_mobile') }}" name="reciver_mobile"
                                                            placeholder="Mobile" maxlength="12" required>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Remark</strong></td>
                                                    <td colspan="3">
                                                        <input type="text" class="form-control"
                                                            value="{{ old('remark') }}" name="remark"
                                                            placeholder="Remark" maxlength="12" required />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Invoice</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Booking Type -->
                                    <div class="col-md-6" style="font-size: 25px;">
                                        <label for="booking_type">Booking Type -:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p style="font-size: 25px;"><strong>{{ $booking->booking_type }}</strong></p>
                                    </div>

                                    <!-- Freight Charges -->
                                    <div class="col-md-6" style="font-size: 20px;">
                                        <label for="freight_charges">Freight Charges:</label>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="number"
                                            step="0.01"
                                            class="form-control"
                                            id="rs_amount_1"
                                            value="{{ $booking->booking_type == 'Topay' ? $booking->grand_total_amount : 0 }}"
                                            required name="freight_charges" placeholder="₹.00"
                                            oninput="calculateTotal()" readonly />
                                    </div>

                                    <!-- Hamali Charges -->
                                    <div class="col-md-6" style="font-size: 20px;">
                                        <label for="hamali_charges">Hamali Charges:</label>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="number"
                                            step="0.01"
                                            class="form-control" id="rs_amount_2"
                                            value="{{ old('hamali_charges') }}"
                                            name="hamali_charges"
                                            placeholder="₹.00" oninput="calculateTotal()">
                                    </div>

                                    <!-- Demurrage Charges -->
                                    <div class="col-md-6" style="font-size: 20px;">
                                        <label for="demruge_charges">Demurrage Charges:</label>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="number" 
                                            step="0.01"
                                            class="form-control" id="rs_amount_3"
                                            value="{{ old('demruge_charges') }}"
                                            name="demruge_charges"
                                            placeholder="₹.00"
                                            oninput="calculateTotal()" />
                                    </div>

                                    <!-- Other Charges -->
                                    <div class="col-md-6" style="font-size: 20px;">
                                        <label for="others_charges">Other Charges:</label>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="number" 
                                            step="0.01"
                                            class="form-control" id="rs_amount_4"
                                            value="{{ old('others_charges') }}"
                                            name="others_charges"
                                            placeholder="₹.00"
                                            oninput="calculateTotal()" />
                                    </div>

                                    <!-- Discount -->
                                    <div class="col-md-6" style="font-size: 20px;">
                                        <label for="discount">Discount:</label>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control" id="rs_amount_5"
                                            value="{{ old('discount') }}"
                                            name="discount"
                                            placeholder="₹.00"
                                            oninput="calculateTotal()">
                                    </div>

                                    <!-- Grand Total -->
                                    <div class="col-md-6" style="font-size: 25px; color: blue;">
                                        <label for="grand_total">Grand Total:</label>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="number" 
                                            step="0.01"
                                            class="form-control" id="grand_total"
                                            value="{{ old('grand_total') }}"
                                            name="grand_total"
                                            placeholder="₹.00"
                                            readonly />
                                    </div>
                                    <div class="col-md-6" style="font-size: 25px; color: green;">
                                        <label for="received_amount">Recived Amount:</label>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="number" 
                                            step="0.01"
                                            class="form-control" id="received_amount"
                                            oninput="calculateTotal()"
                                            value="{{ old('received_amount') }}"
                                            name="received_amount" placeholder="₹.00" />
                                    </div>
                                    <div class="col-md-6" style="font-size: 25px; color: red;">
                                        <label for="pendingAmount">Pending Amount:</label>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="number" 
                                            step="0.01"
                                            class="form-control"
                                            id="pendingAmount"
                                            value="{{ old('pending_amount') }}"
                                            name="pending_amount"
                                            placeholder="₹.00" readonly />
                                    </div>

                                    <div class="col-md-6" style="display: none;">
                                        <label for="parcel_image">Capture Image</label>
                                        <input type="file" name="parcel_image" id="parcel_image"
                                            class="form-control mb-1" />
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

                                        function calculateTotal() {
                                            // Get the booking type
                                            var bookingType = "{{ $booking->booking_type }}"; // Get booking type dynamically

                                            // Get values from each input field
                                            var freightCharges = (bookingType === 'Topay') ? parseFloat(document.getElementById('rs_amount_1').value) || 0 :
                                                0;
                                            var hamaliCharges = parseFloat(document.getElementById('rs_amount_2').value) || 0;
                                            var demrugeCharges = parseFloat(document.getElementById('rs_amount_3').value) || 0;
                                            var otherCharges = parseFloat(document.getElementById('rs_amount_4').value) || 0;
                                            var discount = parseFloat(document.getElementById('rs_amount_5').value) || 0;
                                            var received_amount = parseFloat(document.getElementById('received_amount').value) || 0;

                                            // Calculate grand total
                                            var grandTotal = (freightCharges + hamaliCharges + demrugeCharges + otherCharges) - discount;
                                            var pendingAmount = grandTotal - received_amount;
                                            // Set the calculated grand total in the grand total field
                                            document.getElementById('grand_total').value = grandTotal.toFixed(2);
                                            document.getElementById('pendingAmount').value = pendingAmount.toFixed(2);
                                        }
                                    </script>

                                    <div class="col-md-6">

                                        <!-- Button to open webcam -->
                                        <button type="button" class="btn btn-primary mt-4" onclick="openWebCam()">Open
                                            Webcam</button>


                                    </div>
                                    <div class="col-md-6">
                                        <!-- Video element to display the webcam feed -->
                                        <video id="webcam" width="225" height="200" style="display: none;"
                                            autoplay></video>

                                        <!-- Capture button that will appear after webcam is opened -->
                                        <button id="captureBtn" type="button" class="btn btn-secondary mt-4"
                                            style="display: none;" onclick="capturePhoto()">Capture Photo</button>

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
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                     
                        <input type="submit" value="Save & Print" class="btn btn-success float-right">
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection