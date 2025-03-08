@extends('admin.admin_layout.master')
@section('main_content')
    <div class="content-wrapper" style="min-height: 1419.51px;">
        <!-- Content Header (Page header) -->


        <section class="content">
            <div class="container-fluid">
                <form action="{{ url('admin/delivery/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{ $booking->id }}" name="booking_id">
                    <div class="row">
                        {{-- @include('admin.booking.shared.client_booking') --}}
                        <div class="col-md-6">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Delivery receipt</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Distance -->
                                        <div class="col-md-6">
                                            <label for="distance">Delivery Station -:</label>
                                        </div>
                                        <div class="col-md-6">
                                           <p>{{ $booking->consignee_branch_name  }}</p>
                                        </div>

                                        <!-- Freight -->
                                        <div class="col-md-6">
                                            <label for="freight_amount">Booking Station -:</label>
                                        </div>
                                        <div class="col-md-6">
                                           <p>{{ $booking->consignor_branch_name }}</p>
                                        </div>

                                        <!-- WBC -->
                                        <div class="col-md-6">
                                            <label for="wbc_charges">Offline Bili Number -:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p>{{ $booking->manual_bilty_number ? : 'NA' }}</p>
                                        </div>

                                        <!-- Handling Charges -->
                                        <div class="col-md-6">
                                            <label for="handling_charges">Date Of Booking -:</label>
                                        </div>
                                        <div class="col-md-6">
                                           <p>{{ \Carbon\Carbon::parse($booking->created_at)->format('d-m-y') }}
                                        </p>
                                        </div>

                                        <!-- FOV -->
                                        <div class="col-md-6">
                                            <label for="fov_amount">Number Of Article -:</label>
                                        </div>
                                        <div class="col-md-6">
                                           <p>{{ $booking->no_of_artical }}</p>
                                        </div>

                                        <!-- Fuel Charges -->
                                        <div class="col-md-6">
                                            <label for="fuel_amount">Privet Mark -:</label>
                                        </div>
                                        <div class="col-md-6">
                                           <p>{{ $booking->remark }}</p>
                                        </div>
                                        <!-- Fuel Charges -->
                                        <div class="col-md-6">
                                            <label for="fuel_amount">Contain -:</label>
                                        </div>
                                        <div class="col-md-6">
                                           <p>{{ $booking->cantain }}</p>
                                        </div>

                                        <!-- Transhipment 1 -->
                                        <div class="col-md-6">
                                            <label for="transhipmen_one_amount">Recived By: <input type="text" class="mt-2 form-control" id=""
                                                value="" required name="recived_by" placeholder="Name" maxlength="40"
                                                ></label>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="transhipmen_one_amount">Reciver mobile: <input type="tel" class="form-control mt-2" id=""
                                                value="" required name="reciver_mobile" placeholder="mobile" maxlength="12"
                                                ></label>
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
                                        <!-- freight_charges -->
                                        <div class="col-md-6">
                                            <label for="freight_charges">Freight Charges:</label>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <input type="number" class="form-control" id="rs_amount_1"
                                            readonly   value="{{ $booking->freight_amount }}" required name="freight_charges" placeholder="₹.00"
                                               oninput="calculateTotal()">
                                        </div>
                                        <!-- hamali_charges -->
                                        <div class="col-md-6">
                                            <label for="hamali_charges">Hamali Charges:</label>
                                        </div>
                                        <div class="col-md-6  mb-2">
                                            <input type="number" class="form-control" id="rs_amount_2"
                                                        value="" required name="hamali_charges" placeholder="₹.00"
                                                        oninput="calculateTotal()">
                                        </div>

                                        <!-- demruge_charges -->
                                        <div class="col-md-6">
                                            <label for="demruge_charges">Demurrege Charges:</label>
                                        </div>
                                        <div class="col-md-6  mb-2">
                                            <input type="number" class="form-control" id="rs_amount_3"
                                                        value="" required name="demruge_charges" placeholder="₹.00"
                                                        oninput="calculateTotal()">
                                        </div>

                                        <!-- others_charges -->
                                        <div class="col-md-6">
                                            <label for="others_charges">Others Charges:</label>
                                        </div>
                                        <div class="col-md-6  mb-2">
                                            <input type="number" class="form-control" id="rs_amount_4"
                                            value="" required name="others_charges" placeholder="₹.00"
                                            oninput="calculateTotal()">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="grand_total">Grand Total:</label>
                                        </div>
                                        <div class="col-md-6  mb-2">
                                            <input type="number" class="form-control" id="grand_total"
                                            value="" required name="grand_total" placeholder="₹.00"
                                            readonly>
                                        </div>
                                        <div class="col-md-6" style="display: none;">
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
<script>
    function calculateTotal() {
        // Get values from each input field
        // var freightCharges = parseFloat(document.getElementById('rs_amount_1').value) || 0;
        var hamaliCharges = parseFloat(document.getElementById('rs_amount_2').value) || 0;
        var demrugeCharges = parseFloat(document.getElementById('rs_amount_3').value) || 0;
        var otherCharges = parseFloat(document.getElementById('rs_amount_4').value) || 0;

        // Calculate grand total
        var grandTotal =  hamaliCharges + demrugeCharges + otherCharges;

        // Set the calculated grand total in the grand total field
        document.getElementById('grand_total').value = grandTotal.toFixed(2);
    }
</script>
