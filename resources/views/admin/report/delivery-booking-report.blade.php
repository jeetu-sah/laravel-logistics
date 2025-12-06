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
                        <li class="breadcrumb-item">Reports</li>
                        <li class="breadcrumb-item active">Delivery Reports</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h2 class="card-title mb-0">Delivery Reports</h2>

                </div>
            </div>
            <div class="card-body">
                <form id="filter-form" class="mb-4">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="date_from" class="form-label">From Date</label>
                            <input type="date" name="date_from" id="date_from" class="form-control">
                        </div>

                        <div class="col-md-2">
                            <label for="date_to" class="form-label">To Date</label>
                            <input type="date" name="date_to" id="date_to" class="form-control">
                        </div>

                        <div class="col-md-2">
                            <label for="booking_type" class="form-label">Booking Type</label>
                            <select name="booking_type" id="booking_type" class="form-control">
                                <option value="">-- All --</option>
                                <option value="Paid">Paid</option>
                                <option value="Topay">To Pay</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="consignee_branch_id" class="form-label">Origin branch</label>
                            <select id="consignee_branch_id" name="consignee_branch_id" class="form-select select2 form-control js-select2">
                                <option value="">-- All branch --</option>
                                @foreach($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="client_id" class="form-label">Client</label>
                            <select id="client_id" name="client_id" class="form-select select2 form-control js-select2">
                                <option value="">-- All Clients --</option>
                                @foreach($combineClients as $client)
                                <option value="{{ $client->id }}">{{ $client->client_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-top:20px">
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Filter</button> &nbsp;
                            <button type="button" id="reset-filters" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                </form>

                {{-- Data Table --}}
                <div class="row">
                    <div class="table-responsive">
                        <table class="display" id="delivery-list">
                            <thead>
                                <tr>
                                    <th>{{ __('SN.') }}</th>
                                    <th>{{ __('Online / Offline Bilti No.') }}</th>
                                    <th>{{ __('Booking Date') }}</th>
                                    <th>{{ __('Articles') }}</th>
                                    <th>{{ __('Origin') }}</th>
                                    <th>{{ __('Consignor') }}</th>
                                    <th>{{ __('Destination') }}</th>
                                    <th>{{ __('Consignee') }}</th>
                                    <th>{{ __('Amount') }}</th>
                                    <th>{{ __('Type') }}</th>
                                    <th>{{ __('Created At') }}</th>
                                    <th>{{ __('Challan No.') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="8" style="text-align:right">Total:</th>
                                    <th></th>
                                    <th colspan="3"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
    $(document).ready(function(e) {
        function parseValue(val) {
            if (typeof val === 'number') return val;
            if (typeof val === 'string') return parseFloat(val.replace(/[^0-9.\-]/g, '')) || 0;
            return 0;
        }

        var table = new DataTable('#delivery-list', {
            responsive: true,
            scrollY: "400px",
            scrollX: true,
            scrollCollapse: true,
            searching: false,
            ajax: {
                url: "{{ url('admin/reports/delivery-reports/list') }}",
                data: function(d) {
                    d.client_id = $('#client_id').val();
                    d.date_from = $('#date_from').val();
                    d.date_to = $('#date_to').val();
                    d.booking_type = $('#booking_type').val();
                    d.consignee_branch_id = $('#consignee_branch_id').val();
                }
            },
            columns: [{
                    data: 'sn'
                },
                {
                    data: 'bilti_number'
                },
                {
                    data: 'booking_date'
                },
                {
                    data: 'no_of_artical'
                },
                {
                    data: 'origin',
                    orderable: false
                },
                {
                    data: 'consignor_name'
                },
                {
                    data: 'destination',
                    orderable: false
                },
                {
                    data: 'consignee_name'
                },
                {
                    data: 'amount',
                    orderable: false
                },
                {
                    data: 'booking_type'
                },
                {
                    data: 'created_at',
                    orderable: true
                },
                {
                    data: 'challan_number',
                    orderable: false
                }
            ],
            processing: true,
            serverSide: true,

            footerCallback: function(row, data, start, end, display) {
                var api = this.api();
                var json = api.ajax.json();

                console.log('json', json.total_amount)

                if (json && json.total_amount) {
                    // Put total_amount in Amount column (index 8)
                    $(api.column(8).footer()).html(json.total_amount);
                }
            }
        });


        $('#filter-form').on('submit', function(e) {
            e.preventDefault();
            table.ajax.reload();
        });

        $('#reset-filters').on('click', function() {
            $('#filter-form')[0].reset();
            table.ajax.reload();
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