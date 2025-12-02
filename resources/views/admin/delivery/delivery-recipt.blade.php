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
            min-height: 297mm;
            padding: 8mm 10mm;
            margin: 0 auto !important;
            box-shadow: none;
        }

        .tm_hide_print {
            display: none !important;
        }

        .copy-separator {
            display: block !important;
        }
    }

    /* General Layout */
    body {
        font-family: 'Inter', Arial, sans-serif;
        background: #f5f6f8;
        margin: 0;
        padding: 12px;
        font-size: 15px;
    }

    .tm_container {
        max-width: 210mm;
        margin: 10px auto;
        background: white;
        box-shadow: 0 0 12px rgba(0,0,0,0.1);
        padding: 12px 15px;
        border-radius: 4px;
    }

    .gatepass-copy {
        padding: 14px 16px;
        border: 2px solid #2c5aa0;
        margin-bottom: 10mm;
        border-radius: 4px;
        page-break-inside: avoid;
        position: relative;
    }

    .copy-2 {
        border-color: #dc3545;
    }

    /* Copy Label */
    .copy-label {
        position: absolute;
        top: -10px;
        right: 18px;
        background: #2c5aa0;
        color: white;
        padding: 3px 10px;
        border-radius: 3px;
        font-size: 15px;
        font-weight: 600;
    }

    .copy-2 .copy-label {
        background: #dc3545;
    }

    /* HEADER */
    .header-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 6px;
        margin-bottom: 8px;
        border-bottom: 2px solid #2c5aa0;
    }

    .logo-section {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .logo {
        width: 45px;
        height: 45px;
    }

    .company-info {
        line-height: 1.25;
    }

    .company-name {
        font-size: 17px;
        font-weight: 700;
        color: #2c5aa0;
        margin: 0;
    }

    .company-details {
        font-size: 13px;
        color: #666;
    }

    .receipt-section {
        text-align: right;
    }

    .receipt-number {
        background: #2c5aa0;
        color: white;
        padding: 5px 10px;
        border-radius: 3px;
        font-weight: 600;
        display: inline-block;
        font-size: 14px;
    }

    /* GRID SUMMARY */
    .compact-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8px;
        margin: 12px 0;
    }

    .grid-item {
        background: #f5f7fc;
        padding: 6px;
        border-radius: 3px;
        border-left: 3px solid #2c5aa0;
    }

    .grid-label {
        font-weight: 600;
        color: #444;
        display: block;
        font-size: 13px;
        margin-bottom: 2px;
    }

    .grid-value {
        font-weight: 600;
        color: #222;
        font-size: 14px;
    }

    /* Section Title */
    .section-title {
        background: #2c5aa0;
        color: white;
        padding: 5px 8px;
        font-weight: 600;
        border-radius: 3px;
        margin: 10px 0 6px 0;
        font-size: 14px;
    }

    /* Detail Rows */
    .details-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
        font-size: 14px;
    }

    .detail-label {
        font-weight: 600;
        color: #555;
        min-width: 125px;
    }

    .detail-value {
        font-weight: 600;
        color: #222;
        flex: 1;
    }

    /* Payment Table */
    .payment-table {
        width: 100%;
        border-collapse: collapse;
        margin: 10px 0;
        font-size: 14px;
    }

    .payment-table th {
        background: #2c5aa0;
        color: white;
        padding: 6px 8px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
    }

    .payment-table td {
        padding: 6px 8px;
        border-bottom: 1px solid #e3e6ea;
        font-weight: 500;
    }

    .amount-total {
        font-weight: 700 !important;
        border-top: 2px solid #2c5aa0 !important;
    }

    .amount-received {
        color: #28a745;
        font-weight: 700;
    }

    .amount-pending {
        color: #dc3545;
        font-weight: 700;
    }

    /* BANK SECTION */
    .bank-section {
        background: #eaf4ff;
        padding: 6px 10px;
        border-radius: 3px;
        border-left: 4px solid #2c5aa0;
        margin: 10px 0;
    }

    .bank-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .qr-code img {
        width: 110px;
        height: 110px;
    }

    /* SIGNATURES */
    .signatures {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        font-size: 14px;
    }

    .signature-box {
        text-align: center;
        width: 32%;
    }

    .signature-line {
        border-top: 1px solid #333;
        margin-top: 30px;
        padding-top: 3px;
    }

    /* Disclaimer */
    .disclaimer {
        font-size: 13px;
        color: #555;
        margin-top: 12px;
        line-height: 1.4;
        border-top: 1px solid #ddd;
        padding-top: 6px;
    }

    /* Buttons */
    .print-controls {
        text-align: center;
        margin: 15px 0;
    }

    .print-btn, .back-btn {
        background: #2c5aa0;
        color: white;
        padding: 8px 16px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        margin: 0 5px;
        text-decoration: none;
        display: inline-block;
        font-weight: 600;
    }

    .back-btn {
        background: #6c757d;
    }

    .print-btn:hover {
        background: #1b3f72;
    }

    .back-btn:hover {
        background: #565d64;
    }

    .copy-separator {
        text-align: center;
        margin: 4mm 0;
        font-size: 14px;
        color: #999;
        display: none;
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
            <div style="display: flex; justify-content: space-between; gap: 10px;">
                <!-- LEFT SIDE (YOUR ORIGINAL LINES—UNCHANGED) -->
                <div style="width: 50%;">
                    <div class="details-row">
                        <span class="detail-label">Carrier By:</span>
                        <span class="detail-value">{{ ucfirst($deliveryReceipt->recived_by) }}</span>
                    </div>
                    <div class="details-row">
                        <span class="detail-label">Carrier Mobile:</span>
                        <span class="detail-value">{{ $deliveryReceipt->reciver_mobile }}</span>
                    </div>
                    <div class="details-row">
                        <span class="detail-label">LR Number:</span>
                        <span class="detail-value">{{ $deliveryReceipt?->booking?->bilti_number ?? '--' }}</span>
                    </div>
                </div>

                <!-- RIGHT SIDE (NEW CONSIGNOR & CONSIGNEE INFO) -->
                <div style="width: 50%;">
                    <div class="details-row">
                        <span class="detail-label">Consignor:</span>
                        <span class="detail-value">
                            {{ $deliveryReceipt?->booking?->consignor_name ?? '--' }}
                        </span>
                    </div>
                    <div class="details-row">
                        <span class="detail-label">Consignee:</span>
                        <span class="detail-value">
                            {{ $deliveryReceipt?->booking?->consignee_name ?? '--' }}
                        </span>
                    </div>
                    <div class="details-row">
                        <span class="detail-label">Consignor Mobile:</span>
                        <span class="detail-value">
                            {{ $deliveryReceipt?->booking?->consignor_phone_number ?? '--' }}
                        </span>
                    </div>
                    <div class="details-row">
                        <span class="detail-label">Consignee Mobile:</span>
                        <span class="detail-value">
                            {{ $deliveryReceipt?->booking?->consignee_phone_number ?? '--' }}
                        </span>
                    </div>
                </div>

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
               <div style="display: flex; justify-content: space-between; gap: 10px;">
                <!-- LEFT SIDE (YOUR ORIGINAL LINES—UNCHANGED) -->
                <div style="width: 50%;">
                    <div class="details-row">
                        <span class="detail-label">Carrier By:</span>
                        <span class="detail-value">{{ ucfirst($deliveryReceipt->recived_by) }}</span>
                    </div>
                    <div class="details-row">
                        <span class="detail-label">Carrier Mobile:</span>
                        <span class="detail-value">{{ $deliveryReceipt->reciver_mobile }}</span>
                    </div>
                    <div class="details-row">
                        <span class="detail-label">LR Number:</span>
                        <span class="detail-value">{{ $deliveryReceipt?->booking?->bilti_number ?? '--' }}</span>
                    </div>
                </div>

                <!-- RIGHT SIDE (NEW CONSIGNOR & CONSIGNEE INFO) -->
                <div style="width: 50%;">
                    <div class="details-row">
                        <span class="detail-label">Consignor:</span>
                        <span class="detail-value">
                            {{ $deliveryReceipt?->booking?->consignor_name ?? '--' }}
                        </span>
                    </div>
                    <div class="details-row">
                        <span class="detail-label">Consignee:</span>
                        <span class="detail-value">
                            {{ $deliveryReceipt?->booking?->consignee_name ?? '--' }}
                        </span>
                    </div>
                    <div class="details-row">
                        <span class="detail-label">Consignor Mobile:</span>
                        <span class="detail-value">
                            {{ $deliveryReceipt?->booking?->consignor_mobile ?? '--' }}
                        </span>
                    </div>
                    <div class="details-row">
                        <span class="detail-label">Consignee Mobile:</span>
                        <span class="detail-value">
                            {{ $deliveryReceipt?->booking?->consignee_mobile ?? '--' }}
                        </span>
                    </div>
                </div>

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