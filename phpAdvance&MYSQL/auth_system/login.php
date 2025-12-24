<?php
session_start();
require_once "user.php";

$user = new User();
$errors = [];

if($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Basic validation
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Please enter a valid email.";
    }

    if(empty($password)){
        $errors[] = "Please enter your password.";
    }

    // If no errors, attempt login
    if(empty($errors)){
        $loggedInUser = $user->login($email, $password); // Your login() function checks email & hashed password

        if($loggedInUser){
            // Store user info in session
            $_SESSION['user'] = [
                'id' => $loggedInUser['id'],
                'full_name' => $loggedInUser['full_name'],
                'email' => $loggedInUser['email']
            ];
            // Optionally store last login timestamp in DB here

            header("Location: welcome.php");
            exit;
        } else {
            $errors[] = "Invalid email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5 bg-white p-4 rounded shadow">
            <h2 class="text-center mb-4">Login</h2>

            <?php if(!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach($errors as $error) echo "<li>$error</li>"; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if(!empty($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <form method="POST" novalidate>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required 
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <p class="mt-3 text-center">Don't have an account? <a href="signup.php">Sign Up</a></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>
