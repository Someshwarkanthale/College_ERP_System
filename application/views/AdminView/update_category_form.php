<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Edit Data</title>
    <!--css-->
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
                <h2>Edit Data for <?php echo $course_name; ?></h2>
                <form action="<?php echo site_url('index.php/AdminPanel/update_Category'); ?>" method="post" onsubmit="return validateForm();">
                    <input type="hidden" name="course_name" value="<?php echo $course_name; ?>">
                    <input type="hidden" name="id" value="<?php echo $record->id; ?>">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" name="category" class="form-control" value="<?php echo $record->category; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="fee">Fee</label>
                        <input type="number" name="fee" class="form-control" step="0.01" value="<?php echo $record->fee; ?>" required>
                    </div>
                    <div class="button-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" onclick="history.back();">Cancel</button>
                    </div>                
                </form>
            </div>




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
        // JavaScript function to validate the form
        function validateForm() {
            var category = document.getElementsByName('category')[0].value;
            var fee = document.getElementsByName('fee')[0].value;
            var errorMessages = "";

            // Validate Category (should not be empty and first two characters should be alphabetic)
            if (category === "") {
                errorMessages += "Category is required.\n";
            } else if (!/^[a-zA-Z]{2}/.test(category)) { // Check if the first two characters are alphabetic
                errorMessages += "Category must start with two alphabetic characters.\n";
            }

            // Validate Fee (should be a positive number)
            if (fee === "" || fee <= 0) {
                errorMessages += "Fee must be a positive number.\n";
            }

            // If there are any errors, show an alert and return false
            if (errorMessages !== "") {
                alert(errorMessages);
                return false; // Prevent form submission
            }

            return true; // Allow form submission
        }
    </script>

</body>

</html>