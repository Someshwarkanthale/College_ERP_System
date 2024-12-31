<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Update Additional Fee</title>
    <style>
        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-family: 'Arial', sans-serif;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input.form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            background-color: #f9f9f9;
            transition: border-color 0.3s;
        }

        input.form-control:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-text {
            font-size: 0.875rem;
        }

        .form-text.text-danger {
            color: #e63946;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        button.btn {
            flex: 1;
            margin: 0 5px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        button.btn:hover {
            transform: translateY(-2px);
        }

        button.btn-primary {
            background-color: #007bff;
        }

        button.btn-primary:hover {
            background-color: #0056b3;
        }

        button.btn-secondary {
            background-color: #6c757d;
        }

        button.btn-secondary:hover {
            background-color: #565e64;
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 15px;
            }

            input.form-control {
                font-size: 0.9rem;
            }

            button.btn {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 576px) {
            h2 {
                font-size: 1.5rem;
            }

            button.btn {
                font-size: 0.85rem;
            }

            .button-group {
                flex-direction: column;
            }

            button.btn {
                margin: 5px 0;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php $this->load->view('AdminView/Adminsidebar'); ?>

        <div class="main bg-white">
            <?php $this->load->view('AdminView/Nav_admin'); ?>
            <!--Page area start-->
            <div class="container mt-5">
                <h2>Update Additional Fee</h2>
                <form action="<?php echo site_url('index.php/AdminPanel/update_additional_fee/' . $fee->id); ?>" method="POST">
                    <div class="form-group">
                        <label for="department">Department:</label>
                        <input type="text" name="department" id="department" class="form-control"
                            value="<?php echo htmlspecialchars($fee->department, ENT_QUOTES, 'UTF-8'); ?>"
                            required pattern="^[A-Za-z]{2}[A-Za-z0-9 ]{1,}$"
                            title="Department must start with at least 2 alphabets and have a minimum of 3 characters.">
                        <small id="departmentError" class="form-text text-danger" aria-live="polite"></small>
                    </div>
                    <div class="form-group">
                        <label for="fee">Fee:</label>
                        <input type="number" name="fee" id="fee" class="form-control"
                            value="<?php echo htmlspecialchars($fee->fee, ENT_QUOTES, 'UTF-8'); ?>"
                            required step="0.01" min="0.01"
                            title="Fee must be a positive number greater than 0.">
                        <small id="feeError" class="form-text text-danger" aria-live="polite"></small>
                    </div>
                    <div class="button-group">
                        <button type="submit" class="btn btn-primary">Update Fee</button>
                        <button type="button" class="btn btn-secondary" onclick="history.back();">Cancel</button>
                    </div>
                </form>
            </div>
            <!--Page area end-->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Real-time validation for department
            $('#department').on('input', function() {
                var department = $(this).val();
                var departmentPattern = /^[A-Za-z]{2}[A-Za-z0-9 ]{1,}$/;
                if (!departmentPattern.test(department)) {
                    $('#departmentError').text(
                        "Department must start with at least 2 alphabets and have a minimum of 3 characters."
                    );
                } else {
                    $('#departmentError').text(""); // Clear the error
                }
            });

            // Real-time validation for fee
            $('#fee').on('input', function() {
                var fee = parseFloat($(this).val());
                if (isNaN(fee) || fee <= 0) {
                    $('#feeError').text("Fee must be a positive number greater than 0.");
                } else {
                    $('#feeError').text(""); // Clear the error
                }
            });

            // Final validation before form submission
            $('form').on('submit', function() {
                if ($('#departmentError').text() || $('#feeError').text()) {
                    alert("Please correct the errors before submitting the form.");
                    return false; // Prevent form submission if there are validation errors
                }
                return true;
            });
        });
    </script>
</body>

</html>