<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vikash Logistic - Gatepass</title>
    <style>
        /* A4 Print Styles */
        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .tm_container {
                width: 210mm;
                height: 297mm;
                padding: 5mm;
                margin: 0 auto;
                box-shadow: none;
            }

            .tm_hide_print {
                display: none !important;
            }

            .copy-separator {
                display: block !important;
            }
        }

        /* Compact Styling */
        body {
            font-family: 'Inter', Arial, sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 10px;
            font-size: 12px;
        }

        .tm_container {
            max-width: 210mm;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .gatepass-copy {
            padding: 10px;
            border: 2px solid #2c5aa0;
            margin-bottom: 5mm;
            page-break-inside: avoid;
            position: relative;
        }

        .copy-2 {
            border-color: #dc3545;
        }

        .copy-label {
            position: absolute;
            top: -8px;
            right: 10px;
            background: #2c5aa0;
            color: white;
            padding: 2px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }

        .copy-2 .copy-label {
            background: #dc3545;
        }

        .header-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #2c5aa0;
            padding-bottom: 8px;
            margin-bottom: 8px;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .logo {
            width: 40px;
            height: 40px;
        }

        .company-info {
            text-align: left;
        }

        .company-name {
            font-size: 16px;
            font-weight: bold;
            color: #2c5aa0;
            margin: 0;
            line-height: 1.2;
        }

        .company-details {
            font-size: 8px;
            color: #555;
            line-height: 1.1;
        }

        .receipt-section {
            text-align: right;
        }

        .receipt-number {
            background: #2c5aa0;
            color: white;
            padding: 4px 8px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 11px;
            display: inline-block;
        }

        .compact-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 5px;
            margin: 8px 0;
            font-size: 10px;
        }

        .grid-item {
            background: #f8f9fa;
            padding: 4px;
            border-radius: 3px;
            border-left: 2px solid #2c5aa0;
        }

        .grid-label {
            font-weight: bold;
            color: #555;
            display: block;
            font-size: 9px;
        }

        .grid-value {
            color: #333;
            font-weight: bold;
        }

        .section-title {
            background: #2c5aa0;
            color: white;
            padding: 4px 6px;
            font-weight: bold;
            margin: 8px 0 4px 0;
            border-radius: 2px;
            font-size: 11px;
        }

        .details-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
            font-size: 10px;
        }

        .detail-label {
            font-weight: bold;
            color: #555;
            min-width: 100px;
        }

        .detail-value {
            color: #333;
            flex: 1;
        }

        .payment-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
            margin: 6px 0;
        }

        .payment-table th {
            background: #2c5aa0;
            color: white;
            padding: 4px 6px;
            text-align: left;
            font-weight: bold;
        }

        .payment-table td {
            padding: 4px 6px;
            border-bottom: 1px solid #ddd;
        }

        .amount-total {
            font-weight: bold;
            border-top: 2px solid #2c5aa0 !important;
        }

        .amount-received {
            color: #28a745;
            font-weight: bold;
        }

        .amount-pending {
            color: #dc3545;
            font-weight: bold;
        }

        .bank-section {
            background: #e9f7fe;
            padding: 6px;
            border-radius: 3px;
            margin: 6px 0;
            border-left: 3px solid #2c5aa0;
            font-size: 9px;
        }

        .bank-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .qr-code img {
            width: 50px;
            height: 50px;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            font-size: 9px;
        }

        .signature-box {
            text-align: center;
            width: 30%;
        }

        .signature-line {
            border-top: 1px solid #333;
            margin-top: 25px;
            padding-top: 2px;
        }

        .disclaimer {
            font-size: 8px;
            color: #666;
            margin-top: 8px;
            line-height: 1.2;
            border-top: 1px solid #ddd;
            padding-top: 4px;
        }

        .print-controls {
            text-align: center;
            margin: 15px 0;
        }

        .print-btn {
            background: #2c5aa0;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 14px;
            margin: 0 5px;
        }

        .print-btn:hover {
            background: #1e3d6f;
        }

        .back-btn {
            background: #6c757d;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 14px;
            margin: 0 5px;
            text-decoration: none;
            display: inline-block;
        }

        .back-btn:hover {
            background: #545b62;
        }

        .copy-separator {
            text-align: center;
            color: #666;
            font-size: 10px;
            margin: 3mm 0;
            display: none;
        }

        /* Two copies layout */
        @media screen {
            .gatepass-copy {
                height: 138mm;
            }
        }

        @media print {
            .gatepass-copy {
                height: 138mm;
            }
        }
    </style>
