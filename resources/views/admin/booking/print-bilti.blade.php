<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Laralink">
    <title>Bilty</title>
    <style>
        /* Base styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.2;
            color: #333;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }

        /* Invoice container optimized for A4 */
        .invoice-container {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 5mm;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        /* Two-column layout */
        .two-columns {
            display: flex;
            gap: 5mm;
        }

        .column {
            flex: 1;
        }

        /* Header styles */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 4mm;
            border-bottom: 1px solid #2c3e50;
            padding-bottom: 2mm;
        }

        .company-info {
            flex: 1;
        }

        .company-logo {
            text-align: center;
            flex: 1;
        }

        .invoice-details {
            flex: 1;
            text-align: right;
        }

        .company-name {
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 1mm;
        }

        .company-address {
            font-size: 9px;
            line-height: 1.2;
        }

        .invoice-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 1mm;
        }

        .invoice-number {
            font-size: 11px;
            font-weight: bold;
        }

        /* Route info */
        .route-info {
            background-color: #f8f9fa;
            padding: 2mm;
            border-radius: 2px;
            margin-bottom: 3mm;
            text-align: center;
            font-weight: bold;
            font-size: 10px;
        }

        /* Table styles */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 3mm;
            font-size: 9px;
        }

        .info-table th,
        .info-table td {
            border: 1px solid #ddd;
            padding: 1mm;
            text-align: left;
        }

        .info-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        /* Consignor/Consignee sections */
        .party-section {
            margin-bottom: 3mm;
        }

        .party-header {
            background-color: #2c3e50;
            color: white;
            padding: 1mm;
            text-align: center;
            font-weight: bold;
            font-size: 10px;
        }

        .party-details {
            border: 1px solid #ddd;
            border-top: none;
            padding: 1mm;
            font-size: 9px;
        }

        .party-row {
            margin-bottom: 0.5mm;
        }

        /* Footer styles */
        .invoice-footer {
            margin-top: 3mm;
            border-top: 1px solid #ddd;
            padding-top: 2mm;
        }

        .payment-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2mm;
        }

        .bank-details {
            flex: 1;
            font-size: 9px;
        }

        .qr-code {
            flex: 0 0 auto;
            text-align: center;
        }

        .amount-section {
            border: 1px solid #ddd;
            padding: 1mm;
            margin-bottom: 2mm;
        }

        .total-amount {
            font-size: 12px;
            font-weight: bold;
            text-align: right;
        }

        .amount-in-words {
            font-style: italic;
            margin-top: 0.5mm;
            font-size: 9px;
        }

        .terms {
            font-size: 8px;
            margin-top: 2mm;
            line-height: 1.2;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 5mm;
        }

        .signature-box {
            text-align: center;
            width: 40%;
            font-size: 9px;
        }

        .signature-line {
            border-top: 1px solid #333;
            margin-top: 8mm;
            padding-top: 1mm;
        }

        /* Print styles */
        @media print {
            title {
                display: none !important;
            }

            body {
                margin: 0;
                padding: 0;
            }

            .invoice-container {
                width: 100%;
                box-shadow: none;
                padding: 0;
            }

            .no-print {
                display: none;
            }

            .page-break {
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <!-- First Invoice -->
        <div class="invoice">
            <div class="invoice-header">
                <div class="company-info">
                    <div class="company-name">VIKAS LOGISTICS</div>
                    <div class="company-address">
                        {!! isset($consignorAddress) ? nl2br(e($consignorAddress)) : '--' !!}<br>
                        Contact: {{$sendor->contact ?? '+91 88403 54461'}} <br>
                        Email: vikaslogistics14320@gmail.com
                    </div>
                </div>
                <div class="company-logo">
                    <img src="{{ asset('site/img/logo-log.png') }}" alt="Logo" width="60">
                    <div class="company-address" style="font-size: 8px;line-height: 1.2; margin-top: -15px;">
                        <strong>Head office:</strong> 256 Damodar nagar Kanpur nagar -208027
                    </div>
                </div>
                <div class="invoice-details">
                    <div class="invoice-title">
                        @if ($booking->booking_type == 'Paid')
                        PAID
                        @elseif($booking->booking_type == 'Topay')
                        TO PAY
                        @else
                        UNKNOWN
                        @endif
                    </div>
                    <div class="invoice-number">LR No: {{ $booking->bilti_number }}</div>
                    <div>GSTIN: 09AHQPV3722R2Z7</div>
                    <div>Reg. UDYAM-UP-43-0045811</div>
                </div>
            </div>

            <div class="route-info">
                {{ $consignorCity }} TO: {{ $consigneeCity }} ({{ $booking->created_at }})
            </div>

            <table class="info-table">
                <tr>
                    <th>From: {{ $consignorCity }}</th>
                    <th>To: {{ $consigneeCity }}</th>
                    <th>KM: {{ $booking->distance }}</th>
                </tr>
                <tr>
                    <td>{{ $branch1Contact }}</td>
                    <td>{{ $branch2Contact }}</td>
                    <td>Article: {{ $booking->no_of_artical }}</td>
                </tr>
                <tr>
                    <td colspan="2">Act.Wt: {{ $booking->actual_weight }} Kg | Goods Value: {{ $booking->good_of_value }}</td>
                    <td>Invoice No: {{ $booking?->invoice_number }}</td>
                </tr>
            </table>

            <div class="two-columns">
                <div class="column">
                    <div class="party-section">
                        <div class="party-header">CONSIGNOR</div>
                        <div class="party-details">
                            <div class="party-row"><strong>Name:</strong> {{ $booking->consignor_name }}</div>
                            <div class="party-row"><strong>Address:</strong> {{ $booking->consignor_address }}</div>
                            <div class="party-row"><strong>Mobile:</strong> {{ $booking->consignor_phone_number }}</div>
                            <div class="party-row"><strong>GST:</strong> {{ $booking->consignor_gst_number }}</div>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <div class="party-section">
                        <div class="party-header">CONSIGNEE</div>
                        <div class="party-details">
                            <div class="party-row"><strong>Name:</strong> {{ $booking->consignee_name ?? '--' }}</div>
                            <div class="party-row"><strong>Address:</strong> {{ $booking->consignee_address ?? '--' }}</div>
                            <div class="party-row"><strong>Mobile:</strong> {{ $booking->consignee_phone_number ?? '--' }}</div>
                            <div class="party-row"><strong>GST:</strong> {{ $booking->consignee_gst_number ?? '--' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="info-table">
                <tr>
                    <th>Goods Contained (Declared by Consignor)</th>
                    <td>{{ $booking->cantain }}</td>
                </tr>
                <tr>
                    <th>Actual Goods Value Declared by Consignor</th>
                    <td>{{ $booking->mark }}</td>
                </tr>
                <tr>
                    <th>Remark</th>
                    <td>{{ $booking->remark ?? '--' }}</td>
                </tr>
            </table>

            <div class="invoice-footer">
                <div class="payment-info">
                    <div class="bank-details">
                        <strong>Bank Details:</strong><br>
                        Ac- 5530142311<br>
                        Bank Name - Central Bank of India<br>
                        IFSC - CBIN0283681<br>
                        Account Holder - Vikas Logistics
                    </div>
                    <div class="qr-code">
                        <img src="{{ asset('site/img/indianQr.jpg') }}" width="60" height="60">
                    </div>
                </div>

                <div class="amount-section">
                    <div class="total-amount">Final Total: ₹{{ $booking->grand_total_amount }}</div>
                    <div class="amount-in-words">Rs. {{ numberToWords($booking->grand_total_amount) }} Only</div>
                </div>

                <div class="terms">
                    <strong>Note:</strong> 1) Material must have been insured by owner in case of total value is more than Rs.2000.
                    (2) Party shall have to collect the goods within three days, there after company shall not be responsible and have to pay demurrage.
                    (3) In case of loss or damage, we are liable for only risk cover value for transit which declared by consignor at the time of booking.
                    (4) *Terms & Conditions Apply. (5) All Dispute at Kanpur jurisdiction only.
                    <br>
                    <strong>Track Shipment:</strong>
                    <a href="https://vikaslogistic.in/" target="_blank">
                        https://vikaslogistic.in/
                    </a>
                </div>

                <div class="signatures">
                    <div class="signature-box">
                        <div class="signature-line"></div>
                        Clerk Signature
                    </div>
                    <div class="signature-box">
                        <div class="signature-line"></div>
                        Consignor Signature
                    </div>
                </div>
            </div>
        </div>

        <!-- Page break for second copy -->
        <div class="page-break"></div>

        <!-- Second Invoice (Duplicate) -->
        <div class="invoice">
            <div class="invoice-header">
                <div class="company-info">
                    <div class="company-name">VIKAS LOGISTICS</div>
                    <div class="company-address">
                        {!! isset($consignorAddress) ? nl2br(e($consignorAddress)) : '--' !!}<br>
                        Contact: {{$sendor->contact ?? '+91 88403 54461'}} <br>
                        Email: vikaslogistics14320@gmail.com
                    </div>
                </div>
                <div class="company-logo">
                    <img src="{{ asset('site/img/logo-log.png') }}" alt="Logo" width="60">
                    <div class="company-address" style="font-size: 8px;line-height: 1.2; margin-top: -15px;">
                        <strong>Head office:</strong> 256 Damodar nagar Kanpur nagar -208027
                    </div>
                </div>
                <div class="invoice-details">
                    <div class="invoice-title">
                        @if ($booking->booking_type == 'Paid')
                        PAID
                        @elseif($booking->booking_type == 'Topay')
                        TO PAY
                        @else
                        UNKNOWN
                        @endif
                    </div>
                    <div class="invoice-number">LR No: {{ $booking->bilti_number }}</div>
                    <div>GSTIN: 09AHQPV3722R2Z7</div>
                    <div>Reg. UDYAM-UP-43-0045811</div>
                    <div style="margin-top: 2mm; font-weight: bold; color: red; font-size: 10px;">DUPLICATE COPY</div>
                </div>
            </div>

            <div class="route-info">
                {{ $consignorCity }} TO: {{ $consigneeCity }} ({{ $booking->created_at }})
            </div>

            <table class="info-table">
                <tr>
                    <th>From: {{ $consignorCity }}</th>
                    <th>To: {{ $consigneeCity }}</th>
                    <th>KM: {{ $booking->distance }}</th>
                </tr>
                <tr>
                    <td>{{ $branch1Contact }}</td>
                    <td>{{ $branch2Contact }}</td>
                    <td>Article: {{ $booking->no_of_artical }}</td>
                </tr>
                <tr>
                    <td colspan="2">Act.Wt: {{ $booking->actual_weight }} Kg | Goods Value: {{ $booking->good_of_value }}</td>
                    <td>Invoice No: {{ $booking->invoice_number }}</td>
                </tr>
            </table>

            <div class="two-columns">
                <div class="column">
                    <div class="party-section">
                        <div class="party-header">CONSIGNOR</div>
                        <div class="party-details">
                            <div class="party-row"><strong>Name:</strong> {{ $booking->consignor_name }}</div>
                            <div class="party-row"><strong>Address:</strong> {{ $booking->consignor_address }}</div>
                            <div class="party-row"><strong>Mobile:</strong> {{ $booking->consignor_phone_number }}</div>
                            <div class="party-row"><strong>GST:</strong> {{ $booking->consignor_gst_number }}</div>
                        </div>
                    </div>
                </div>

                <div class="column">
                    <div class="party-section">
                        <div class="party-header">CONSIGNEE</div>
                        <div class="party-details">
                            <div class="party-row"><strong>Name:</strong> {{ $booking->consignee_name ?? '--' }}</div>
                            <div class="party-row"><strong>Address:</strong> {{ $booking->consignee_address ?? '--' }}</div>
                            <div class="party-row"><strong>Mobile:</strong> {{ $booking->consignee_phone_number ?? '--' }}</div>
                            <div class="party-row"><strong>GST:</strong> {{ $booking->consignee_gst_number ?? '--' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="info-table">
                <tr>
                    <th>Goods Contained (Declared by Consignor)</th>
                    <td>{{ $booking->cantain }}</td>
                </tr>
                <tr>
                    <th>Actual Goods Value Declared by Consignor</th>
                    <td>{{ $booking->mark }}</td>
                </tr>
                <tr>
                    <th>Remark</th>
                    <td>{{ $booking->remark ?? '--' }}</td>
                </tr>
            </table>

            <div class="invoice-footer">
                <div class="payment-info">
                    <div class="bank-details">
                        <strong>Bank Details:</strong><br>
                        Ac- 5530142311<br>
                        Bank Name - Central Bank of India<br>
                        IFSC - CBIN0283681<br>
                        Account Holder - Vikas Logistics
                    </div>
                    <div class="qr-code">
                        <img src="{{ asset('site/img/indianQr.jpg') }}" width="60" height="60">
                    </div>
                </div>

                <div class="amount-section">
                    <div class="total-amount">Final Total: ₹{{ $booking->grand_total_amount }}</div>
                    <div class="amount-in-words">Rs. {{ numberToWords($booking->grand_total_amount) }} Only</div>
                </div>

                <div class="terms">
                    <strong>Note:</strong> 1) Material must have been insured by owner in case of total value is more than Rs.2000.
                    (2) Party shall have to collect the goods within three days, there after company shall not be responsible and have to pay demurrage.
                    (3) In case of loss or damage, we are liable for only risk cover value for transit which declared by consignor at the time of booking.
                    (4) *Terms & Conditions Apply. (5) All Dispute at Kanpur jurisdiction only.
                    <br>
                    <strong>Track Shipment:</strong>
                    <a href="https://vikaslogistic.in/" target="_blank">
                        https://vikaslogistic.in/
                    </a>
                </div>

                <div class="signatures">
                    <div class="signature-box">
                        <div class="signature-line"></div>
                        Clerk Signature
                    </div>
                    <div class="signature-box">
                        <div class="signature-line"></div>
                        Consignor Signature
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Print buttons (hidden when printing) -->
    <div class="no-print" style="text-align: center; margin: 10px;">
        <button onclick="window.print()" style="padding: 8px 16px; background: #2c3e50; color: white; border: none; border-radius: 3px; cursor: pointer; font-size: 10px;">
            Print Invoice
        </button>
    </div>
</body>

</html>