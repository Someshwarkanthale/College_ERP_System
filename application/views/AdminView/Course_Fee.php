<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Courses & Fees</title>
    <!--css-->
    <style>
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
       
        h1 {
            font-weight: bold;
            color: #333;
        }

        .btn-custom {
            margin-right: 10px;
        }

        table th,
        table td {
            text-align: center;
            padding: 50px;
        }

        .btn-group-custom {
            margin-bottom: 20px;
        }

        .table thead {
            background-color: #343a40;
            color: white;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .card {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
        }

        .btn {
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: rgb(42, 109, 181);
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-warning {
            background-color: rgb(42, 109, 181);
        }

        .btn-warning:hover {
            background-color: #0d6efd;
        }

        .btn-danger {
            background-color: #e63946;
        }

        .btn-danger:hover {
            background-color: #d62828;
        }

        /* Media Queries */
        @media (max-width: 992px) {
            h1 {
                font-size: 1.5rem;
                text-align: center;
            }

            .btn-custom {
                width: 100%;
                margin-bottom: 10px;
            }

            .table th,
            .table td {
                font-size: 0.9rem;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.25rem;
            }

            .table {
                font-size: 0.85rem;
            }

            .card {
                padding: 10px;
            }
        }

        @media (max-width: 576px) {
            .btn {
                font-size: 0.8rem;
                padding: 5px 10px;
            }

            .table {
                font-size: 0.8rem;
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
            <div class="container mt-5 ">
                <h1 class="text-center">Courses List</h1>
                <div class="card">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Course Name</th>
                            <th>Fee</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sr_no = 1; // Initialize serial number
                        foreach ($courses as $course): ?>
                            <tr>
                                <td><?php echo $sr_no++; ?></td>
                                <td><?php echo $course->course_name; ?></td>
                                <td><?php echo number_format($course->fee, 2); ?></td>
                                <td>
                                    <a href="<?php echo site_url('index.php/AdminPanel/update_course/' . $course->id); ?>" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <a href="<?php echo site_url('index.php/AdminPanel/delete_course/' . $course->id); ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this course?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <a href="<?php echo site_url('index.php/AdminPanel/add_course_form'); ?>" class="btn btn-primary btn-custom">Add New Course</a>
                    </div>
                </div>
                </div>
                
            </div>

            <!-- Additional Fees Section -->
            <div class="container mt-5 ">
                <h1 class="text-center">Additional Fees</h1>
                <div class="card">

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Department</th>
                            <th>Fee</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sr_no = 1; // Initialize serial number for additional fees
                        foreach ($additional_fees as $fee): ?>
                            <tr>
                                <td><?php echo $sr_no++; ?></td>
                                <td><?php echo $fee->department; ?></td>
                                <td><?php echo number_format($fee->fee, 2); ?></td>
                                <td>
                                    <a href="<?php echo site_url('index.php/AdminPanel/Upadate_additional_fee_form/' . $fee->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?php echo site_url('index.php/AdminPanel/delete_additional_fee/' . $fee->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this additional fee?');">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <a href="<?php echo site_url('index.php/AdminPanel/add_additional_fee_form'); ?>" class="btn btn-primary">Add Additional Fee</a>
                    </div>
                </div>
                </div>
                
            </div>

            <!-- Course Details Section -->
            <div class="container mt-5 ">
                <h1 class="text-center">Course Fee Details</h1> 
                <?php foreach ($courses as $course): ?>
                    <div class="card">
                        <h4 style="text-align:center;"><?php echo $course->course_name; ?></h4>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Fee</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sr_no = 1; // Initialize serial number for course details
                                if (!empty($course_data[$course->course_name])): ?>
                                    <?php foreach ($course_data[$course->course_name] as $data): ?>
                                        <tr>
                                            <td><?php echo $sr_no++; ?></td>
                                            <td><?php echo $data->category; ?></td>
                                            <td><?php echo number_format($data->fee, 2); ?></td>
                                            <td>
                                                <a href="<?php echo site_url('index.php/AdminPanel/update_Category_form/' . $course->course_name . '/' . $data->id); ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="<?php echo site_url('index.php/AdminPanel/delete_Category/' . $course->course_name . '/' . $data->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">No data available for this course.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <a href="<?php echo site_url('index.php/AdminPanel/add_Category_form/' . $course->course_name); ?>" class="btn btn-primary">Add Category</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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

</body>

</html>