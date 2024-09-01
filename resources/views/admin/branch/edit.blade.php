@extends('admin.admin_layout.master')
@section('main_content')
<div class="content-wrapper" style="min-height: 1419.51px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ url('admin/branches') }}"
                        class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i
                            class=" fa-sm text-white-50"></i> Branch List</a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Branch</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                @include('common.notification')
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Branch</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('admin.update', ['id' => $branch->id]) }}" method="post" id="form" name="pForm"
                        enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-row">
                            <!-- Branch Name -->
                            <div class="col-md-4 mb-2">
                                <label for="branch_name" class="form-label">Branch Name</label>
                                <input class="form-control"
                                    name="branch_name"
                                    id="branch_name"
                                    placeholder="Branch Name"
                                    value="{{ $branch->branch_name ?? ''}}"
                                    required />
                                <div class="invalid-feedback">Enter Branch name</div>
                                @error('branch_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Branch Code -->
                            <div class="col-md-4 mb-2">
                                <label for="branch_code" class="form-label">Branch Code</label>
                                <input class="form-control"
                                    name="branch_code"
                                    id="branch_code"
                                    placeholder="Branch Code"
                                    value="{{ $branch->branch_code ?? ''}}"
                                    required />
                                <div class="invalid-feedback">Enter Branch code</div>
                                @error('branch_code')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Branch Owner Name -->
                            <div class="col-md-4 mb-2">
                                <label for="owner_name" class="form-label">Branch Owner Name</label>
                                <input class="form-control"
                                    name="owner_name"
                                    id="owner_name"
                                    placeholder="Owner Name"
                                    value="{{ $branch->owner_name ?? ''}}"
                                    required />
                                <div class="invalid-feedback">Enter Owner name</div>
                                @error('owner_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Contact Number -->
                            <div class="col-md-6 mb-2">
                                <label for="contact" class="form-label">Contact Number</label>
                                <input class="form-control"
                                    name="contact"
                                    id="contact"
                                    placeholder="Contact Number"
                                    value="{{ $branch->contact ?? ''}}"
                                    required />
                                <div class="invalid-feedback">Enter contact number</div>
                                @error('contact')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- GST No. -->
                            <div class="col-md-6 mb-2">
                                <label for="gst" class="form-label">GST No.</label>
                                <input
                                    class="form-control"
                                    name="gst"
                                    id="gst"
                                    placeholder="GST No."
                                    value="{{ $branch->gst ?? ''}}"
                                    required />
                                <div class="invalid-feedback">Enter GST No.</div>
                                @error('gst')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Country -->
                            <div class="col-md-4 mb-2">
                                <label for="country_name" class="form-label">Country</label>
                                <select class="form-select select2 form-control js-select2" name="country_name" id="country"
                                    required>
                                    <option selected disabled value="">Select Country</option>
                                    @foreach($countries as $country)
                                    <option
                                        {{ ($branch->country_name == $country->id) ? 'selected' : '' }}
                                        value="{{$country->id ?? '--'}}">{{$country->name ?? '--'}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Select Country</div>
                                @error('country_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- State -->
                            <div class="col-md-4 mb-2">
                                <label for="state_name" class="form-label">State</label>
                                <select class="form-select select2 form-control js-select2" name="state_name" id="states"
                                    required>
                                    <option selected disabled value="">Select Country First</option>
                                </select>
                                <div class="invalid-feedback">Select State</div>
                                @error('state_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="col-md-4 mb-2">
                                <label for="district_name" class="form-label">City</label>
                                <select class="form-select select2 form-control js-select2" name="district_name" id="district_name"
                                    required>
                                    <option selected disabled value="">Select State First</option>
                                    <!-- Add cities here -->
                                </select>
                                <div class="invalid-feedback">Select City</div>
                                @error('district_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Address 1 -->
                            <div class="col-md-6 mb-2">
                                <label for="address1" class="form-label">Address 1</label>
                                <textarea class="form-control"
                                    name="address1"
                                    id="address1"
                                    placeholder="Address 1" required>{{ $branch->address1 ?? ''}}</textarea>
                                <div class="invalid-feedback">Enter Address 1</div>
                                @error('address1')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Address 2 -->
                            <div class="col-md-6 mb-2">
                                <label for="address2" class="form-label">Address 2</label>
                                <textarea class="form-control"
                                    name="address2"
                                    id="address2"
                                    placeholder="Address 2">{{ $branch->address2 ?? ''}}</textarea>
                                <div class="invalid-feedback">Enter Address 2</div>
                                @error('address2')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Status -->
                            <div class="col-md-12">
                                <label for="user_status" class="form-label">Status</label>
                                <select class="form-select form-control" name="user_status" id="user_status"
                                    required>
                                    <option selected disabled value="">Select Status</option>
                                    <option value="active" {{ ($branch->user_status == 'active') ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ ($branch->user_status == 'inactive') ? 'selected' : '' }}>Inactive</option>
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
@endsection

@section('script')
@parent
<script src="{{ asset('admin_webu/plugins/select2/js/select2.full.min.js') }} "></script>

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    })


    $(document).ready(function() {

        $(document).on('change', '#country', function() {
            //on chnage country
            var countryId = $(this).val();
            if (countryId) {
                $.ajax({
                    url: '{{ url("admin/get-states") }}/' + countryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#states').empty();
                        $('#states').append('<option selected disabled value="">Select State</option>');
                        $.each(data, function(key, value) {
                            $('#states').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ', error);
                    }
                });
            }
        });


        $(document).on('change', '#states', function() {
            var stateId = $(this).val();
            // alert(stateId)
            if (stateId) {
                $.ajax({
                    url: '{{ url("admin/get-districts") }}/' + stateId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#district_name').empty();
                        $('#district_name').append('<option selected disabled value="">Select District</option>');
                        $.each(data, function(key, value) {
                            $('#district_name').append('<option value="' + value.id + '">' + value.name + '</option>');
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


        /*onload country and state and city selected start*/
        const selectedCountryId = "{{ $branch->country_name}}";
        const selectedStateId = "{{ $branch->state_name}}";
        const selectedCityId = "{{ $branch->city_name}}";

        //selected state
        $(function() {
            /*Selected State start*/
            if (selectedCountryId) {
                console.log('selectedCountryId', selectedCountryId)
                $.ajax({
                    url: '{{ url("admin/get-states") }}/' + selectedCountryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#states').empty();
                        $('#states').append('<option selected disabled value="">Select State</option>');
                        let selectedState;
                        $.each(data, function(key, value) {
                            selectedState = (value.id == selectedStateId) ? 'selected' : ''
                            $('#states').append('<option value="' + value.id + '" ' + selectedState + '>' + value.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ', error);
                    }
                });
            }
            /*Selected State End*/


            if (selectedStateId) {
                $.ajax({
                    url: '{{ url("admin/get-districts") }}/' + selectedStateId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#district_name').empty();
                        $('#district_name').append('<option selected disabled value="">Select District</option>');
                        let selectedCity;
                        $.each(data, function(key, value) {
                            selectedCity = (value.id == selectedCityId) ? 'selected' : ''
                            $('#district_name').append('<option value="' + value.id + '" ' + selectedCity + '>' + value.name + '</option>');
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


        /*onload country and state and city selected end*/

    });
</script>

@endsection

@section('styles')
@parent
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="{{ asset('admin_webu/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin_webu/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

<style>
    .select2.select2-container {
        width: 100% !important;
    }

    .select2.select2-container .select2-selection {
        border: 1px solid #ccc;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        height: 42px;
        margin-bottom: 15px;
        outline: none !important;
        transition: all .15s ease-in-out;
    }

    .select2.select2-container .select2-selection .select2-selection__rendered {
        color: #333;
        line-height: 32px;
        padding-right: 33px;
    }

    .select2.select2-container .select2-selection .select2-selection__arrow {
        background: #f8f8f8;
        border-left: 1px solid #ccc;
        -webkit-border-radius: 0 3px 3px 0;
        -moz-border-radius: 0 3px 3px 0;
        border-radius: 0 3px 3px 0;
        height: 40px;
        width: 42px;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
        background: #f8f8f8;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
        -webkit-border-radius: 0 3px 0 0;
        -moz-border-radius: 0 3px 0 0;
        border-radius: 0 3px 0 0;
    }

    .select2.select2-container.select2-container--open .select2-selection.select2-selection--multiple {
        border: 1px solid #34495e;
    }

    .select2.select2-container .select2-selection--multiple {
        height: auto;
        min-height: 34px;
    }

    .select2.select2-container .select2-selection--multiple .select2-search--inline .select2-search__field {
        margin-top: 0;
        height: 32px;
    }

    .select2.select2-container .select2-selection--multiple .select2-selection__rendered {
        display: block;
        padding: 0 4px;
        line-height: 29px;
    }

    .select2.select2-container .select2-selection--multiple .select2-selection__choice {
        background-color: #f8f8f8;
        border: 1px solid #ccc;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        margin: 4px 4px 0 0;
        padding: 0 6px 0 22px;
        height: 24px;
        line-height: 24px;
        font-size: 12px;
        position: relative;
    }

    .select2.select2-container .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
        position: absolute;
        top: 0;
        left: 0;
        height: 22px;
        width: 22px;
        margin: 0;
        text-align: center;
        color: #e74c3c;
        font-weight: bold;
        font-size: 16px;
    }

    .select2-container .select2-dropdown {
        background: transparent;
        border: none;
        margin-top: -5px;
    }

    .select2-container .select2-dropdown .select2-search {
        padding: 0;
    }

    .select2-container .select2-dropdown .select2-search input {
        outline: none !important;
        border: 1px solid #34495e !important;
        border-bottom: none !important;
        padding: 4px 6px !important;
    }

    .select2-container .select2-dropdown .select2-results {
        padding: 0;
    }

    .select2-container .select2-dropdown .select2-results ul {
        background: #fff;
        border: 1px solid #34495e;
    }

    .select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
        background-color: #3498db;
    }
</style>
@endsection