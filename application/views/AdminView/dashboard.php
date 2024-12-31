<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <!--css-->
    <style>
        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin: 15px;
        }
        .card1{
            margin-top: 20px;

        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            font-weight: bold;
            font-size: 1.2rem;
            text-align: center;
        }

        .card-body {
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
        }

        .bg-primary-gradient {
            background: linear-gradient(135deg, rgb(85, 96, 213), rgb(118, 224, 219));
            color: white;
        }

        .bg-info-gradient {
            background: linear-gradient(135deg, rgb(85, 96, 213), rgb(118, 224, 219));
            color: white;
        }

        .bg-success-gradient {
            background: linear-gradient(135deg, rgb(85, 96, 213), rgb(118, 224, 219));
            color: white;
        }

        .bg-warning-gradient {
            background: linear-gradient(135deg, rgb(85, 96, 213), rgb(118, 224, 219));
            color: white;
        }

        .count-up {
            font-size: 2.5rem;
            font-weight: bold;
            color: #343a40;
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
                <!-- Top Section: Total Students and Total Courses -->
                <div class="row" style="margin-top:-30px;">
                    <div class="col-md-6">
                        <div class="card bg-primary-gradient text-white">
                            <div class="card-header">
                                <i class="fas fa-users icon"></i> Total Students
                            </div>
                            <div class="card-body count-up" id="totalStudents" data-count="<?php echo $total_students; ?>">0</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card bg-info-gradient text-white">
                            <div class="card-header">
                                <i class="fas fa-book-open icon"></i> Total Courses
                            </div>
                            <div class="card-body count-up" id="totalCourses" data-count="<?php echo $total_courses; ?>">0</div>
                        </div>
                    </div>
                </div>
                <br>
                <!-- Each Course in a Separate Card -->
                <div class="row">
                    <?php foreach ($course_wise_counts as $course): ?>
                        <div class="col-md-4">
                            <div class="card bg-success-gradient text-white">
                                <div class="card-header">
                                    <i class="fas fa-book icon"></i> <?php echo htmlspecialchars($course->course_name); ?>
                                </div>
                                <div class="card-body count-up" data-count="<?php echo intval($course->count); ?>">
                                    0
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Category-wise Section -->
                <div class="row mt-4">
                    <?php foreach ($category_wise_counts as $category): ?>
                        <div class="col-md-4">
                            <div class="card bg-warning-gradient text-white">
                                <div class="card-header">
                                    <i class="fas fa-tags icon"></i> <?php echo htmlspecialchars($category->category); ?>
                                </div>
                                <div class="card-body count-up" data-count="<?php echo intval($category->count); ?>">
                                    0
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>




            <!--page area end-->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebarToggle = document.querySelector("#sidebar-toggle");
        sidebarToggle.addEventListener("click", function() {
            document.querySelector("#sidebar").classList.toggle("collapsed");
        });
    </script>
    <script>
        // Animate counters function
        function animateCounter(element, target) {
            let count = 0;
            const speed = 50; // Speed of the animation
            const increment = Math.ceil(target / 100); // Increment based on target

            const interval = setInterval(() => {
                count += increment;
                if (count >= target) {
                    count = target;
                    clearInterval(interval);
                }
                element.textContent = count;
            }, speed);
        }

        $(document).ready(function() {
            // Animate total students and courses
            const totalStudents = parseInt($('#totalStudents').data('count'), 10);
            const totalCourses = parseInt($('#totalCourses').data('count'), 10);

            animateCounter(document.getElementById('totalStudents'), totalStudents);
            animateCounter(document.getElementById('totalCourses'), totalCourses);
        });
    </script>
     <script>
        // Animate counters
        function animateCounter(element, target) {
            let count = 0;
            const speed = 50; // Speed of the animation
            const increment = Math.ceil(target / 100); // Increment based on target

            const interval = setInterval(() => {
                count += increment;
                if (count >= target) {
                    count = target;
                    clearInterval(interval);
                }
                element.textContent = count;
            }, speed);
        }

        $(document).ready(function() {
            // Animate total students and courses
            animateCounter(document.getElementById('totalStudents'), <?php echo intval($total_students); ?>);
            animateCounter(document.getElementById('totalCourses'), <?php echo intval($total_courses); ?>);

            // Animate each category's student count
            $('.count-up').each(function() {
                const target = parseInt($(this).data('count'), 10);
                animateCounter(this, target);
            });
        });
    </script>
</body>

</html>