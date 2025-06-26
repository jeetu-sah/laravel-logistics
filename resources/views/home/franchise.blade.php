<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Franchise Form with Signature Pad</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Signature Pad JS -->
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        body {
            background: #f0f4f8;
            font-family: 'Inter', sans-serif;
        }

        .form-card {
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: 40px auto;
        }

        .signature-pad {
            border: 2px dashed #ccc;
            border-radius: 10px;
            background: #fff;
            height: 200px;
        }

        .btn-custom {
            background: #007BFF;
            color: #fff;
            padding: 10px 25px;
            border-radius: 8px;
            border: none;
        }

        .btn-custom:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row form-card">
            <h2 class="text-center mb-4">Franchise Application with Signature</h2>

            <form id="franchiseForm" method="POST" action="{{ route('franchise.application.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <label class="form-label">Title</label>
                        <select class="form-select" name="title" required>
                            <option selected disabled>Choose</option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>

                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">First Name *</label>
                        <input type="text" class="form-control" name="first_name" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Middle Name</label>
                        <input type="text" class="form-control" name="middle_name">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Last Name *</label>
                        <input type="text" class="form-control" name="last_name" required>
                    </div>
                </div>

                <!-- Age, Email, Contact -->
                <div class="row g-3 mt-3">
                    <div class="col-md-2">
                        <label class="form-label">Age *</label>
                        <input type="number" class="form-control" name="age" placeholder="e.g. 23" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Email *</label>
                        <input type="email" class="form-control" name="email" placeholder="example@example.com"
                            required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Cell Number *</label>
                        <input type="text" class="form-control" name="cell_number" placeholder="(000) 000-0000"
                            required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Landline Number *</label>
                        <input type="text" class="form-control" name="landline_number" placeholder="(000) 000-0000"
                            required>
                    </div>
                </div>

                <!-- Investment -->
                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label class="form-label">Total Cash available (Rands) *</label>
                        <input type="number" class="form-control" name="total_cash_invest" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Own (free) Cash *</label>
                        <input type="number" class="form-control" name="own_cash_invest" required>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label class="form-label">Funds you will borrow *</label>
                        <input type="number" class="form-control" name="borrowed_funds" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Borrow from whom? *</label>
                        <input type="text" class="form-control" name="borrow_from" required>
                    </div>
                </div>

                <!-- Outlets & Areas -->
                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label class="form-label">No. of booking outlets *</label>
                        <input type="number" class="form-control" name="no_of_outlets" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Area(s) of interest *</label>
                        <textarea class="form-control" name="areas_of_interest" rows="2" required></textarea>
                    </div>
                </div>

                <!-- Opening Date -->
                <div class="mb-3 mt-3">
                    <label class="form-label">Planned Opening Date *</label>
                    <input type="date" class="form-control" name="planned_opening_date" required>
                </div>

                <!-- Experience & Comments -->
                <div class="row">
                    <div class="mt-3 col-md-6">
                        <label class="form-label">Business/Industry Experience *</label>
                        <textarea class="form-control" name="business_experience" rows="3" required></textarea>
                    </div>
                    <div class="mt-3 col-md-6">
                        <label class="form-label">Additional Comments/Questions</label>
                        <textarea class="form-control" name="additional_comments" rows="3"></textarea>
                    </div>
                </div>

                <!-- Signature -->
                <div class="row mt-3">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">Signature *</label>
                        <canvas id="signatureCanvas" class="signature-pad"></canvas>
                        <div class="mt-2">
                            <button type="button" class="btn btn-secondary btn-sm"
                                onclick="clearSignature()">Clear</button>
                        </div>
                    </div>
                </div>

                <!-- Hidden for Signature Data -->
                <input type="hidden" name="signature_data" id="signatureData">

                <div class="mb-3 col-md-12 mt-4">
                    <button type="submit" class="btn btn-custom">Submit Application</button>
                </div>
            </form>
  <script>
        // initialize signature pad
        const canvas = document.getElementById('signatureCanvas');
        const signaturePad = new SignaturePad(canvas);

        // clear signature
        function clearSignature() {
            signaturePad.clear();
        }

        // resize canvas
        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
            signaturePad.clear();
        }
        window.addEventListener("resize", resizeCanvas);
        resizeCanvas();

        // on form submit
        document.getElementById('franchiseForm').addEventListener('submit', function(e) {
            // e.preventDefault();

            if (signaturePad.isEmpty()) {
                alert("Please provide a signature before submitting.");
                return;
            }

            // save signature data to hidden input
            document.getElementById('signatureData').value = signaturePad.toDataURL();

            // for demo — just show dataURL
            console.log("Signature Data URL: ", document.getElementById('signatureData').value);

            alert("Form Submitted Successfully with Signature!");
        });
    </script>
        </div>
    </div>

    <!-- Signature Pad JS Handling -->
  

</body>

</html>
