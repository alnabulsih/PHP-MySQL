<?php
  session_start();
  require_once "user.php";

  $user = new User();
  $errors = [];

  if($_SERVER["REQUEST_METHOD"] === "POST"){
     // Sanitize inputs
     $full_name = trim($_POST['full_name']);
     $email = trim($_POST['email']);
     $mobile = trim($_POST['mobile']);
     $password = $_POST['password'];
     $confirm_password = $_POST['confirm_password'];
     $dob = $_POST['dob'];
  }

  // Backend Validation
  if(!preg_match("/^[a-zA-Z]+(?:\s[a-zA-Z]+){3}$/", $full_name)){
        $errors[] = "Full name must contain first, middle, last, family names.";
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Invalid email format.";
    }

    if(!preg_match("/^\d{14}$/", $mobile)){
        $errors[] = "Mobile must be 14 digits.";
    }

    if(strlen($password) < 8 ||
       !preg_match("/[A-Z]/", $password) ||
       !preg_match("/[a-z]/", $password) ||
       !preg_match("/[0-9]/", $password) ||
       !preg_match("/[\W]/", $password) ||
       preg_match("/\s/", $password)){
        $errors[] = "Password must be at least 8 characters with upper, lower, number, special char, no spaces.";
    }

    if($password !== $confirm_password){
        $errors[] = "Passwords do not match.";
    }

    // Check age >= 16
    $birthDate = new DateTime($dob);
    $Today = new DateTime();
    $age = $Today->diff($birthDate)->y;
    if($age<16){
      $errors[] = "You must be at least 16 years old to register.";
    }

       // If no errors, register user
    if(empty($errors)){
      $data=[
        'full_name' => $full_name,
            'email' => $email,
            'mobile' => $mobile,
            'password' => $password,
            'dob' => $dob
      ];
      $register = $user->register($data);
      if($register){
        $_SESSION['success'] = "Registration successful! You can now login.";
            header("Location: login.php");
            exit;
      }else{
        $errors[] = "Registration failed. Email may already exist.";
      }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 bg-white p-4 rounded shadow">
            <h2 class="text-center mb-4">Sign Up</h2>

            <?php if(!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach($errors as $error) echo "<li>$error</li>"; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" novalidate>
                <div class="mb-3">
                    <label>Full Name</label>
                    <input type="text" name="full_name" class="form-control" required placeholder="First Middle Last Family">
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Mobile</label>
                    <input type="text" name="mobile" class="form-control" required placeholder="14 digits">
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
                <p class="mt-3 text-center">Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>
</div>
</body>
</html>