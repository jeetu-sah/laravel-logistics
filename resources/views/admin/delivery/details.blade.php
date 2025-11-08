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
                        <li class="breadcrumb-item active">Pay Remaining Amount</li>
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
            <form action='{{ url("admin/delivery/gatepass-amount/add-payments/$deliveryReceipt->id") }}' method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{ $deliveryReceipt->booking->id }}" name="booking_id">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Delivery receipt</h3>
                            </div>
                            <div class="card-body">
                                <div class="container my-4">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped align-middle"
                                            style="font-size: 18px;">

                                            <tbody>
                                                <tr>
                                                    <td><strong>Consignor Name</strong></td>
                                                    <td>{{ $deliveryReceipt->booking->consignor_name }}</td>
                                                    <td><strong>Consignee Name</strong></td>
                                                    <td>{{ $deliveryReceipt->booking->consignee_name }}</td>
                                                </tr>
                                                <tr>

                                                    <td><strong>Booking Station</strong></td>
                                                    <td>{{ $deliveryReceipt->booking->consignorBranch->branch_name }}</td>
                                                    <td><strong>Delivery Station</strong></td>
                                                    <td>{{ $deliveryReceipt->booking->consigneeBranch->branch_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Offline Bilti Number</strong></td>
                                                    <td>{{ $deliveryReceipt->booking->manual_bilty_number ?: 'NA' }}</td>
                                                    <td><strong>Offline Booking Date</strong></td>
                                                    <td>{{ formatOnlyDate($deliveryReceipt->booking->created_at) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Online Booking Date</strong></td>
                                                    <td>{{ formatDate($deliveryReceipt->booking->created_at) }}
                                                    <td><strong>Article</strong></td>
                                                    <td>{{ $deliveryReceipt->booking->no_of_artical }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Contain</strong></td>
                                                    <td>{{ $deliveryReceipt->booking->cantain }}</td>
                                                    <td><strong>Carrier By</strong></td>
                                                    <td>{{ $deliveryReceipt->recived_by }} </td>
                                                </tr>

                                                <tr>
                                                    <td><strong>Carrier Mobile</strong></td>
                                                    <td>{{ $deliveryReceipt->reciver_mobile }}</td>
                                                    <td><strong>Remark</strong></td>
                                                    <td>{{ $deliveryReceipt->remark ?? '--' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Booking Type</strong></td>
                                                    <td>{{ $deliveryReceipt?->booking?->booking_type ?? '--' }}</td>
                                                    <td class="text-success"><strong>Total Received Amount</strong></td>
                                                    <td>{{ $deliveryReceipt->bookingReceivedAmount() ?? '--' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Freight Charges:</strong></td>
                                                    <td>&#8377;{{ $deliveryReceipt->freight_charges }}</td>
                                                    <td><strong>Hamali Charges</strong></td>
                                                    <td>&#8377;{{ $deliveryReceipt->hamali_charges ?? '--' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Demurrage Charges:</strong></td>
                                                    <td>&#8377;{{ $deliveryReceipt->demruge_charges }}</td>
                                                    <td><strong>Other Charges</strong></td>
                                                    <td>&#8377;{{ $deliveryReceipt->others_charges ?? '--' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Discount</strong></td>
                                                    <td>&#8377;{{ $deliveryReceipt->discount }}</td>
                                                    <td><strong>Grand Total</strong></td>
                                                    <td>&#8377;{{ $deliveryReceipt->grand_total ?? '--' }}</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Pay remaining amount</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6" style="font-size: 25px; color: green;">
                                        <label for="received_amount">Recived Amount:</label>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="number" class="form-control" step="0.01"
                                            id="received_amount"
                                            value="{{ old('received_amount') }}"
                                            name="received_amount" step="0.01" placeholder="₹.00" required>
                                    </div>
                                    <div class="col-md-6" style="font-size: 25px; color: red;">
                                        <label for="pendingAmount">Pending Amount:</label>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="text" class="form-control" id="pendingAmount"
                                            value="{{ $pendingAmount }}" required name="pending_amount" readonly />
                                    </div>
                                    <div class="col-md-6" style="font-size: 25px; color: blue;">
                                        <label for="grand_total">Note:</label>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <textarea class="form-control" id="notes"
                                            value="{{ old('notes') }}" name="notes" placeholder="Note"></textarea>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <input type="submit" value="Save & Print" class="btn btn-success float-right">
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Payment list</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Received Amount</th>
                                            <th>Pending Amount</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($deliveryReceipt?->payments as $deliveryReceiptPayment)
                                        <tr>
                                            <td>1.</td>
                                            <td>&#8377;{{$deliveryReceiptPayment->received_amount ?? 0}}</td>
                                            <td>&#8377;{{$deliveryReceiptPayment->pending_amount ?? 0}}</td>
                                            <td>{{$deliveryReceiptPayment->notes ?? '--'}}</td>
                                        </tr>

                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No payments found.</td>
                                        </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection


@section('script')
@parent
<!-- <script src="{{ asset('datatables/jquery.min.js') }}"></script> -->
<script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>

<script>
    $(document).ready(function(e) {
        var pendingAmount = "{{$pendingAmount}}";
        console.log('pendingAmount', pendingAmount)
        $(document).on('input', '#received_amount', function() {
            var receivedAmount = parseFloat($(this).val()) || 0;
            var pendingAmountNumber = "{{$pendingAmount}}";
            let pendingAmount = parseFloat(pendingAmountNumber.replace(/,/g, ''));;

            if (receivedAmount > pendingAmount) {
                alert('Received amount cannot be greater than pending amount.');
                $(this).val(pendingAmount);
                receivedAmount = pendingAmount;
            }

            var newPendingAmount = (pendingAmount - receivedAmount).toFixed(2);
            $('#pendingAmount').val(newPendingAmount);
        });


    });
</script>
@endsection