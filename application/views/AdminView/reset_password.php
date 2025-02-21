<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"></script>
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
            background-color: white;
            padding: 20px;
            position: relative;
        }

        .back-button {
            position: absolute;
            top: 15px;
            left: 15px;
            background: none;
            border: none;
            font-size: 1.2rem;
            color: white;
            cursor: pointer;
        }

        .card-header {
            background-color: #3C5B9D;
            color: white;
            text-align: center;
            font-size: 1.5rem;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 15px;
        }

        .btn-primary, .btn-secondary {
            width: 48%; /* Ensures both buttons have the same width */
            font-size: 1rem;
            font-weight: bold;
            padding: 10px;
            border: none;
            text-align: center;
        }

        .btn-primary {
            background-color: #4A77D4;
        }

        .btn-primary:hover {
            background-color: #3C5B9D;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            gap: 5px; /* Adds spacing between buttons */
        }

    </style>
</head>
<body>
    <div class="card">
       
        <div class="card-header">Reset Password</div>
        <div class="card-body">
            <form action="<?php echo base_url('AdminPanel/reset_password/' . $this->uri->segment(3)); ?>" method="post">
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" name="new_password" placeholder="Enter new password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm new password" required>
                </div>
                <button type="submit" class="btn btn-primary">Reset Password</button>
                <a href="<?php echo base_url(''); ?>" class="btn btn-secondary">Cancel</a>

            </form>
        </div>
    </div>
</body>
</html>
