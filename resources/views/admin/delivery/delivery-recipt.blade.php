<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/15bc5dc973.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./style.css">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,
    body {
        width: 98%;
        margin: auto;
    }

    td {
        padding: 0px 7px;
    }

    table {
        width: 100%;
    }

    li {
        list-style: none;
    }

    ul {
        padding-left: 1rem;
    }

    .table-head {
        width: 100%;
    }

    .logo {
        width: 100px;
    }

    .header-color {
        background-color: #f3ebfb;
    }

    .table-main,
    .table-main th,
    .table-main td {
        border: 2px solid black;
        border-collapse: collapse;
    }

    .consignor {
        letter-spacing: ;
    }

    .font24 {
        font-size: 24px;
    }

    .td {
        border: 2px solid #000;
    }

    .width50 {
        width: 50%;
    }

    .width65 {
        width: 65%;
    }

    .flaotRight {
        float: right;
    }

    .address {
        font-size: 30px;
        /* padding-left: 10rem; */
        font-weight: color;
        font-weight: bold;
        color: #000;
        /* margin-top: 28px; */

    }
</style>
<style>
    /* Add your print-specific CSS here */
    @media print {
        body {
            font-family: Arial, sans-serif;
        }

        .no-print {
            display: none;
        }
    }

    /* @page {
        size: A4;
        margin: 0;
    }

    body {
        width: 210mm;
        height: 297mm;
        margin: 20mm;
    } */
</style>

