<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
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

        .card-header {
            background-color: #3C5B9D;
            color: white;
            text-align: center;
            font-size: 1.5rem;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 15px;
            position: relative;
        }

        .back-button {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem;
            color: white;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #4A77D4;
            border: none;
            font-size: 1rem;
            font-weight: bold;
            padding: 10px;
        }

        .btn-primary:hover {
            background-color: #3C5B9D;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            font-size: 1rem;
            font-weight: bold;
            padding: 10px;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="card">
        <!-- Back Button inside the card header -->
        <div class="card-header">
            
            Change Password
        </div>
        <div class="card-body">
            <form action="<?php echo base_url('AdminPanel/change_password'); ?>" method="post">
                <div class="mb-3">
                    <label for="old_password" class="form-label">Old Password</label>
                    <input type="password" class="form-control" name="old_password" placeholder="Enter old password" required>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" name="new_password" placeholder="Enter new password" required>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm new password" required>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-50">Change Password</button>
                    <a href="<?php echo base_url(''); ?>" class="btn btn-secondary w-50">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
