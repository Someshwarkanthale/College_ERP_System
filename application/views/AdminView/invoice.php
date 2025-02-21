<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f7fa;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            padding: 20px;
        }

        h2 {
            font-size: 30px;
            color: #007bff;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }

        h4 {
            font-size: 24px;
            color: #28a745;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: rgb(77, 84, 92);
            padding: 5px 15px;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .invoice-info {
            margin-top: 30px;
            font-size: 16px;
        }

        .invoice-info p {
            font-weight: bold;
        }

        .invoice-info p span {
            font-weight: normal;
        }

        @media print {

            .btn-primary,
            .btn-secondary,
            .back-button {
                display: none;
            }
        }

        @media (max-width: 576px) {

            /* For small devices (mobile) */
            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 10px;
            }

            .d-flex .btn {
                width: 100%;
                margin-bottom:10px;
                /* Full width on mobile */
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="main bg-white">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <!-- Print Button -->
                    <button class="btn btn-primary" onclick="window.print()">
                        <i class="fas fa-print"></i> Print
                    </button>
                    <!-- Back Button -->
                    <a href="<?= base_url('AdminPanel/studentList'); ?>" class="btn btn-secondary back-button">
                        <i class="fas fa-arrow-left"></i> Back to Student List
                    </a>
                </div>

                <h2>Payment Invoice</h2>

                <div class="invoice-info">
                    <p><strong>Student Name:</strong> <span><?= $student->student_name; ?></span></p>
                    <p><strong>Course Name:</strong> <span><?= $student->course_name; ?></span></p>
                    <p><strong>Category:</strong> <span><?= $student->category; ?></span></p>
                    <p><strong>Total Fee:</strong> <span>&#8377;<?= number_format($student->total_fee, 2); ?></span></p>
                    <p><strong>Paid Fee:</strong> <span>&#8377;<?= number_format($student->paid_fee, 2); ?></span></p>
                    <p><strong>Remaining Fee:</strong> <span>&#8377;<?= number_format($student->remaining_fee, 2); ?></span></p>
                </div>

                <h4>Transactions</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Paid Fee</th>
                            <th>Transaction Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($transactions)): ?>
                            <?php foreach ($transactions as $index => $transaction): ?>
                                <tr>
                                    <td><?= $index + 1; ?></td>
                                    <td>&#8377;<?= number_format($transaction->paid_fee, 2); ?></td>
                                    <td><?= date('Y-m-d', strtotime($transaction->transaction_date)); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">No Transactions Found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>