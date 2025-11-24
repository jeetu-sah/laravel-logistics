<div class="col-md-9">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
        <div class="card-body">

            <div class="row mb-2">
                @if($bookingType === \App\Models\Booking::CLIENT_BOOKING)
                <div class="col-md-4 mb-1">
                    <label for="date">Select Client:</label>
                    <select required class="form-select select2 form-control js-select2" name="client_id" id="client_id">
                        <option value="">Select Client</option>
                        @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                        @endforeach
                    </select>
                    <div id="client_details"></div>
                </div>
                @endif
                <div class="col-md-2 mb-1">
                    <label for="manual_bilty">{{ __('Online Bilty No.') }}</label>
                    <input type="text" value="{{ $booking->bilti_number }}" class="form-control" name="bilti_number" id="bilti_number" />
                </div>
                <div class="col-md-2 mb-1">
                    <label for="date">Offline Bilty No.</label>
                    <input
                        type="text"
                        class="form-control"
                        name="manual_bilty"
                        value="{{ $booking->manual_bilty_number }}"
                        id="manual_bilty" />

                </div>
                <div class="col-md-2 mb-1">
                    <label for="date">offline Booking Date</label>
                    <input type="date" class="form-control"
                        name="offline_booking_date"
                        value="{{ $booking->offline_booking_date }}"
                        id="offline_booking_date" />

                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="">
                        <label for="date">Paid:</label>
                    </div>
                </div>
                <div class="col-md-1">
                    <input type="checkbox"
                        name="booking"
                        class="form-control"
                        value="Paid"
                        id="paid"
                        onclick="uncheckOther(this)"
                        {{ ($booking->booking_type == "Paid") ? 'checked' : ''}} />
                </div>

                <div class="col-md-1 mb-2">
                    <div class="">
                        <label for="date">To Pay:</label>
                    </div>
                </div>
                <div class="col-md-1 mb-2">
                    <div class="">
                        <input type="checkbox" class="form-control" name="booking" value="Topay" id="to_pay"
                            onclick="uncheckOther(this)" {{ ($booking->booking_type == "Topay") ? 'checked' : ''}} />
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
                    <input type="date" class="form-control"
                        value="{{ $booking->booking_date }}"
                        id="booking_date"
                        name="booking_date" readonly />
                </div>

                <div class="col-md-2">
                    <div class="">
                        <label for="date">Transhipment 1:</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="">
                        <select class="form-select select2 form-control js-select2 manageCalculateInvoice selectBranch"
                            name="transhipmen_one" id="transhipmen_one">
                            @if($transhipmentOne)
                            <option value="{{$transhipmentOne->id}}">{{$transhipmentOne->branch_name}}</option>
                            @else
                            <option value="">Select Branch Name</option>
                            @endif

                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="">
                        <label for="date">From<span style="color: red"> *</span>:</label>
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
                        name="transhipmen_two" id="transhipmen_two">
                        @if($transhipmentTwo)
                        <option value="{{$transhipmentTwo->id}}">{{$transhipmentTwo->branch_name}}</option>
                        @else
                        <option value="">Select Branch Name</option>
                        @endif

                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="">
                        <label for="date">To<span style="color: red"> *</span>:</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-select select2 form-control js-select2 toBranch selectBranch"
                        name="consignee_branch_id" id="consignee_branch_id">
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
                        name="transhipment_three" id="transhipment_three">
                        @if($transhipmentThree)
                        <option value="{{$transhipmentThree->id}}">{{$transhipmentThree->branch_name}}</option>
                        @else
                        <option value="">Select Branch Name</option>
                        @endif

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
                        <input min="0" type="number"
                            id="no_of_articles"
                            name="no_of_artical"
                            class="form-control mb-1"
                            value="{{ $booking->no_of_artical }}" />
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="">
                        <label for="actual_weight">Weight (kg):</label>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="">
                        <input type="number"
                            min="0"
                            step="0.01"
                            name="actual_weight"
                            class="form-control mb-1"
                            value="{{ $booking->actual_weight }}" />
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="">
                        <label for="cantain">Cantain</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="">
                        <input type="text" name="cantain" value="{{ $booking->cantain }}" class="form-control mb-1" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="">
                        <label for="good_of_value">Goods Of Value<span style="color: red"> *</span>:</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="">
                        <input type="number" min="0"
                            step="0.01"
                            value="{{ $booking->good_of_value }}"
                            id="good_of_value"
                            name="good_of_value"
                            oninput="calculateFOV()" class="form-control mb-1" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6"> <label for="date" style="font-size:20px;">Sender Details:</label></div>
                <div class="col-md-6"> <label for="date" style="font-size:20px;">Receiver Details:</label></div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="date">Name<span style="color: red"> *</span>:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" name="consignor_name" value="{{ $booking->consignor_name }}" class="form-control mb-1" />
                </div>

                <div class="col-md-3">
                    <label for="date">Name<span style="color: red"> *</span>:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ $booking->consignee_name }}" id="consignee_name"
                        name="consignee_name" class="form-control mb-1" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="date">Address:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ $booking->consignor_address }}" name="consignor_address" id="consignor_address" class="form-control mb-1" />
                </div>

                <div class="col-md-3">
                    <label for="date">Address:</label>
                </div>
                <div class="col-md-3">
                    <input type="text"
                        value="{{ $booking->consignee_address }}"
                        name="consignee_address" id="consignee_address" class="form-control mb-1" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="date">mobile:</label>
                </div>
                <div class="col-md-3">
                    <input type="mobile" value="{{ $booking->consignor_phone_number }}" name="consignor_phone_number" id="consignor_phone_number" class="form-control mb-1" />
                </div>
                <div class="col-md-3">
                    <label for="date">mobile:</label>
                </div>
                <div class="col-md-3">
                    <input type="mobile" value="{{ $booking->consignee_phone_number }}" name="consignee_phone_number" id="consignee_phone_number" class="form-control mb-1" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="date">GST:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ $booking->consignor_gst_number }}" name="consignor_gst_number" id="consignor_gst_number" class="form-control mb-1" />
                </div>
                <div class="col-md-3">
                    <label for="date">GST:</label>
                </div>
                <div class="col-md-3">

                    <input type="text" value="{{ $booking->consignee_gst_number }}" name="consignee_gst_number" id="consignee_gst_number" class="form-control mb-1" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="date">Email:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ $booking->consignor_email }}" name="consignor_email" id="consignor_email" class="form-control mb-1" />
                </div>
                <div class="col-md-3">
                    <label for="date">Email:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ $booking->consignee_email }}" id="consignee_email" name="consignee_email" class="form-control mb-1" />

                </div>

            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="date">Invoice Number</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ $booking->invoice_number }}" name="invoice_number" id="invoice_number" class="form-control mb-1" />
                </div>
                @if($bookingType != \App\Models\Booking::NO_BOOKING)
                <div class="col-md-3">
                    <label for="date">Eway Bill Number:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ $booking->eway_bill_number }}" name="eway_bill_number" class="form-control mb-1" />
                </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="aadhar_card">Aadhar card</label>
                    <input type="text" value="{{ $booking->aadhar_card }}" name="aadhar_card" class="form-control mb-1 mb-1" />
                </div>
                <div class="col-md-4">
                    <label for="mark">Value Declare by Receiver.</label>
                    <input type="text" value="{{ $booking->mark }}" name="mark" class="form-control mb-1 mb-1" />
                </div>
                <div class="col-md-4">
                    <label for="remark">Remark</label>
                    <input type="text" value="{{ $booking->remark }}" name="remark" class="form-control mb-1 mb-1" />
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