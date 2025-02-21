<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pay Fee</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin-top: 50px;
            padding: 20px;
        }

        h2 {
            font-weight: bold;
            color: #007bff;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            padding: 10px 30px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .form-s {
            margin: 0 50px 0 50px
        }

        .alert {
            margin-top: 20px;
            text-align: center;
        }

        .info-card {
            background-color: #f1f9ff;
            border: 1px solid #cce5ff;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .info-card p {
            margin: 0;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php $this->load->view('AdminView/Adminsidebar'); ?>

        <div class="main bg-white">
            <?php $this->load->view('AdminView/Nav_admin'); ?>

            <!-- Page content -->
            <div class="container form-s">
                <h2>Pay Fee for <?php echo $student->student_name; ?></h2>

                <div class="info-card form-s">
                    <p><strong>Student Name:</strong> <?php echo $student->student_name; ?></p>
                    <p><strong>Course Name:</strong> <?php echo $student->course_name; ?></p>
                    <p><strong>Category:</strong> <?php echo $student->category; ?></p>
                    <p><strong>Total Fee:</strong> &#8377;<?php echo number_format($student->total_fee, 2); ?></p>
                    <p><strong>Paid Fee:</strong> &#8377;<?php echo number_format($student->paid_fee, 2); ?></p>
                    <p><strong>Remaining Fee:</strong> &#8377;<?php echo number_format($student->remaining_fee, 2); ?></p>
                </div>

                <h4 class="text-primary form-s">New Payment</h4>
                <form class="form-s" action="<?php echo site_url('AdminPanel/process_fee_payment'); ?>" method="post" onsubmit="return validateFee()">
                    <input type="hidden" name="student_id" value="<?php echo $student->id; ?>">
                    <div class="form-group mb-3">
                        <label for="paid_fee">Paid Fee</label>
                        <input type="number" name="paid_fee" id="paid_fee" class="form-control" placeholder="Enter amount" required>
                    </div>
                    <button type="submit" class="btn btn-primary ">Submit Payment</button>
                    <button type="button" class="btn btn-secondary" onclick="history.back();">Cancel</button>

                </form>

                <h4 class="text-primary mt-5 form-s">Previous Transactions</h4>
                <?php if (!empty($transactions)): ?>
                    <table class="table table-bordered table-hover mt-3 ">
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
                <?php else: ?>
                    <div class="alert alert-info" role="alert">
                        No transactions available for this student.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function validateFee() {
            const remainingFee = parseFloat(<?php echo $student->remaining_fee; ?>);
            const paidFee = parseFloat(document.getElementById('paid_fee').value);

            if (paidFee > remainingFee) {
                alert('The entered fee cannot exceed the remaining fee.');
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }
    </script>
    <script>
        const sidebarToggle = document.querySelector("#sidebar-toggle");
        sidebarToggle.addEventListener("click", function() {
            document.querySelector("#sidebar").classList.toggle("collapsed");
        });
    </script>

</body>

</html>