<?php
session_start();
require_once "user.php";

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit;
}

$userClass = new User();
$errors = [];

if(!isset($_GET['id'])){
    header("Location: admin_dashboard.php");
    exit;
}

$id = intval($_GET['id']);
$userData = $userClass->allUsers();
$userData = array_filter($userData, fn($u) => $u['id'] == $id);
$userData = array_values($userData)[0] ?? null;

if(!$userData){
    header("Location: admin_dashboard.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $mobile = trim($_POST['mobile']);
    $dob = $_POST['dob'];

    if(!preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+){3}$/", $full_name)){
        $errors[] = "Full name must contain 4 names.";
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Invalid email format.";
    }

    if(!preg_match("/^\d{14}$/", $mobile)){
        $errors[] = "Mobile must be 14 digits.";
    }

    if(empty($errors)){
        $data = [
            'full_name' => $full_name,
            'email' => $email,
            'mobile' => $mobile,
            'dob' => $dob
        ];

        $userClass->update($id, $data);
        header("Location: admin_dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit User</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 bg-white p-4 rounded shadow">
            <h2 class="text-center mb-4">Edit User</h2>

            <?php if(!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?= implode("<br>", $errors); ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label>Full Name</label>
                    <input type="text" name="full_name" class="form-control" required 
                           value="<?= htmlspecialchars($_POST['full_name'] ?? $userData['full_name']); ?>">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required
                           value="<?= htmlspecialchars($_POST['email'] ?? $userData['email']); ?>">
                </div>
                <div class="mb-3">
                    <label>Mobile</label>
                    <input type="text" name="mobile" class="form-control" required
                           value="<?= htmlspecialchars($_POST['mobile'] ?? $userData['mobile']); ?>">
                </div>
                <div class="mb-3">
                    <label>DOB</label>
                    <input type="date" name="dob" class="form-control" required
                           value="<?= htmlspecialchars($_POST['dob'] ?? $userData['dob']); ?>">
                </div>
                <button type="submit" class="btn btn-primary w-100">Update User</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
