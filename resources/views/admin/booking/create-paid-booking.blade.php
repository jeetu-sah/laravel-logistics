@extends('admin.admin_layout.master')
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

        <section class="content">
            <div class="container-fluid">
                <form action="{{ url('admin/bookings/paid-booking') }}" method="POST">
                    @csrf
                    <div class="row">
                        @include('admin.booking.shared.consigner_details')
                        <div class="col-md-3">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Invoice</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="date">Distance (KM):</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                <input type="text" value="" name="distance"
                                                    class="form-control mb-1" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="date">Freight</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                <input type="text" value="" name="freight"
                                                    class="form-control mb-1" />
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="date">FOV</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                <input type="text" value="" name="fov_amount"
                                                    class="form-control mb-1" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="date">Transhipment 1</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                <input type="text" value="" name="transhipmen_one_amount" id="transhipmen_one_amount"
                                                    class="form-control mb-1" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="date">Transhipment 2</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                <input type="text" value="" name="transhipmen_two_amount"
                                                    class="form-control mb-1" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="date">Transhipment 3</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                <input type="text" value="" name="transhipment_three_amount"
                                                    class="form-control mb-1" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="date">Pickup Charges</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                <input type="text" value="" name="pickup_charges"
                                                    class="form-control mb-1" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="date">Hamali Charges</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                <input type="text" name="hamali_Charges" value=""
                                                    class="form-control mb-1" />
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="date">Discount</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                <input type="text" name="discount" value=""
                                                    class="form-control mb-1" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="date">Company charges<label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                <input type="text" value="" name="compney_charges"
                                                    class="form-control mb-1" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="date">Sub Total<label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">

                                            <input type="text" value="" name="sub_total"
                                                class="form-control mb-1" />

                                        </div>
                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="date">CGST<label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                <input type="text" name="cgst" value=""
                                                    class="form-control mb-1" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="date">SGST<label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                <input type="text" name="sgst" value=""
                                                    class="form-control mb-1" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="date">IGST<label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                <input type="text" name="igst" value=""
                                                    class="form-control mb-1" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="date">Grand Total<label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                <input type="text" value="" name="grand_total"
                                                    class="form-control mb-1" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="date">Misc. Charges<label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                <input type="text" value="" name="misc_charge_amount"
                                                    class="form-control mb-1" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="">
                                                <label for="date">Final Amount<label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                <input type="text" name="grand_total_amount" value=""
                                                    class="form-control mb-1" />
                                            </div>
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


@section('script')
    @parent
    <script src="{{ asset('admin_webu/plugins/select2/js/select2.full.min.js') }} "></script>
   
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()
        })

        $(document).ready(function() {
            $(document).on('click', '.dropdown-mobile-code', function(e) {
                e.preventDefault()
                const mobileNumberCode = $(this).text();
                $(this).parent().parent().find('button').text(mobileNumberCode);
                $(this).parent().parent().find('.mobileNumberCode').val(mobileNumberCode);
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
