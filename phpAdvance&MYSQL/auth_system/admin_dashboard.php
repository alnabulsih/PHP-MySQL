<?php
session_start();
require_once "user.php";

// Protect page
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit;
}

$userClass = new User();
$users = $userClass->allUsers(); // Get all registered users
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center">Admin Dashboard</h2>
    <a href="admin_logout.php" class="btn btn-danger mb-3">Logout</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>DOB</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $u): ?>
            <tr>
                <td><?= $u['id']; ?></td>
                <td><?= htmlspecialchars($u['full_name']); ?></td>
                <td><?= htmlspecialchars($u['email']); ?></td>
                <td><?= $u['mobile']; ?></td>
                <td><?= $u['dob']; ?></td>
                <td>
                    <a href="admin_edit.php?id=<?= $u['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="admin_delete.php?id=<?= $u['id']; ?>" class="btn btn-sm btn-danger" 
                       onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
