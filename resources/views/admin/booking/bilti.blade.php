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
        background-color: rgb(255 0 0 / 33%);
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
        font-size: 40px;
        padding-left: 10rem;
        font-weight: color;
        font-weight: bold;
        color: #000;
        margin-top: 28px;

    }
</style>

<body>
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
                                <td>
                                    CIN:G3011RJ2013PTC042841
                                </td>
                                <td>
                                    (Sole lincencee:U.P.S.R.T.C., Uttar Pradesh & R.S.R.T.C Deluxe Depol Rajasthan )
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>

                <td width="15%"></td>
            </tr>
            <tr>
                <td colspan="3">
                    <div>
                        <p class="address">
                            कानपुर To: सोनौली ({{ $booking->created_at }})</p>
                    </div>
                </td>
            </tr>
            <tr>
                <table class="table-main table-head mt-3">
                    <tbody>
                        <tr>
                            <td><strong> From:Kanpur (U.P.)</strong> </td>
                            <td><strong> To: Sonauli(U.P.)</strong></td>
                            <td><strong> KM:</strong> 513</td>
                            <td><strong> Offline Number:</strong> N.A.</td>
                            <td><strong> Date:</strong> {{ $booking->created_at }}</td>
                            <td colspan="2"><strong> Office Copy</strong></td>
                        </tr>
                        <tr>
                            <td><i class="fa-solid fa-mobile-retro"></i><Strong>+91-1234567890</Strong></td>
                            <td><i class="fa-solid fa-mobile-retro"></i><strong>+91-1234567890</strong></td>
                            <td> <strong> No. of Parcels: </strong> {{ $booking->no_of_artical }}</td>
                            <td> <strong> Weight: </strong>{{ $booking->actual_weight }}</td>
                            <td> <strong> Transshipment-1 </strong></td>
                            <td> <strong> Transshipment-2 </strong></td>
                            <td> <strong> Transshipment-3 </strong></td>

                        </tr>
                    </tbody>
                </table>
            </tr>
            <tr>
                <td>
                    <table class=" mt-3" border="2">
                        <tbody>
                            <tr>
                                <td class="p-3 width50">
                                    <table border="2">
                                        <tbody>
                                            <tr>
                                                <td class="p-3 width50">
                                                    <table border="2">
                                                        <tbody>
                                                            <tr>
                                                                <td class="p-2">
                                                                    <table border="2">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="text-center"> CONSIGNOR</td>
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
                                                                                <td class="text-center"> CONSIGNEE</td>
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
                                                                            Address: {{ $booking->consignee_address }}
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
                                                                <td class="width65 " colspan="2">Remarks:</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="width65 ">Value Declared by Consignor:</td>
                                                                <td> {{ $booking->good_of_value }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="width65 ">GSTIN:</td>
                                                                <td> {{ $booking->gst_number }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="width65 fw-bold" colspan="2">Delivery
                                                                    shall
                                                                    be made only at parcel office.</td>
                                                            </tr>

                                                            <tr>
                                                                <td class="width65 fw-bold" colspan="2">Consignor has
                                                                    to
                                                                    pay loading charge at booking station.</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="width65 fw-bold" colspan="2">Consignee has
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
                                                <td>Goods of value</td>
                                                <td><span class="flaotRight">{{ $booking->good_of_value }}</span></td>
                                            </tr>
                                            <tr>
                                                <td>fov amount</td>
                                                <td><span class="flaotRight">{{ $booking->fov_amount }}</span></td>
                                            </tr>
                                            <tr>
                                                <td>freight amount</td>
                                                <td><span class="flaotRight">{{ $booking->freight_amount }}</span></td>
                                            </tr>
                                            <tr>
                                                <td>OS Amount</td>
                                                <td><span class="flaotRight">{{ $booking->os_amount }}</span></td>
                                            </tr>
                                            <tr>
                                                <td>Transshipment-1</td>
                                                <td><span
                                                        class="flaotRight">{{ $booking->transhipmen_one_amount }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Transshipment-2</td>
                                                <td><span
                                                        class="flaotRight">{{ $booking->transhipmen_two_amount }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Transshipment-3</td>
                                                <td><span
                                                        class="flaotRight">{{ $booking->transhipmen_three_amount }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Loading Charges</td>
                                                <td><span
                                                        class="flaotRight">{{ $booking->loading_charge_amount }}</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Misc. Charges</td>
                                                <td><span class="flaotRight">{{ $booking->misc_charge_amount }}</span>
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
                                                <th class="font24">
                                                    <span
                                                        class="floatRight">{{ numberToWords($booking->grand_total_amount) }} Only</span>
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
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
