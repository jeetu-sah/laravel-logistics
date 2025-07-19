<div class="col-md-9">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
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
                        <option value="{{ $branchList->id }}" @if ($branchList->id == $client->consignor_branch_id) selected @endif>
                            {{ $branchList->branch_name }}
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
                        <option value="{{ $branchList->id }}" @if ($branchList->id == $client->consignee_branch_id) selected @endif>
                            {{ $branchList->branch_name }}
                        </option>
                        @endforeach
                    </select>
                    @error('consignor_branch_id')
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
                    <input type="text" name="consignor_name" value="{{ $client->consignor_name }}" class="form-control mb-1" />
                    @error('consignor_branch_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">

                    <label for="date">Name:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" name="consignee_name" value="{{ $client->consignee_name }}" class="form-control mb-1" />
                    @error('consignor_branch_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

            </div>
            <div class="row">
                <div class="col-md-3">

                    <label for="date">Address:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="{{ $client->consignor_address }}" name="consignor_address" class="form-control mb-1" />
                    @error('consignor_branch_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="col-md-3">

                    <label for="date">Address:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="{{ $client->consignee_address }}" name="consignee_address" class="form-control mb-1" />
                    @error('consignor_branch_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

            </div>
            <div class="row">
                <div class="col-md-3">

                    <label for="date">mobile:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="{{ $client->consignor_phone_number }}" name="consignor_phone_number" class="form-control mb-1" />
                    @error('consignor_branch_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="col-md-3">

                    <label for="date">mobile:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="{{ $client->consignee_phone_number }}" name="consignee_phone_number" class="form-control mb-1" />
                    @error('consignor_branch_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

            </div>
            <div class="row">
                <div class="col-md-3">

                    <label for="date">GST:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="{{ $client->consignor_gst_number }}" name="consignor_gst_number" class="form-control mb-1" />
                    @error('consignor_branch_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="col-md-3">

                    <label for="date">GST:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="{{ $client->consignee_gst_number }}" name="consignee_gst_number" class="form-control mb-1" />
                    @error('consignor_branch_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

            </div>
            <div class="row">
                <div class="col-md-3">

                    <label for="date">Email:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" name="consignor_email" value="{{ $client->consignor_email }}" class="form-control mb-1" />
                    @error('consignor_branch_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

                <div class="col-md-3">

                    <label for="date">Email:</label>

                </div>
                <div class="col-md-3">

                    <input type="text" value="{{ $client->consignee_email }}" name="consignee_email" class="form-control mb-1" />
                    @error('consignor_branch_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>

            </div>

            <div class="row">
                <div class="col-md-4">

                    <label for="date">Aadhar card</label>
                    <input type="text" name="aadhar_card" value="{{ $client->aadhar_card }}" class="form-control mb-1 mb-1" />
                    @error('consignor_branch_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror


                </div>

            </div>

        </div>

    </div>

</div>