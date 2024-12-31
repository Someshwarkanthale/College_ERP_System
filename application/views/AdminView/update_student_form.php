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
            padding: 20px;
        }

        h2 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-group-custom {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
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
            font-weight: normal;
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

        .form-control[readonly] {
            background-color: #f8f9fa;
            color: #495057;
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
        <h2 class="text-center">Update Student</h2>

        <form action="<?php echo site_url('index.php/AdminPanel/update_student'); ?>" method="post" onsubmit="return validateForm();">
            <input type="hidden" name="id" value="<?php echo $student->id; ?>">

            <div class="form-group">
                <label for="student_name">Student Name</label>
                <input type="text" name="student_name" id="student_name" class="form-control" value="<?php echo $student->student_name; ?>"
                    pattern="^[A-Za-z\s]+$" minlength="3" title="Only letters and spaces are allowed. Minimum 3 characters." required>
            </div>


            <div class="form-group">
                <label for="course">Course:</label>
                <select name="course" id="course" class="form-control" onchange="fetchCategories(this.value)" required>
                    <option value="">Select Course</option>
                    <?php foreach ($courses as $course): ?>
                        <option value="<?php echo $course->course_name; ?>"
                            <?php echo $student->course_name == $course->course_name ? 'selected' : ''; ?>>
                            <?php echo $course->course_name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category" id="category" class="form-control" onchange="fetchFee($('#course').val(), this.value)" required>
                    <option value="">Select Category</option>
                    <?php if (isset($student->category)): ?>
                        <option value="<?php echo $student->category; ?>" selected>
                            <?php echo $student->category; ?>
                        </option>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="total_fee">Total Fee</label>
                <input type="number" step="0.01" name="total_fee" id="total_fee" class="form-control" value="<?php echo $student->total_fee; ?>" required>
            </div>

            <div class="form-group">
                <label for="paid_fee">Paid Fee</label>
                <input type="number" step="0.01" name="paid_fee" id="paid_fee" class="form-control" value="<?php echo $student->paid_fee; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="<?php echo site_url('Courses/list'); ?>" class="btn btn-secondary">Cancel</a>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        // Fetch categories based on selected course
        function fetchCategories(course_name) {
            $('#category').prop('disabled', true); // Disable the category dropdown during loading
            $('#loading_indicator').show(); // Show the loading indicator

            $.ajax({
                url: "<?php echo site_url('courses/fetch_categories'); ?>",
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

                    if (categories && categories.length > 0) {
                        // Populate categories dropdown
                        categories.forEach(function(category) {
                            category_select.append('<option value="' + category.category + '">' + category.category + '</option>');
                        });
                        $('#category').prop('disabled', false); // Enable category dropdown
                    } else {
                        category_select.append('<option value="">No categories available</option>');
                    }

                    $('#loading_indicator').hide(); // Hide the loading indicator
                },
                error: function() {
                    $('#loading_indicator').hide(); // Hide loading if AJAX fails
                    alert("Error fetching categories.");
                }
            });
        }

        // Fetch fee based on selected course and category
        function fetchFee(course_name, category) {
            $('#loading_indicator').show(); // Show the loading indicator

            $.ajax({
                url: "<?php echo site_url('courses/fetch_fee'); ?>",
                method: "POST",
                data: {
                    course_name: course_name,
                    category: category
                },
                success: function(response) {
                    var fee = JSON.parse(response);
                    if (fee && fee.length > 0) {
                        $('#fee').val(fee[0].fee); // Set the base fee
                        calculateTotalFee(); // Recalculate total fee
                    } else {
                        $('#fee').val(''); // Clear fee if not found
                        alert("Fee details not found.");
                    }
                    $('#loading_indicator').hide(); // Hide the loading indicator
                },
                error: function() {
                    $('#loading_indicator').hide(); // Hide loading if AJAX fails
                    alert("Error fetching fee.");
                }
            });
        }

        // Validate the form
        function validateForm() {
            var studentName = $('#student_name').val().trim();
            var courseName = $('#course_name').val().trim();
            var category = $('#category').val().trim();
            var totalFee = parseFloat($('#total_fee').val());
            var paidFee = parseFloat($('#paid_fee').val());

            // Validate student name (minimum 3 characters, only letters and spaces)
            var nameRegex = /^[A-Za-z\s]{3,}$/; // Allows only letters and spaces, and at least 3 characters
            if (studentName === "") {
                alert("Student Name is required.");
                $('#student_name').focus();
                return false;
            } else if (!nameRegex.test(studentName)) {
                alert("Student Name must contain only letters and spaces, and be at least 3 characters long.");
                $('#student_name').focus();
                return false;
            }

            // Validate course name
            if (courseName === "") {
                alert("Course Name is required.");
                $('#course_name').focus();
                return false;
            }

            // Validate category
            if (category === "") {
                alert("Category is required.");
                $('#category').focus();
                return false;
            }

            // Validate total fee
            if (isNaN(totalFee) || totalFee <= 0) {
                alert("Please enter a valid Total Fee greater than 0.");
                $('#total_fee').focus();
                return false;
            }

            // Validate paid fee
            if (isNaN(paidFee) || paidFee < 0) {
                alert("Please enter a valid Paid Fee (it cannot be negative).");
                $('#paid_fee').focus();
                return false;
            }

            // Check if paid fee exceeds total fee
            if (paidFee > totalFee) {
                alert("Paid Fee cannot exceed Total Fee.");
                $('#paid_fee').focus();
                return false;
            }

            return true;
        }
    </script>

</body>

</html>