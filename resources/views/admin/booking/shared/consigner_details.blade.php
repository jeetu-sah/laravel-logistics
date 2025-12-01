<div class="col-md-9">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                @if($bookingType === \App\Models\Booking::CLIENT_BOOKING)
                <div class="col-md-6 mb-1">
                    <label for="date">{{ __('Select From Client') }}:</label>
                    <select required class="form-select select2 form-control js-select2" name="client_from_id" id="client_from_id">
                        <option value="">{{ __('Select From Client') }}</option>
                        @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                        @endforeach
                    </select>
                    <div id="client_details"></div>
                </div>
                <div class="col-md-6 mb-1">
                    <label for="date">{{ __('Select To Client') }}:</label>
                    <select required class="form-select select2 form-control js-select2" name="client_to_id" id="client_to_id">
                        <option value="">{{ __('Select To Client') }}</option>
                        @foreach ($toClients as $client)
                        <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                        @endforeach
                    </select>
                    <div id="client_details"></div>
                </div>
                @endif
            </div>
            <div class="form-row align-items-end mb-3">
                <div class="col-md-2 mb-1">
                    <label for="manual_bilty">{{ __('Online Bilty No.') }}</label>
                    <input type="text" value="{{ $nextOnlineBuiltyNumber }}" class="form-control" name="bilti_number" id="bilti_number" />
                </div>
                <div class="col-md-2 mb-1">
                    <label for="manual_bilty">{{ __('Offline Bilty No.') }}</label>
                    <input type="text" class="form-control" name="manual_bilty" value="{{ old('manual_bilty') }}" id="manual_bilty" />
                </div>

                <div class="col-md-2 mb-1">
                    <label for="offline_booking_date">{{ __('Offline Booking Date') }}</label>
                    <input type="date" class="form-control" name="offline_booking_date" value="{{ old('offline_booking_date') }}" id="offline_booking_date" />
                </div>

                <div class="col-md-2 mb-1 ml-4 d-flex align-items-center">
                    <div class="form-check">
                        <input type="checkbox"
                            name="booking"
                            class="form-check-input"
                            style="transform: scale(3.2); margin-top: -1px;"
                            value="Paid" id="paid"
                            {{ ($bookingType === \App\Models\Booking::CLIENT_BOOKING) ? 'checked' : '' }}
                            onclick="uncheckOther(this)" />
                        <label class="form-check-label ml-4" style="font-size:18px;" for="paid"><strong>{{ __('Paid') }}</strong></label>
                    </div>
                </div>

                <div class="col-md-2 mb-1 d-flex align-items-center">
                    <div class="form-check">
                        <input type="checkbox"
                            style="transform: scale(3.2); margin-top: -1px;"
                            class="form-check-input" name="booking" value="Topay" id="to_pay" onclick="uncheckOther(this)" />
                        <label class="form-check-label ml-4" for="to_pay"><strong>{{ __('To Pay') }}</strong></label>
                    </div>
                </div>
            </div>

            <div class="row">
                <script>
                    function uncheckOther(checkbox) {
                        var paidCheckbox = document.getElementById('paid');
                        var toPayCheckbox = document.getElementById('to_pay');
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
                    <label for="date">{{ __('Date') }}:</label>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" value="{{ now()->format('Y-m-d') }}" id="booking-time"
                        name="booking_date" readonly />
                </div>

                <div class="col-md-2">
                    <label for="date">{{ __('Transhipment 1') }}:</label>
                </div>
                <div class="col-md-3">
                    <select class="form-select select2 form-control js-select2 manageCalculateInvoice selectBranch"
                        disabled
                        name="transhipmen_one" id="transhipmen_one">
                        <option value="">{{ __('Select Branch Name') }}</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <label for="date">{{ __('From') }}:<span style="color: red"> *</span></label>
                </div>
                <div class="col-md-3 mb-1">
                    <select class="form-select select2 form-control js-select2 selectBranch" name="consignor_branch_id"
                        id="consignor_branch_id">
                        <option value="">{{ __('Select Branch Name') }}</option>
                        @foreach ($branch as $branchList)
                        <option value="{{ $branchList->id }}" @if ($branchList->id != $user->branch_user_id) disabled @endif
                            @if ($branchList->id == $user->branch_user_id) selected @endif>
                            {{ $branchList->branch_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="text">{{ __('Transhipment 2') }}:</label>
                </div>
                <div class="col-md-3">
                    <select class="form-select select2 form-control js-select2 manageCalculateInvoice selectBranch"
                        disabled
                        name="transhipmen_two" id="transhipmen_two">
                        <option value="">{{ __('Select Branch Name') }}</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <label for="date">{{ __('To') }}:<span style="color: red"> *</span></label>
                </div>
                <div class="col-md-3">
                    <select class="form-select select2 form-control js-select2 toBranch selectBranch" name="consignee_branch_id" id="consignee_branch_id">
                        <option value="">{{ __('Select Branch Name') }}</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="text">{{ __('Transhipment 3') }}:</label>
                </div>
                <div class="col-md-3">
                    <select class="form-select select2 form-control js-select2 manageCalculateInvoice selectBranch"
                        disabled
                        name="transhipment_three" id="transhipment_three">
                        <option value="">{{ __('Select Branch Name') }}</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <label for="no_of_artical">{{ __('Total Number Of Articles') }}:<span style="color: red"> *</span></label>
                </div>
                <div class="col-md-1">
                    <input min="0" type="number" id="no_of_articles" name="no_of_artical" class="form-control mb-1" value="{{ old('no_of_artical') }}" required />
                </div>
                <div class="col-md-1">
                    <label for="actual_weight">{{ __('Weight (kg)') }}:<span style="color: red"> *</span></label>
                </div>
                <div class="col-md-1">
                    <input type="number" min="0" name="actual_weight" class="form-control mb-1" step="0.01" value="{{ old('actual_weight') }}" />
                </div>
                <div class="col-md-1">
                    <label for="cantain">{{ __('Cantain') }}<span style="color: red"> *</span></label>
                </div>
                <div class="col-md-2">
                    <input type="text" name="cantain" value="{{ old('cantain') }}" class="form-control mb-1" />
                </div>
                <div class="col-md-2">
                    <label for="good_of_value">{{ __('Goods Of Value') }}:<span style="color: red"> *</span></label>
                </div>
                <div class="col-md-2">
                    <input type="number" min="0" step="0.01" value="{{ old('good_of_value') }}" id="good_of_value" name="good_of_value"
                        oninput="calculateFOV()" class="form-control mb-1" required />
                </div>
            </div>

            <div class="row">
                <div class="col-md-6"> <label for="date" style="font-size:20px;">{{ __('Consignor Details') }}:</label></div>
                <div class="col-md-6"> <label for="date" style="font-size:20px;">{{ __('Consignee Details') }}:</label></div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="date">{{ __('Name') }}:<span style="color: red"> *</span></label>
                </div>
                <div class="col-md-3">
                    <input type="text" name="consignor_name" value="{{ old('consignor_name') }}" id="consignor_name" class="form-control mb-1" />
                </div>

                <div class="col-md-3">
                    <label for="date">{{ __('Name') }}:<span style="color: red"> *</span></label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ old('consignee_name') }}" id="consignee_name" name="consignee_name" class="form-control mb-1" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="date">{{ __('Address') }}:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ old('consignor_address') }}" name="consignor_address" id="consignor_address" class="form-control mb-1" />
                </div>

                <div class="col-md-3">
                    <label for="date">{{ __('Address') }}:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ old('consignee_address') }}" name="consignee_address" id="consignee_address" class="form-control mb-1" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="date">{{ __('Mobile') }}:</label>
                </div>
                <div class="col-md-3">
                    <input type="mobile" value="{{ old('consignor_phone_number') }}" name="consignor_phone_number" id="consignor_phone_number" class="form-control mb-1" />
                </div>
                <div class="col-md-3">
                    <label for="date">{{ __('Mobile') }}:</label>
                </div>
                <div class="col-md-3">
                    <input type="mobile" value="{{ old('consignee_phone_number') }}" name="consignee_phone_number" id="consignee_phone_number" class="form-control mb-1" />
                </div>
            </div>
            @if($bookingType !== \App\Models\Booking::NO_BOOKING)
            <div class="row">
                <div class="col-md-3">
                    <label for="date">{{ __('GST') }}:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ old('consignor_gst_number') }}" name="consignor_gst_number" id="consignor_gst_number" class="form-control mb-1" />
                </div>
                <div class="col-md-3">
                    <label for="date">{{ __('GST') }}:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ old('consignee_gst_number') }}" name="consignee_gst_number" id="consignee_gst_number" class="form-control mb-1" />
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-3">
                    <label for="date">{{ __('Email') }}:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ old('consignor_email') }}" name="consignor_email" id="consignor_email" class="form-control mb-1" />
                </div>
                <div class="col-md-3">
                    <label for="date">{{ __('Email') }}:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ old('consignee_email') }}" id="consignee_email" name="consignee_email" class="form-control mb-1" />
                </div>
            </div>
            @if($bookingType !== \App\Models\Booking::NO_BOOKING)
            <div class="row">
                <div class="col-md-3">
                    <label for="date">{{ __('Invoice Number') }}</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ old('invoice_number') }}" name="invoice_number" id="invoice_number" class="form-control mb-1" />
                </div>
                <div class="col-md-3">
                    <label for="date">{{ __('Eway Bill Number') }}:</label>
                </div>
                <div class="col-md-3">
                    <input type="text" value="{{ old('eway_bill_number') }}" name="eway_bill_number" class="form-control mb-1" />
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-4">
                    <label for="date">{{ __('Aadhar Card') }}</label>
                    <input type="text" value="{{ old('aadhar_card') }}" name="aadhar_card" class="form-control mb-1" />
                </div>
                <div class="col-md-4">
                    <label for="date">{{ __('Value Declare by Consignee') }}.</label>
                    <input type="text" value="{{ old('mark') }}" name="mark" class="form-control mb-1" />
                </div>
                <div class="col-md-4">
                    <label for="date">{{ __('Remark') }}</label>
                    <input type="text" value="{{ old('remark') }}" name="remark" class="form-control mb-1" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="date">{{ __('Upload Photo ID Image') }}:</label>
                    <input type="file" class="form-control mb-1" name="photo_id" />
                </div>
                <div class="col-md-3">
                    <label for="parcel_image">{{ __('Capture Image') }}</label>
                    <input type="file" name="parcel_image" id="parcel_image" class="form-control mb-1" />
                </div>
                <script>
                    let stream;

                    function openWebCam() {
                        const video = document.getElementById('webcam');
                        const captureButton = document.getElementById('captureBtn');
                        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                            navigator.mediaDevices.getUserMedia({
                                    video: true
                                })
                                .then(function(userStream) {
                                    stream = userStream;
                                    video.srcObject = stream;
                                    video.style.display = 'block';
                                    captureButton.style.display = 'inline-block';
                                })
                                .catch(function(err) {
                                    alert('{{ __("Error accessing webcam:") }} ' + err);
                                });
                        } else {
                            alert('{{ __("Your browser does not support webcam access.") }}');
                        }
                    }

                    function capturePhoto() {
                        const video = document.getElementById('webcam');
                        const canvas = document.getElementById('canvas');
                        const context = canvas.getContext('2d');
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);
                        const imageType = 'image/jpeg';
                        const capturedImageData = canvas.toDataURL(imageType);
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
                        const file = new File([blob], 'parcel_image.jpg', {
                            type: mimeString
                        });
                        const parcelImageInput = document.getElementById('parcel_image');
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        parcelImageInput.files = dataTransfer.files;
                        const image = document.getElementById('capturedImage');
                        image.src = capturedImageData;
                        image.style.display = 'block';
                        const tracks = stream.getTracks();
                        tracks.forEach(track => track.stop());
                        video.style.display = 'none';
                        document.getElementById('captureBtn').style.display = 'none';
                    }
                </script>

                <div class="col-md-3">
                    <label for="date">{{ __('Captured Image') }}</label>
                    <button type="button" class="btn btn-primary mt-4" onclick="openWebCam()">{{ __('Open Webcam') }}</button>
                    <video id="webcam" width="100%" autoplay style="display:none;"></video>
                    <button type="button" class="btn btn-success mt-2" id="captureBtn" style="display:none;" onclick="capturePhoto()">{{ __('Capture Photo') }}</button>
                    <canvas id="canvas" style="display:none;"></canvas>
                    <img id="capturedImage" src="" alt="{{ __('Captured Image') }}" width="100%" style="display:none; margin-top:10px;" />
                </div>
            </div>
        </div>
    </div>
</div>