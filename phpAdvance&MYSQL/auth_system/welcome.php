<?php
session_start();

// Redirect to login if user is not logged in
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

// Get user info from session
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Welcome</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 bg-white p-4 rounded shadow text-center">
            <h2>Welcome, <?= htmlspecialchars($user['full_name']); ?>!</h2>
            <p class="lead">Your email: <?= htmlspecialchars($user['email']); ?></p>
            
            <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
        </div>
    </div>
</div>
</body>
</html>
