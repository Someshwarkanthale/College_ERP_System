<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Registration</title>

    <!--css-->
    <style>
        
           .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 0px 0 50px 0;
            max-width: 600px;
            margin: 20px auto;
        }

        h2 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 20px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-control[readonly] {
            background-color: #f8f9fa;
            color: #495057;
        }

        .btn-block {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            background-color: #28a745;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-block:hover {
            background-color: #218838;
        }

        .additional-fees {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f1f1f1;
        }

        .additional-fees h4 {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .additional-fees .form-check {
            margin-bottom: 10px;
        }

        .additional-fees .form-check-input {
            margin-right: 10px;
            position: relative;
            top: 1px;
        }

        .additional-fees .form-check-label {
            font-size: 1rem;
            color: #555;
        }

        .additional-fees .form-check-label:hover {
            color: #007bff;
            cursor: pointer;
        }

        #total_fee {
            font-weight: bold;
            font-size: 1.25rem;
            color: #007bff;
            margin-top: 10px;
            padding: 5px;
            background-color: #e9f7fe;
            border-radius: 4px;
            border: 1px solid #007bff;
        }

        #loading_indicator {
            display: none;
            font-size: 1rem;
            color: #007bff;
            text-align: center;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h2 {
                font-size: 1.5rem;
            }

            .form-control {
                font-size: 0.9rem;
            }

            #total_fee {
                font-size: 1rem;
                padding: 10px;
            }
        }

        @media (max-width: 576px) {
            h2 {
                font-size: 1.25rem;
            }

            .btn-block {
                font-size: 0.9rem;
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
            <div class="container mt-2 p-5">
                <h2>Student Registration</h2>

                <!-- Loading Indicator -->
                <div id="loading_indicator">Loading...</div>


                <!-- Registration Form -->
                <form class="form-S" action="<?php echo site_url('AdminPanel/add_student'); ?>" method="POST" onsubmit="return validateForm();">
                    <div class="form-group">
                        <label for="name">Student Name:</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter student name" required>
                    </div>

                    <div class="form-group">
                        <label for="course">Course:</label>
                        <select name="course" id="course" class="form-control" onchange="fetchCategories(this.value)" required>
                            <option value="">Select Course</option>
                            <?php foreach ($courses as $course): ?>
                                <option value="<?php echo $course->course_name; ?>"><?php echo $course->course_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select name="category" id="category" class="form-control" onchange="fetchFee($('#course').val(), this.value)" required>
                            <option value="">Select Category</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fee">Fee:</label>
                        <input type="text" name="fee" id="fee" class="form-control" readonly required>
                    </div>

                    <!-- Additional Fees Section -->
                    <div class="additional-fees">
                        <h4>Additional Fees</h4>
                        <?php foreach ($additional_fees as $fee): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="additional_fees[]" value="<?php echo $fee->id; ?>" data-fee="<?php echo $fee->fee; ?>" onclick="calculateTotalFee()">
                                <label class="form-check-label">
                                    <?php echo $fee->department; ?> - <?php echo number_format($fee->fee, 2); ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Total Fee -->
                    <div class="form-group">
                        <label for="total_fee">Total Fee:</label>
                        <p id="total_fee">0.00</p>
                    </div>
                    <div class="button-group">
                        <button type="submit" class="btn btn-primary">Register Student</button>
                        <button type="button" class="btn btn-secondary" onclick="history.back();">Cancel</button>
                    </div>
                </form>
            </div>

            <!--page area end-->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        // Fetch categories based on selected course
        function fetchCategories(course_name) {
            $('#category').prop('disabled', true); // Disable the category dropdown during loading
            $('#loading_indicator').show(); // Show the loading indicator

            $.ajax({
                url: "<?php echo site_url('AdminPanel/fetch_categories'); ?>",
                method: "POST",
                data: {
                    course_name: course_name
                },
                success: function(response) {
                    var categories = JSON.parse(response);
                    var category_select = $('#category');
                    category_select.empty(); // Clear previous options

                    // Add default option
                    category_select.append('<option value="">Select Category</option>');

                    // Populate categories dropdown
                    categories.forEach(function(category) {
                        category_select.append('<option value="' + category.category + '">' + category.category + '</option>');
                    });

                    $('#category').prop('disabled', false); // Enable category dropdown
                    $('#loading_indicator').hide(); // Hide the loading indicator
                }
            });
        }

        // Fetch fee based on selected course and category
        function fetchFee(course_name, category) {
            $('#loading_indicator').show(); // Show the loading indicator

            $.ajax({
                url: "<?php echo site_url('AdminPanel/fetch_fee'); ?>",
                method: "POST",
                data: {
                    course_name: course_name,
                    category: category
                },
                success: function(response) {
                    var fee = JSON.parse(response);
                    $('#fee').val(fee[0].fee); // Set the base fee
                    calculateTotalFee(); // Recalculate total fee
                    $('#loading_indicator').hide(); // Hide the loading indicator
                }
            });
        }

        // Calculate total fee including additional fees
        function calculateTotalFee() {
            var baseFee = parseFloat($('#fee').val()) || 0;
            var totalFee = baseFee;

            // Add selected additional fees
            $('input[name="additional_fees[]"]:checked').each(function() {
                totalFee += parseFloat($(this).data('fee'));
            });

            // Update total fee display
            $('#total_fee').text(totalFee.toFixed(2));
        }

        // Form validation before submission
        function validateForm() {
            var name = $('#name').val().trim();

            // Regular expression to validate name (only letters and spaces, minimum 2 characters)
            var nameRegex = /^[A-Za-z\s]{2,}$/;

            if (!nameRegex.test(name)) {
                alert('Please enter a valid name (minimum 2 letters, no numbers or symbols).');
                return false;
            }

            var course = $('#course').val();
            var category = $('#category').val();
            var fee = $('#fee').val();

            if (!course || !category || !fee) {
                alert('Please fill in all required fields.');
                return false;
            }

            return true;
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