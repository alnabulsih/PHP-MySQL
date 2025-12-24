<?php
  require_once "database.php";

  $db = new Database();
  $conn = $db->conn;

  if($_SERVER ["REQUEST_METHOD"] === "POST"){

    $name = ($_POST['name']);
    $email = ($_POST['email']);

    $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
      ":name" => $name,
      ":email" => $email
    ]);
  header("Location: index.php");
  exit;
  }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
</head>
<body>

<h2>Create User</h2>

<form method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <button type="submit">Save</button>
</form>

<a href="index.php">⬅ Back</a>

</body>
</html>
