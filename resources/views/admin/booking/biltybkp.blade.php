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
        font-size: 20px;
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
    <p class="no-print">
        <a href="{{ url('admin/bookings') }}" class="btn btn-primary">Go Back</a>
        <button onclick="window.print()" class="btn btn-danger">Print</button>
    </p>
    <div class="container header-color">
        <table class="table-head">
            <tbody>
                <tr class="header-color">
                    <td width="10%">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="" class="logo">
                    </td>
                    <td width="75%">
                        <table>
                            <tbody>
                                <tr class="text-center">

                                    <h2>Vikash Logistic Pvt. ltd.</h2>

                                </tr>
                                <tr>
                                    {{-- <td>
                                        CIN:G3011RJ2013PTC042841<br>
                                        (Sole lincencee:U.P.S.R.T.C., Uttar Pradesh & R.S.R.T.C Deluxe Depol Rajasthan )
                                    </td> --}}

                                </tr>

                            </tbody>
                        </table>
                        <hr>
                    </td>

                    <td width="15%"></td>
                </tr>
                <tr class="header-color">
                    <td colspan="2">
                        <div>
                            <p class="address">
                                {{ $consignorCity }} To: {{ $consigneeCity }} ({{ $booking->created_at }})</p>
                        </div>
                    </td>
                    <td colspan="1">
                        <div>
                            <p class="" style="font-size: 20px;">
                                 <b>LR No.- {{ $booking->bilti_number }}</b> </p>
                    </td>
                </tr>
                <tr class="header-color">
                    <table class="table-main table-head mt-3">
                        <tbody>
                            <tr class="header-color">
                                <td><strong> From: {{ $consignorCity }}</strong> </td>
                                <td><strong> To: {{ $consigneeCity }}</strong></td>
                                <td><strong> KM:</strong> </td>
                                <td><strong> Offline Bilty No.:</strong> {{ $booking->manual_bilty_number ?: '-' }}</td>
                                <td><strong> Date:</strong> {{ $booking->created_at }}</td>
                                <td colspan="2"><strong> Office Copy</strong></td>
                            </tr>
                            <tr class="header-color">
                                <td><i class="fa-solid fa-mobile-retro"></i><Strong>+91-88403 54461</Strong></td>
                                <td><i class="fa-solid fa-mobile-retro"></i><strong>+91-88403 54461</strong></td>
                                <td> <strong> No. of Parcels: </strong> {{ $booking->no_of_artical }} Pics</td>
                                <td> <strong> Weight: </strong>{{ $booking->actual_weight }} Kg.</td>
                                <td> <strong> Transshipment-1 </strong></td>
                                <td> <strong> Transshipment-2 </strong></td>
                                <td> <strong> Transshipment-3 </strong></td>

                            </tr>
                        </tbody>
                    </table>
                </tr>
                <tr class="header-color">
                    <td>
                        <table class=" mt-3" border="2">
                            <tbody>
                                <tr class="header-color">
                                    <td class="p-3 width50">
                                        <table border="2">
                                            <tbody>
                                                <tr class="header-color">
                                                    <td class="p-3 width50">
                                                        <table border="2">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="p-2">
                                                                        <table border="2">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="text-center"> CONSIGNOR
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <ul>
                                                                            <li>
                                                                                Name: <span
                                                                                    class="font24 fw-bold">{{ $booking->consignor_name }}</span>
                                                                            </li>
                                                                            <li>
                                                                                Address: Kanpur(U.P)
                                                                            </li>
                                                                            <li>
                                                                                GST Num. /Ph.Num
                                                                            </li>
                                                                            <li>
                                                                                {{ $booking->gst_number }} /
                                                                                {{ $booking->phone_number_1 }}
                                                                            </li>
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td class="p-3 width50">
                                                        <table border="2">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="p-2">
                                                                        <table border="2">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="text-center"> CONSIGNEE
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <ul>
                                                                            <li>
                                                                                Name: <span
                                                                                    class="font24 fw-bold">{{ $booking->consignee_name }}</span>
                                                                            </li>
                                                                            <li>
                                                                                Address:
                                                                                {{ $booking->consignee_address }}
                                                                            </li>
                                                                            <li>
                                                                                GST Num. /Ph.Num
                                                                            </li>
                                                                            <li>
                                                                                {{ $booking->consignee_gst_number }} /
                                                                                {{ $booking->consignee_phone_number_1 }}

                                                                            </li>
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td class="p-3" colspan="2">
                                                        <table border="2" class="table-main">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="width65 "> Goods Contained (Declare by
                                                                        consignor):</td>
                                                                    <td> {{ $booking->packing_type }}</td>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <td class="width65 ">Value Declared by Consignor:
                                                                    </td>
                                                                    <td> {{ $booking->good_of_value }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="width65 ">GSTIN:</td>
                                                                    <td> {{ $booking->gst_number }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="width65 ">Privet Mark</td>
                                                                    <td> {{ $booking->privet_mark }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="width65 "> Remark</td>
                                                                    <td> {{ $booking->remark }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="width65 fw-bold" colspan="2">Delivery
                                                                        shall
                                                                        be made only at parcel office.</td>
                                                                </tr>

                                                                <tr>
                                                                    <td class="width65 fw-bold" colspan="2">Consignor
                                                                        has
                                                                        to
                                                                        pay loading charge at booking station.</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="width65 fw-bold" colspan="2">Consignee
                                                                        has
                                                                        to
                                                                        pay Delivery charge at delivery station.</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold p-3" colspan="2">
                                                        Note: Terms & Conditions Applied.
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="p-3 width50">
                                        <table border="2" class="table-main">
                                            <tbody>
                                                <tr>
                                                    <th> Description</th>
                                                    <th> <span class="flaotRight">Amount(Rs.)</span> </th>
                                                </tr>
                                                <tr>
                                                    <td>Freight Amount</td>
                                                    <td><span class="flaotRight">{{ $booking->freight_amount }}</span>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>Fov Amount</td>
                                                    <td><span class="flaotRight">{{ $booking->fov_amount }}</span></td>
                                                </tr>
                                               
                                              
                                              
                                               
                                                <tr>
                                                    <td>Hamali Charges</td>
                                                    <td><span
                                                            class="flaotRight">{{ $booking->loading_charge_amount }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Bilty Charges</td>
                                                    <td><span
                                                            class="flaotRight">{{ $booking->bilti_charges }}</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Misc. Charges</td>
                                                    <td><span
                                                            class="flaotRight">{{ $booking->misc_charge_amount }}</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>Extra Charges</td>
                                                    <th class="font24"> <span
                                                            class="flaotRight">{{ $booking->other_charge_amount }}</span>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>Grand Total</th>
                                                    <th class="font24"> <span
                                                            class="flaotRight">{{ $booking->grand_total_amount }}</span>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>Grand Total In words</th>
                                                    <th class="font15">
                                                        <span
                                                            class="float-right">{{ numberToWords($booking->grand_total_amount) }}
                                                            Only</span>
                                                    </th>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
