<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Add category to Course</title>
    <!--css-->
    <style>
        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #ffffff;
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
                <h2>Add Data to <?php echo htmlspecialchars($course_name, ENT_QUOTES, 'UTF-8'); ?></h2>
                <form action="<?php echo site_url('index.php/AdminPanel/add_Category'); ?>" method="post" onsubmit="return validateForm();">
                    <input type="hidden" name="course_name" value="<?php echo htmlspecialchars($course_name, ENT_QUOTES, 'UTF-8'); ?>">

                    <!-- Category field with real-time validation -->
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <input type="text" name="category" id="category" class="form-control" required>
                        <small id="categoryError" class="form-text text-danger"></small>
                    </div>

                    <!-- Fee field with real-time validation -->
                    <div class="form-group">
                        <label for="fee">Fee:</label>
                        <input type="number" name="fee" id="fee" class="form-control" required step="0.01">
                        <small id="feeError" class="form-text text-danger"></small>
                    </div>
                    <div class="button-group">
                        <button type="submit" class="btn btn-primary">Add Data</button>
                        <button type="button" class="btn btn-secondary" onclick="history.back();">Cancel</button>
                    </div>



                </form>
                <!--page area end-->
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            const sidebarToggle = document.querySelector("#sidebar-toggle");
            sidebarToggle.addEventListener("click", function() {
                document.querySelector("#sidebar").classList.toggle("collapsed");
            });
        </script>
        <script>
            // JavaScript function for real-time validation
            function validateCategory() {
                var category = document.getElementById('category').value;
                var categoryError = document.getElementById('categoryError');

                // Check if the category is at least 3 characters long and starts with two alphabets
                var categoryRegex = /^[A-Za-z]{2,}/;
                if (!categoryRegex.test(category)) {
                    categoryError.textContent = "Category must be at least 3 characters long and start with two alphabets.";
                } else {
                    categoryError.textContent = "";
                }
            }

            function validateFee() {
                var fee = document.getElementById('fee').value;
                var feeError = document.getElementById('feeError');

                // Check if the fee is a positive number
                if (fee === "" || fee <= 0 || isNaN(fee)) {
                    feeError.textContent = "Fee must be a positive number.";
                } else {
                    feeError.textContent = "";
                }
            }

            // Function to check form submission validity
            function validateForm() {
                var categoryError = document.getElementById('categoryError').textContent;
                var feeError = document.getElementById('feeError').textContent;
                if (categoryError || feeError) {
                    return false; // Prevent form submission if there are validation errors
                }
                return true;
            }

            // Add event listeners for real-time validation
            window.onload = function() {
                document.getElementById('category').addEventListener('input', validateCategory);
                document.getElementById('fee').addEventListener('input', validateFee);
            };
        </script>

</body>

</html>