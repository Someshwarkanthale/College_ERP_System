<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #3C5B9D, #4A77D4);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        .card {
            width: 100%;
            max-width: 400px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .card-header {
            background-color: #3C5B9D;
            color: white;
            text-align: center;
            font-size: 1.5rem;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .btn-primary {
            background-color: #4A77D4;
            border: none;
        }

        .btn-primary:hover {
            background-color: #3C5B9D;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            Login
        </div>
        <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <form action="<?php echo base_url('AdminPanel/check_login'); ?>" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <div class="text-center mt-3">
    <a href="<?php echo base_url('AdminPanel/forgot_password'); ?>"  class="text">Forgot Password?</a> |
    <a href="<?php echo base_url('AdminPanel/change_password'); ?>" class="text">Change Password</a>
</div>

                
            </form>
        </div>
    </div>
</body>

</html>