</head>

<body>
    <div class="print-controls tm_hide_print">
        <button class="print-btn" onclick="window.print()">🖨️ Print Two Copies</button>
        <a href="{{ url('admin/delivery/gatepass') }}" class="back-btn">← Back</a>
    </div>

    <div class="tm_container">
        <!-- First Copy -->
        <div class="gatepass-copy">
            <div class="copy-label">ORIGINAL COPY</div>

            <!-- Header with Logo -->
            <div class="header-section">
                <div class="logo-section">
                    <img src="{{ asset('site/img/logo-log.png') }}" alt="Vikas Logistics" class="logo">
                    <div class="company-info">
                        <div class="company-name">Vikas Logistics</div>
                        <div class="company-details">
                            Reg. UDYAM-UP-43-0045811<br>
                            GSTIN: 09AHQPV3722R2Z7
                        </div>
                    </div>
                </div>
                <div class="receipt-section">
                    <div class="receipt-number">Receipt: {{ $deliveryReceipt->delivery_number }}</div>
                    <div class="company-details" style="margin-top: 2px;">
                        +91 88403 54461
                    </div>
                </div>
            </div>

            <!-- Summary Grid -->
            <div class="compact-grid">
                <div class="grid-item">
                    <span class="grid-label">From</span>
                    <span class="grid-value">{{ $deliveryReceipt?->booking?->consignorBranch?->branch_name ?? '--' }}</span>
                </div>
                <div class="grid-item">
                    <span class="grid-label">To</span>
                    <span class="grid-value">{{ $deliveryReceipt?->booking?->consigneeBranch?->branch_name ?? '--' }}</span>
                </div>
                <div class="grid-item">
                    <span class="grid-label">Articles</span>
                    <span class="grid-value">{{ $deliveryReceipt?->booking?->no_of_artical ?? '--' }}</span>
                </div>
                <div class="grid-item">
                    <span class="grid-label">Date</span>
                    <span class="grid-value">{{ formatDate($deliveryReceipt?->booking?->booking_date) ?? '--' }}</span>
                </div>
            </div>

            <!-- Delivery Details -->
            <div class="section-title">Delivery Information</div>
            <div class="details-row">
                <span class="detail-label">Received By:</span>
                <span class="detail-value">{{ ucfirst($deliveryReceipt->recived_by) }}</span>
            </div>
            <div class="details-row">
                <span class="detail-label">Mobile:</span>
                <span class="detail-value">{{ $deliveryReceipt->reciver_mobile }}</span>
            </div>
            <div class="details-row">
                <span class="detail-label">LR Number:</span>
                <span class="detail-value">{{ $deliveryReceipt?->booking?->bilti_number ?? '--' }}</span>
            </div>

            <!-- Goods Information -->
            <div class="section-title">Goods Information</div>
            <div class="details-row">
                <span class="detail-label">Goods Contained:</span>
                <span class="detail-value">{{ $deliveryReceipt?->booking?->cantain ?: '--' }}</span>
            </div>
            <div class="details-row">
                <span class="detail-label">Declared Value:</span>
                <span class="detail-value">{{ $deliveryReceipt?->booking?->good_of_value ?: '--' }}</span>
            </div>
            <div class="details-row">
                <span class="detail-label">Remark:</span>
                <span class="detail-value">{{ $deliveryReceipt?->remark ?: '--' }}</span>
            </div>

            <!-- Payment Section -->
            <div class="section-title">Payment Details</div>
            <table class="payment-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th style="text-align: right;">Amount (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Freight Charges</td>
                        <td style="text-align: right;">{{ number_format($deliveryReceipt->freight_charges, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Hamali Charges</td>
                        <td style="text-align: right;">{{ number_format($deliveryReceipt->hamali_charges, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Demurrage Charges</td>
                        <td style="text-align: right;">{{ number_format($deliveryReceipt->demruge_charges, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Other Charges</td>
                        <td style="text-align: right;">{{ number_format($deliveryReceipt->others_charges, 2) }}</td>
                    </tr>
                    <tr class="amount-total">
                        <td>Grand Total</td>
                        <td style="text-align: right;">{{ number_format($deliveryReceipt->grand_total, 2) }}</td>
                    </tr>
                    <tr class="amount-received">
                        <td>Received Amount</td>
                        <td style="text-align: right;">{{ number_format($deliveryReceipt->received_amount, 2) }}</td>
                    </tr>
                    <tr class="amount-pending">
                        <td>Pending Amount</td>
                        <td style="text-align: right;">{{ number_format($deliveryReceipt->pending_amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Bank Details -->
            <div class="bank-section">
                <div class="bank-row">
                    <div>
                        <strong>Bank Details:</strong><br>
                        A/C: 5530142311<br>
                        Central Bank of India<br>
                        IFSC: CBIN0283681
                    </div>
                    <div class="qr-code">
                        <img src="{{ asset('site/img/indianQr.jpg') }}" alt="QR Code">
                    </div>
                </div>
            </div>

            <!-- Signatures -->
            <div class="signatures">
                <div class="signature-box">
                    <div>Received By</div>
                    <div class="signature-line"></div>
                    <div><strong>{{ ucfirst($deliveryReceipt->recived_by) }}</strong></div>
                </div>
                <div class="signature-box">
                    <div>Authorized Signatory</div>
                    <div class="signature-line"></div>
                    <div><strong>Vikas Logistics</strong></div>
                </div>
            </div>

            <!-- Disclaimer -->
            <div class="disclaimer">
                <strong>Note:</strong> 1) Material insured if value > ₹2000. 2) Collect within 3 days. 3) Liability limited to declared value. 4) *T&C Apply. 5) Jurisdiction: Kanpur.
            </div>
        </div>

        <!-- Copy Separator -->
        <div class="copy-separator">━━━━━━━━━━━━ CUT HERE ━━━━━━━━━━━━</div>

        <!-- Second Copy -->
        <div class="gatepass-copy copy-2">
            <div class="copy-label">DUPLICATE COPY</div>

            <!-- Header with Logo -->
            <div class="header-section">
                <div class="logo-section">
                    <img src="{{ asset('site/img/logo-log.png') }}" alt="Vikas Logistics" class="logo">
                    <div class="company-info">
                        <div class="company-name">Vikas Logistics</div>
                        <div class="company-details">
                            Reg. UDYAM-UP-43-0045811<br>
                            GSTIN: 09AHQPV3722R2Z7
                        </div>
                    </div>
                </div>
                <div class="receipt-section">
                    <div class="receipt-number">Receipt: {{ $deliveryReceipt->delivery_number }}</div>
                    <div class="company-details" style="margin-top: 2px;">
                        +91 88403 54461
                    </div>
                </div>
            </div>

            <!-- Summary Grid -->
            <div class="compact-grid">
                <div class="grid-item">
                    <span class="grid-label">From</span>
                    <span class="grid-value">{{ $deliveryReceipt?->booking?->consignorBranch?->branch_name ?? '--' }}</span>
                </div>
                <div class="grid-item">
                    <span class="grid-label">To</span>
                    <span class="grid-value">{{ $deliveryReceipt?->booking?->consigneeBranch?->branch_name ?? '--' }}</span>
                </div>
                <div class="grid-item">
                    <span class="grid-label">Articles</span>
                    <span class="grid-value">{{ $deliveryReceipt?->booking?->no_of_artical ?? '--' }}</span>
                </div>
                <div class="grid-item">
                    <span class="grid-label">Date</span>
                    <span class="grid-value">{{ formatDate($deliveryReceipt?->booking?->booking_date) ?? '--' }}</span>
                </div>
            </div>

            <!-- Delivery Details -->
            <div class="section-title">Delivery Information</div>
            <div class="details-row">
                <span class="detail-label">Received By:</span>
                <span class="detail-value">{{ ucfirst($deliveryReceipt->recived_by) }}</span>
            </div>
            <div class="details-row">
                <span class="detail-label">Mobile:</span>
                <span class="detail-value">{{ $deliveryReceipt->reciver_mobile }}</span>
            </div>
            <div class="details-row">
                <span class="detail-label">LR Number:</span>
                <span class="detail-value">{{ $deliveryReceipt?->booking?->bilti_number ?? '--' }}</span>
            </div>

            <!-- Goods Information -->
            <div class="section-title">Goods Information</div>
            <div class="details-row">
                <span class="detail-label">Goods Contained:</span>
                <span class="detail-value">{{ $deliveryReceipt?->booking?->cantain ?: '--' }}</span>
            </div>
            <div class="details-row">
                <span class="detail-label">Declared Value:</span>
                <span class="detail-value">{{ $deliveryReceipt?->booking?->good_of_value ?: '--' }}</span>
            </div>
            <div class="details-row">
                <span class="detail-label">Remark:</span>
                <span class="detail-value">{{ $deliveryReceipt?->remark ?: '--' }}</span>
            </div>

            <!-- Payment Section -->
            <div class="section-title">Payment Details</div>
            <table class="payment-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th style="text-align: right;">Amount (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Freight Charges</td>
                        <td style="text-align: right;">{{ number_format($deliveryReceipt->freight_charges, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Hamali Charges</td>
                        <td style="text-align: right;">{{ number_format($deliveryReceipt->hamali_charges, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Demurrage Charges</td>
                        <td style="text-align: right;">{{ number_format($deliveryReceipt->demruge_charges, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Other Charges</td>
                        <td style="text-align: right;">{{ number_format($deliveryReceipt->others_charges, 2) }}</td>
                    </tr>
                    <tr class="amount-total">
                        <td>Grand Total</td>
                        <td style="text-align: right;">{{ number_format($deliveryReceipt->grand_total, 2) }}</td>
                    </tr>
                    <tr class="amount-received">
                        <td>Received Amount</td>
                        <td style="text-align: right;">{{ number_format($deliveryReceipt->received_amount, 2) }}</td>
                    </tr>
                    <tr class="amount-pending">
                        <td>Pending Amount</td>
                        <td style="text-align: right;">{{ number_format($deliveryReceipt->pending_amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Bank Details -->
            <div class="bank-section">
                <div class="bank-row">
                    <div>
                        <strong>Bank Details:</strong><br>
                        A/C: 5530142311<br>
                        Central Bank of India<br>
                        IFSC: CBIN0283681
                    </div>
                    <div class="qr-code">
                        <img src="{{ asset('site/img/indianQr.jpg') }}" alt="QR Code">
                    </div>
                </div>
            </div>

            <!-- Signatures -->
            <div class="signatures">
                <div class="signature-box">
                    <div>Received By</div>
                    <div class="signature-line"></div>
                    <div><strong>{{ ucfirst($deliveryReceipt->recived_by) }}</strong></div>
                </div>
                <div class="signature-box">
                    <div>Authorized Signatory</div>
                    <div class="signature-line"></div>
                    <div><strong>Vikas Logistics</strong></div>
                </div>
            </div>

            <!-- Disclaimer -->
            <div class="disclaimer">
                <strong>Note:</strong> 1) Material insured if value > ₹2000. 2) Collect within 3 days. 3) Liability limited to declared value. 4) *T&C Apply. 5) Jurisdiction: Kanpur.
            </div>
        </div>
    </div>

    <script>
        // Auto-print if needed
        @if(request()->has('autoprint'))
        window.onload = function() {
            window.print();
        }
        @endif

        // Enhanced print functionality
        document.addEventListener('DOMContentLoaded', function() {
            const style = document.createElement('style');
            style.innerHTML = `
                @media print {
                    body * {
                        visibility: hidden;
                    }
                    .tm_container, .tm_container * {
                        visibility: visible;
                    }
                    .tm_container {
                        position: absolute;
                        left: 0;
                        top: 0;
                        width: 100%;
                    }
                    .gatepass-copy {
                        page-break-after: always;
                    }
                    .gatepass-copy:last-child {
                        page-break-after: avoid;
                    }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>

</html>