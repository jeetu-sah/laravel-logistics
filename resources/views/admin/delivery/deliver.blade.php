@extends('admin.admin_layout.master')
@section('main_content')
<div class="content-wrapper" style="min-height: 1419.51px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="h3 mb-0 text-gray-800">{{ __('Generate Gatepass') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Generate Gatepass') }}</li>
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
                    <!-- Delivery Receipt Section -->
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title mb-0"><i class="fas fa-receipt mr-2"></i>{{ __('Delivery Receipt') }}</h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped align-middle m-0">
                                        <tbody>
                                            <tr>
                                                <td class="font-weight-bold" style="width: 30%;">{{ __('Consignor Name') }}</td>
                                                <td style="width: 20%;">{{ $booking->consignor_name }}</td>
                                                <td class="font-weight-bold" style="width: 30%;">{{ __('Consignee Name') }}</td>
                                                <td style="width: 20%;">{{ $booking->consignee_name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">{{ __('Booking Station') }}</td>
                                                <td>{{ $booking->consignorBranch->branch_name }}</td>
                                                <td class="font-weight-bold">{{ __('Delivery Station') }}</td>
                                                <td>{{ $booking->consigneeBranch->branch_name }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">{{ __('Offline Bilti Number') }}</td>
                                                <td>{{ $booking->manual_bilty_number ?: 'NA' }}</td>
                                                <td class="font-weight-bold">{{ __('Offline Booking Date') }}</td>
                                                <td>{{ formatOnlyDate($booking->created_at) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">{{ __('Online Booking Date') }}</td>
                                                <td>{{ formatDate($booking->created_at) }}</td>
                                                <td class="font-weight-bold">{{ __('Article') }}</td>
                                                <td>{{ $booking->no_of_artical }}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">{{ __('Online Bilty No.') }}</td>
                                                <td>{{ $booking->bilti_number ?? '--' }}</td>
                                                <td class="font-weight-bold">{{ __('Contain') }}</td>
                                                <td>{{ $booking->cantain }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="p-3 border-top">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="font-weight-bold">{{ __('Delivery / Gatepass Number') }}</label>
                                                <input type="text" value="{{ old('delivery_number') }}" class="form-control"
                                                    name="delivery_number" placeholder="{{ __('Enter delivery/gatepass number') }}" maxlength="40" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="font-weight-bold">{{ __('Carrier By') }}<span style="color: red"> *</span></label>
                                                <input type="text" value="{{ old('recived_by') }}" class="form-control"
                                                    name="recived_by" placeholder="{{ __('Enter carrier name') }}" maxlength="40" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="font-weight-bold">{{ __('Carrier Mobile') }}<span style="color: red"> *</span></label>
                                                <input type="number" step="0.01" class="form-control"
                                                    value="{{ old('reciver_mobile') }}" name="reciver_mobile"
                                                    placeholder="{{ __('Enter mobile number') }}" maxlength="12" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-0">
                                                <label class="font-weight-bold">{{ __('Remark') }}<span style="color: red"> *</span></label>
                                                <input type="text" class="form-control" value="{{ old('remark') }}"
                                                    name="remark" placeholder="{{ __('Enter remark') }}" maxlength="100" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Invoice Section -->
                    <div class="col-md-6">
                        <div class="card card-success">
                            <div class="card-header bg-success text-white">
                                <h3 class="card-title mb-0"><i class="fas fa-file-invoice-dollar mr-2"></i>{{ __('Invoice') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="h5 font-weight-bold">{{ __('Booking Type') }}:</label>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="h5 font-weight-bold text-primary">{{ $booking->booking_type }}</p>
                                    </div>
                                </div>
                                <div class="invoice-details">
                                    <div class="form-group row mb-3">
                                        <label for="freight_charges" class="col-md-6 col-form-label font-weight-bold">{{ __('Freight Charges') }}<span style="color: red"> *</span>:</label>
                                        <div class="col-md-6">
                                            <input type="number" step="0.01" class="form-control" id="rs_amount_1"
                                                value="{{ $booking->booking_type == 'Topay' ? $booking->grand_total_amount : 0 }}"
                                                required name="freight_charges" placeholder="₹.00"
                                                oninput="calculateTotal()" readonly />
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="hamali_charges" class="col-md-6 col-form-label font-weight-bold">{{ __('Hamali Charges') }}:</label>
                                        <div class="col-md-6">
                                            <input type="number" step="0.01" class="form-control" id="rs_amount_2"
                                                value="{{ old('hamali_charges') }}" name="hamali_charges"
                                                placeholder="₹.00" oninput="calculateTotal()">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="demruge_charges" class="col-md-6 col-form-label font-weight-bold">{{ __('Demurrage Charges') }}:</label>
                                        <div class="col-md-6">
                                            <input type="number" step="0.01" class="form-control" id="rs_amount_3"
                                                value="{{ old('demruge_charges') }}" name="demruge_charges"
                                                placeholder="₹.00" oninput="calculateTotal()" />
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="others_charges" class="col-md-6 col-form-label font-weight-bold">{{ __('Other Charges') }}:</label>
                                        <div class="col-md-6">
                                            <input type="number" step="0.01" class="form-control" id="rs_amount_4"
                                                value="{{ old('others_charges') }}" name="others_charges"
                                                placeholder="₹.00" oninput="calculateTotal()" />
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="discount" class="col-md-6 col-form-label font-weight-bold">{{ __('Discount') }}:</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="rs_amount_5"
                                                value="{{ old('discount') }}" name="discount"
                                                placeholder="₹.00" oninput="calculateTotal()">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="grand_total" class="col-md-6 col-form-label h5 font-weight-bold text-primary">{{ __('Grand Total') }}:</label>
                                        <div class="col-md-6">
                                            <input type="number" step="0.01" class="form-control font-weight-bold" id="grand_total"
                                                value="{{ old('grand_total') }}" name="grand_total"
                                                placeholder="₹.00" readonly />
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label for="received_amount" class="col-md-6 col-form-label h5 font-weight-bold text-success">{{ __('Received Amount') }}:</label>
                                        <div class="col-md-6">
                                            <input type="number" step="0.01" class="form-control" id="received_amount"
                                                oninput="calculateTotal()" value="{{ old('received_amount') }}"
                                                name="received_amount" placeholder="₹.00" />
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label for="pendingAmount" class="col-md-6 col-form-label h5 font-weight-bold text-danger">{{ __('Pending Amount') }}:</label>
                                        <div class="col-md-6">
                                            <input type="number" step="0.01" class="form-control font-weight-bold" id="pendingAmount"
                                                value="{{ old('pending_amount') }}" name="pending_amount"
                                                placeholder="₹.00" readonly />
                                        </div>
                                    </div>
                                </div>

                                <!-- Webcam Section -->
                                <div class="webcam-section border-top pt-3">
                                    <h5 class="font-weight-bold mb-3"><i class="fas fa-camera mr-2"></i>{{ __('Parcel Photo') }}</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-primary btn-block" onclick="openWebCam()">
                                                <i class="fas fa-camera mr-2"></i>{{ __('Open Webcam') }}
                                            </button>
                                        </div>
                                        <div class="col-md-6">
                                            <button id="captureBtn" type="button" class="btn btn-secondary btn-block"
                                                style="display: none;" onclick="capturePhoto()">
                                                <i class="fas fa-camera-retro mr-2"></i>{{ __('Capture Photo') }}
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-6 text-center">
                                            <video id="webcam" width="100%" height="200" style="display: none; border-radius: 8px;" autoplay></video>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <img id="capturedImage" width="100%" height="200" style="display: none; border-radius: 8px;"
                                                alt="{{ __('Captured Image') }}" />
                                        </div>
                                    </div>

                                    <canvas id="canvas" style="display: none;"></canvas>
                                    <input type="file" name="parcel_image" id="parcel_image" class="d-none" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center py-3">
                                <input type="submit" value="{{ __('Save & Print') }}" class="btn btn-success btn-lg px-5">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
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
                    captureButton.style.display = 'block'; // Show the capture button
                })
                .catch(function(err) {
                    alert('{{ __("Error accessing webcam") }}: ' + err);
                });
        } else {
            alert('{{ __("Your browser does not support webcam access.") }}');
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
        var freightCharges = (bookingType === 'Topay') ? parseFloat(document.getElementById('rs_amount_1').value) || 0 : 0;
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

@if(Session::has('redirectAnotherRoute'))
@php $redirectRoute = Session::get("route") @endphp
<script>
    setTimeout(function() {
        const redirectRoute = "{{ $redirectRoute }}";
        if (redirectRoute) {
            window.open(redirectRoute, '_blank');
        }
    }, 0);
</script>
@endif
@endsection