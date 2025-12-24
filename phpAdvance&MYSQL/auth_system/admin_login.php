<?php
session_start();
require_once "user.php";

$errors = [];

// Hardcoded superuser credentials (you can also store in DB)
$adminEmail = "admin@example.com";
$adminPassword = "Admin@123"; // Change to a strong password

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if($email === $adminEmail && $password === $adminPassword){
        $_SESSION['admin'] = true;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $errors[] = "Invalid admin credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5 bg-white p-4 rounded shadow">
            <h2 class="text-center mb-4">Admin Login</h2>

            <?php if(!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?= implode("<br>", $errors); ?>
                </div>
            <?php endif; ?>

            <form method="POST" novalidate>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
