@extends('admin.admin_layout.master')
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.3.0/ckeditor5.css" />
@section('main_content')
    <div class="content-wrapper" style="min-height: 1419.51px;">
        <!-- Content Header (Page header) -->

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ $tittle }}</h3>
                </div>
                <div class="card-body">

                    <form action="{{ url('admin/careers/update', $career->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Required for updating the record --}}

                        <div class="row">
                            <div class="col-sm-6">
                                <label>Job Title</label>
                                <input name="name" type="text" class="form-control" value="{{ $career->name }}"
                                    required />
                            </div>
                            <div class="col-sm-6">
                                <label>Positions</label>
                                <input name="post" type="text" class="form-control" value="{{ $career->post }}"
                                    required />
                            </div>
                            <div class="col-sm-6">
                                <label for="states">State</label>
                                <select class="form-control select2" name="state_id" id="states" required>
                                    <option>Select State</option>
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->id }}"
                                            {{ $location->id == $career->state_id ? 'selected' : '' }}>
                                            {{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label for="district_name">Location</label>
                                <select class="form-control select2" name="location" id="district_name" required>
                                    <option>Select Location</option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <label>Salary</label>
                                <input name="salary" type="text" value="{{ $career->salary }}" class="form-control" />
                            </div>
                            <div class="col-sm-12">

                                <label>Description</label>
                                <textarea name="description" type="text" class="form-control">{{ $career->description }}</textarea>
                            </div>

                            <div class="col-sm-12">
                                <label for="staff">Staff Type</label>
                                <select name="staff_type" class="form-control select2" id="staff" data-placeholder="Staff Type">
                                    <option value="">Select Staff</option>
                                    <option value="male" {{ $career->staff_type == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $career->staff_type == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="both" {{ $career->staff_type == 'both' ? 'selected' : '' }}>Both</option>
                                </select>
                            </div>
                            
                            <div class="col-sm-12">
                                <label for="status">Status</label>
                                <select class="form-control select2" name="status" id="status">
                                    <option value="">Select Status</option>
                                    <option value="open" {{ $career->status == 'open' ? 'selected' : '' }}>Open</option>
                                    <option value="closed" {{ $career->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                </select>
                            </div>
                            
                            <div class="col-sm-12 mt-3">
                                <button type="submit" class="btn btn-success">Update Career</button>
                                <a href="{{ url('admin/careers') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>
    </div>
@endsection


@section('script')
    @parent
    <script src="{{ asset(path: 'admin_webu/plugins/select2/js/select2.full.min.js') }} "></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
    <script>
        $(document).ready(function() {
            function fetchDistricts(stateId, selectedDistrict = null) {
                if (stateId) {
                    $.ajax({
                        url: '{{ url('get-districts-user') }}/' + stateId,
                        type: 'GET',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            $('#district_name').empty().append(
                                '<option selected disabled>Select Location</option>');
                            $.each(data, function(key, value) {
                                let selected = (selectedDistrict && selectedDistrict == value
                                    .id) ? 'selected' : '';
                                $('#district_name').append('<option value="' + value.id + '" ' +
                                    selected + '>' + value.name + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error: ', error);
                        }
                    });
                } else {
                    $('#district_name').empty().append('<option selected disabled>Select Location</option>');
                }
            }

            // Get selected state and district from the career model
            var selectedState = $('#states').val();
            var selectedDistrict = "{{ $career->location }}"; // Assuming 'location' stores the district ID

            // Load districts on page load if state is selected
            if (selectedState) {
                fetchDistricts(selectedState, selectedDistrict);
            }

            // Fetch districts dynamically when state changes
            $('#states').on('change', function() {
                fetchDistricts($(this).val());
            });
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
