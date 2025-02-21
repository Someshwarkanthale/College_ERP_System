<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Students Report</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" />

    <style>
       

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 95%;
        }

        h1 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8rem;
            color: #007bff;
        }

        .btn-group-custom {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 1rem;
        }

        table {
            background-color: #ffffff;
            border-collapse: collapse;
            width: 100%;
        }

        table th,
        table td {
            text-align: center;
            padding: 10px;
        }

        table thead {
            background-color: #343a40;
            color: #ffffff;
        }

        table tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
        }

        table tbody tr:hover {
            background-color: #e9ecef;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 1.5rem;
            }

            .btn {
                font-size: 0.9rem;
                padding: 8px 16px;
            }

            table th,
            table td {
                font-size: 0.9rem;
                padding: 8px;
            }
        }

        @media (max-width: 576px) {
            h1 {
                font-size: 1.2rem;
            }

            .btn-group-custom {
                flex-direction: column;
                gap: 10px;
            }

            .btn {
                font-size: 0.85rem;
            }

            table th,
            table td {
                font-size: 0.8rem;
                padding: 6px;
            }
        }
        /* Tablet View (Landscape and Portrait) */
@media (max-width: 992px) {
    /* Container adjustments for padding */
    .container {
        padding: 15px;
    }

    /* Table responsiveness */
    table {
        display: block;
        width: 100%;
        overflow-x: auto;
        white-space: nowrap;
    }

    /* Adjust button sizes */
    .btn {
        font-size: 0.9rem;
        padding: 8px 16px;
    }

    /* Flex wrapping for Actions */
    td form, td a {
        display: block;
        margin-bottom: 5px;
    }
}

/* Mobile View */
@media (max-width: 576px) {
    /* Heading size reduction */
    h1 {
        font-size: 1.4rem;
    }

    /* Button adjustments */
    .btn-group-custom {
        flex-direction: column;
        gap: 10px;
    }

    /* Table scroll */
    table {
        display: block;
        width: 100%;
        overflow-x: auto;
    }

    table th,
    table td {
        white-space: nowrap;
        text-align: left;
        font-size: 0.8rem;
        padding: 6px;
    }

    /* Actions stacking */
    td form,
    td a {
        display: block;
        width: 100%;
        margin-bottom: 5px;
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
                <h1>Student List</h1>
                <br>
                <form method="get" action="<?php echo site_url('AdminPanel/Studentlist'); ?>" class="mb-3">
                    <div class="input-group row mx-auto">
                        <input type="text" id="search-input" name="search" placeholder="Search by name, category, or course"
                            class="form-control col-lg-10 col-md-8 col-sm-8 col-12" autocomplete="off"  >
                            
                        <button type="submit" class="btn btn-primary col-lg-2 col-md-4 col-sm-4 col-12" >Search</button>
                    </div>
                    <div id="suggestions" class="list-group position-absolute w-100" style="z-index: 1000; max-height: 200px; overflow-y: auto; display: none;">
                        <!-- Suggestions will be appended here -->
                    </div>
                </form>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Course Name</th>
                            <th>Category</th>
                            <th>Total Fee</th>
                            <th>Paid Fee</th>
                            <th>Remaining Fee</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $index => $student): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo $student->student_name; ?></td>
                                <td><?php echo $student->course_name; ?></td>
                                <td><?php echo $student->category; ?></td>
                                <td><?php echo number_format($student->total_fee, 2); ?></td>
                                <td><?php echo number_format($student->paid_fee, 2); ?></td>
                                <td><?php echo number_format($student->remaining_fee, 2); ?></td>
                                <td>
                                    <form action="<?php echo site_url('AdminPanel/pay_fee_form/' . $student->id); ?>" method="get" class="d-inline">
                                        <button type="submit" class="btn btn-success btn-sm">Pay Fee</button>
                                    </form>
                                    <a href="<?php echo site_url('AdminPanel/edit_student/' . $student->id); ?>"
                                        class="btn btn-warning btn-sm">Update</a>
                                    <a href="<?php echo site_url('AdminPanel/delete/' . $student->id); ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this student?');">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!--page area end-->
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const sidebarToggle = document.querySelector("#sidebar-toggle");
        sidebarToggle.addEventListener("click", function() {
            document.querySelector("#sidebar").classList.toggle("collapsed");
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        const $searchInput = $('#search-input');
        const $suggestions = $('#suggestions');

        $searchInput.on('input', function () {
            const query = $(this).val().trim();

            if (query.length >= 2) {
                // AJAX request to fetch suggestions
                $.ajax({
                    url: "<?php echo site_url('AdminPanel/getSuggestions'); ?>",
                    type: "GET",
                    data: { search: query },
                    success: function (response) {
                        const results = JSON.parse(response); // Assuming the server returns JSON
                        $suggestions.empty();

                        if (results.length > 0) {
                            results.forEach(item => {
                                $suggestions.append(`
                                    <a href="#" class="list-group-item list-group-item-action">${item.name}</a>
                                `);
                            });
                            $suggestions.show();
                        } else {
                            $suggestions.hide();
                        }
                    },
                    error: function () {
                        console.error('Error fetching suggestions');
                        $suggestions.hide();
                    }
                });
            } else {
                $suggestions.hide();
            }
        });

        // Handle suggestion click
        $suggestions.on('click', '.list-group-item', function (e) {
            e.preventDefault();
            $searchInput.val($(this).text());
            $suggestions.hide();
        });

        // Hide suggestions when clicking outside
        $(document).on('click', function (e) {
            if (!$(e.target).closest('#search-input, #suggestions').length) {
                $suggestions.hide();
            }
        });
    });
</script>
</body>

</html>