<body>
   
    <div class="container header-color">
        <p class="no-print">
            <a href="{{ url('admin/delivery') }}" class="btn btn-primary mt-3">Go Back</a>
            <button onclick="window.print()" class="btn btn-danger mt-3">Print</button>
        </p>
        <table class="table-head" style="width: 100%;">
            <tbody>
                <tr class="header-color">
                    <td width="10%">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="" class="logo">
                    </td>
                    <td style="width: 80%; text-align: center;">
                        <table style="width: 100%;">
                            <tbody>
                                <tr>
                                    <h2>Vikash Logistic Pvt. Ltd.</h2>
                                </tr>
                                <tr>
                                    <td>
                                        CIN: G3011RJ2013PTC042841<br>
                                        (Sole licensee: U.P.S.R.T.C., Uttar Pradesh & R.S.R.T.C Deluxe Depot Rajasthan)
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>

                    </td>
                    <td width="10%">Recipt Number
                        {{ $deliveryReceipt->delivery_number }}
                    </td>
                    {{-- <td width="10%">

                    </td> --}}
                </tr>
                <tr class="header-color">
                    <td width="10%">

                    </td>
                    <td style="width: 80%; text-align: center;">
                        <table style="width: 100%;">
                            <tbody>
                                <tr>
                                    <h5>Delivery Recepit</h5>
                                    <hr>
                                </tr>

                            </tbody>
                        </table>


                    </td>

                    <td width="10%">

                    </td>
                </tr>
                <hr>
                <tr class="header-color">
                    <th width="10%">

                    </th>

                    <td style="text-align: center;">
                        <table style="">
                            <tbody>
                                <tr>
                                    <th width="">
                                        Branch
                                    </th>
                                    <th>
                                        <h6>Date</h6>
                                    </th>
                                    <th>
                                        <h6>Recived With Thanks From</h6>
                                    </th>
                                    <th>
                                        <h6>Reciver Mobile</h6>
                                    </th>
                                    <th>
                                        <h6>Recipt Number</h6>
                                    </th>
                                    <th>
                                        <h6>Booking Type</h6>
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <h6>{{ $deliveryReceipt->consignee_branch_name }}</h6>
                                    </td>
                                    <td>
                                        <h6>{{ $deliveryReceipt->created_at }}</h6>
                                    </td>
                                    <td>
                                        <h6>{{ $deliveryReceipt->recived_by }}</h6>
                                    </td>
                                    <td>
                                        <h6>{{ $deliveryReceipt->reciver_mobile }}</h6>
                                    </td>
                                    <td>
                                        <h6>{{ $deliveryReceipt->delivery_number }}</h6>
                                    </td>
                                    <td>
                                        <h6>
                                            @if ($deliveryReceipt->booking_type == 1)
                                                Paid
                                            @elseif ($deliveryReceipt->booking_type == 2)
                                                To Pay
                                            @elseif ($deliveryReceipt->booking_type == 3)
                                                Client
                                            @else
                                                Unknown
                                            @endif
                                        </h6>

                                    </td>
                                </tr>

                            </tbody>
                        </table>


                    </td>
                    <td width="10%">

                    </td>
                </tr>
                <tr class="header-color">
                    <td colspan="3">
                        <table class="mt-3" style="width: 100%;" border="2">
                            <tbody>
                                <tr class="header-color">
                                    <td class="p-3" style="width: 100%;">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Delivery Station - {{ $deliveryReceipt->consignee_branch_name }}
                                                    </th>
                                                    <th>Particular</th>
                                                    <th>Rs-/</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Row 1 -->
                                                <tr>
                                                    <td><label for="delivery_station_1">Booking Station -
                                                            {{ $deliveryReceipt->consignor_branch_name }}
                                                        </label></td>
                                                    <td><label for="particular_1">Freight Charges</label></td>
                                                    <td>{{ $deliveryReceipt->freight_charges }}</td>
                                                </tr>

                                                <!-- Row 2 -->
                                                <tr>
                                                    <td><label for="delivery_station_2">Offline Bilti -
                                                            {{ $deliveryReceipt->bilti_number }}
                                                        </label></td>
                                                    <td><label for="particular_2">Hamali Charges</label></td>
                                                    <td>{{ $deliveryReceipt->hamali_charges }}</td>
                                                </tr>

                                                <!-- Row 3 -->
                                                <tr>
                                                    <td><label for="delivery_station_3">Date Of Booking - {{ \Carbon\Carbon::parse($deliveryReceipt->bookingDate)->format('d-m-Y') }}</label></td>


                                                    <td><label for="particular_3">Demruge Charges</label></td>
                                                    <td>{{ $deliveryReceipt->demruge_charges }}</td>
                                                </tr>

                                                <!-- Row 4 -->
                                                <tr>
                                                    <td><label for="delivery_station_4">Number Of Article -
                                                            {{ $deliveryReceipt->no_of_artical }}
                                                        </label></td>
                                                    <td><label for="particular_4">Other Charges</label></td>
                                                    <td>{{ $deliveryReceipt->others_charges }}</td>
                                                </tr>

                                                <!-- Row 5 (Grand Total) -->
                                                <tr>
                                                    <td><label for="delivery_station_5">Privet Mark</label></td>
                                                    <td><label for="particular_5">Grand Total</label></td>
                                                    <td>{{ $deliveryReceipt->grand_total }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>


                                </tr>

                            </tbody>
                        </table>

                    </td>
                </tr>
                <tr class="header-color">
                    <th width="10%">

                    </th>

                    <td style="width: 40%; text-align: center;">
                        <table style="width: 100%;">
                            <tbody>
                                <tr>
                                    <th width="10%">
                                        Recived By
                                    </th>
                                    <th>
                                        <h6></h6>
                                    </th>
                                    <th>
                                        <h6>Pre Paid by</h6>
                                    </th>
                                    <th>
                                        <h6></h6>
                                    </th>
                                    <th>
                                        <h6>Checkd by</h6>
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        <h6>{{ $deliveryReceipt->recived_by }}</h6>
                                    </td>
                                    <td>
                                        <h6></h6>
                                    </td>
                                    <td>
                                        <h6></h6>
                                    </td>
                                    <td>
                                        <h6></h6>
                                    </td>
                                    <td>
                                        <h6>

                                        </h6>

                                    </td>
                                </tr>

                            </tbody>
                        </table>


                    </td>
                    <td width="10%">

                    </td>
                </tr>
            </tbody>
        </table>
    </div>



</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
