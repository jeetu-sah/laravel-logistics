@extends('admin.admin_layout.master')
@section('main_content')
    <div class="content-wrapper" style="min-height: 1419.51px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ url('admin/branch/branch-list') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                                class=" fa-sm text-white-50"></i> Branch List</a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Create Branch</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Branch</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form action="{{ route('admin.create-new-branch') }}" method="post" id="form" name="pForm"
                            enctype="multipart/form-data" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-row">

                                <!-- Branch Name -->
                                <div class="col-md-4 mb-2">
                                    <label for="branch_name" class="form-label">Branch Name</label>
                                    <input class="form-control" name="branch_name" id="branch_name"
                                        placeholder="Branch Name" required>
                                    <div class="invalid-feedback">Enter Branch name</div>
                                    @error('branch_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Branch Code -->
                                <div class="col-md-4 mb-2">
                                    <label for="branch_code" class="form-label">Branch Code</label>
                                    <input class="form-control" name="branch_code" id="branch_code"
                                        placeholder="Branch Code" required>
                                    <div class="invalid-feedback">Enter Branch code</div>
                                    @error('branch_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Branch Owner Name -->
                                <div class="col-md-4 mb-2">
                                    <label for="owner_name" class="form-label">Branch Owner Name</label>
                                    <input class="form-control" name="owner_name" id="owner_name" placeholder="Owner Name"
                                        required>
                                    <div class="invalid-feedback">Enter Owner name</div>
                                    @error('owner_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Contact Number -->
                                <div class="col-md-6 mb-2">
                                    <label for="contact" class="form-label">Contact Number</label>
                                    <input class="form-control" name="contact" id="contact" placeholder="Contact Number"
                                        required>
                                    <div class="invalid-feedback">Enter contact number</div>
                                    @error('contact')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- GST No. -->
                                <div class="col-md-6 mb-2">
                                    <label for="gst" class="form-label">GST No.</label>
                                    <input class="form-control" name="gst" id="gst" placeholder="GST No."
                                        required>
                                    <div class="invalid-feedback">Enter GST No.</div>
                                    @error('gst')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Country -->
                                <div class="col-md-4 mb-2">
                                    <label for="country_name" class="form-label">Country</label>
                                    <select class="form-select select2 form-control" name="country_name" id="country_name"
                                        required>
                                        <option selected disabled value="">Select Country</option>
                                        <option value="1">India</option>
                                        <!-- Add countries here -->
                                    </select>
                                    <div class="invalid-feedback">Select Country</div>
                                    @error('country_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- State -->
                                <div class="col-md-4 mb-2">
                                    <label for="state_name" class="form-label">State</label>
                                    <select class="form-select select2 form-control" name="state_name" id="state_name"
                                        required>
                                        <option selected disabled value="">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->state_id }}">{{ $state->state_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Select State</div>
                                    @error('state_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- City -->
                                <div class="col-md-4 mb-2">
                                    <label for="district_name" class="form-label">City</label>
                                    <select class="form-select select2 form-control" name="district_name" id="district_name"
                                        required>
                                        <option selected disabled value="">Select City</option>
                                        <!-- Add cities here -->
                                    </select>
                                    <div class="invalid-feedback">Select City</div>
                                    @error('district_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Address 1 -->
                                <div class="col-md-4 mb-2">
                                    <label for="address1" class="form-label">Address 1</label>
                                    <textarea class="form-control" name="address1" id="address1" placeholder="Address 1" required></textarea>
                                    <div class="invalid-feedback">Enter Address 1</div>
                                    @error('address1')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Address 2 -->
                                <div class="col-md-4 mb-2">
                                    <label for="address2" class="form-label">Address 2</label>
                                    <textarea class="form-control" name="address2" id="address2" placeholder="Address 2"></textarea>
                                    <div class="invalid-feedback">Enter Address 2</div>
                                    @error('address2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="col-md-4">
                                    <label for="user_status" class="form-label">Status</label>
                                    <select class="form-select select2 form-control" name="user_status" id="user_status"
                                        required>
                                        <option selected disabled value="">Select Status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    @error('user_status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="invalid-feedback">Select Status</div>
                                </div>

                            </div>
                            <button class="btn btn-primary mt-3" type="submit">Submit</button>
                        </form>

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#state_name').on('change', function() {
                var stateId = $(this).val();
                // alert(stateId)
                if (stateId) {
                    $.ajax({
                        url: '{{ url("admin/branch/get-districts") }}/' + stateId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#district_name').empty();
                            $('#district_name').append('<option selected disabled value="">Select District</option>');
                            $.each(data, function(key, value) {
                                $('#district_name').append('<option value="' + value.district_id + '">' + value.district_name + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error: ', error);
                        }
                    });
                } else {
                    $('#district_name').empty();
                    $('#district_name').append('<option selected disabled value="">Select District</option>');
                }
            });
        });
    </script>
@endsection
