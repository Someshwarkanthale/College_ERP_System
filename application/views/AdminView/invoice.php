<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        }
        .form-s {
            margin: 0 50px 0 50px
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
            border-color:rgb(77, 84, 92);
            padding: 2px;
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

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #dee2e6;
        }

        .table-bordered {
            margin-top: 20px;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
            margin-right: 5px;
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

        .footer {
            text-align: center;
            margin-top: 40px;
            color: #6c757d;
        }

        @media print {
            .btn-primary,
            .btn-secondary,
            .footer {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .button-group {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper ">
        <?php $this->load->view('AdminView/Adminsidebar'); ?>

        <div class="main bg-white ">
            <?php $this->load->view('AdminView/Nav_admin'); ?>
            
            <div class="button-group ">
                    <!-- Print Button -->
                    <button class="btn-primary" onclick="window.print()">
                        <i class="fas fa-print"></i> Print
                    </button>
                  
                </div>
            <div class="container form-s">

                <h2>Payment Invoice</h2>

                <div class="invoice-info form-s">
                    <p><strong>Student Name:</strong> <span><?php echo $student->student_name; ?></span></p>
                    <p><strong>Course Name:</strong> <span><?php echo $student->course_name; ?></span></p>
                    <p><strong>Category:</strong> <span><?php echo $student->category; ?></span></p>
                    <p><strong>Total Fee:</strong> <span>&#8377;<?php echo number_format($student->total_fee, 2); ?></span></p>
                    <p><strong>Paid Fee:</strong> <span>&#8377;<?php echo number_format($student->paid_fee, 2); ?></span></p>
                    <p><strong>Remaining Fee:</strong> <span>&#8377;<?php echo number_format($student->remaining_fee, 2); ?></span></p>
                </div>

                <h4 class="form-s">Transactions</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Paid Fee</th>
                            <th>Transaction Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $index => $transaction): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td>&#8377;<?php echo number_format($transaction->paid_fee, 2); ?></td>
                                <td><?php echo date('Y-m-d', strtotime($transaction->transaction_date)); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Font Awesome for the print icon -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const sidebarToggle = document.querySelector("#sidebar-toggle");
    sidebarToggle.addEventListener("click", function() {
        document.querySelector("#sidebar").classList.toggle("collapsed");
    });
</script>
</body>

</html>
