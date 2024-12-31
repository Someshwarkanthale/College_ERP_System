<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Course</title>
    <!-- CSS -->
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
            <!-- Page Area Start -->
            <div class="container mt-5">
                <h2>Add New Course</h2>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <?php echo validation_errors(); ?>

                <form action="<?php echo site_url('index.php/AdminPanel/add_course'); ?>" method="post">
                    <div class="form-group">
                        <label for="course_name">Course Name</label>
                        <input type="text" class="form-control" id="course_name" name="course_name" placeholder="Enter course name" required>
                    </div>
                    <div class="form-group">
                        <label for="fee">Course Fee</label>
                        <input type="number" class="form-control" id="fee" name="fee" placeholder="Enter course fee" step="0.01" required>
                    </div>
                    <div class="button-group">
                        <button type="submit" class="btn btn-primary">Add Course</button>
                        <button type="button" class="btn btn-secondary" onclick="history.back();">Cancel</button>
                    </div>
                </form>
            </div>
            <!-- Page Area End -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebarToggle = document.querySelector("#sidebar-toggle");
        sidebarToggle?.addEventListener("click", function() {
            document.querySelector("#sidebar")?.classList.toggle("collapsed");
        });
    </script>

</body>

</html>