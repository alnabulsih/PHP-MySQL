<?php
  require_once "database.php";

  $db = new Database;
  $conn = $db->conn;

  /* 1 Get ID from URL */
  $id = $_GET['id'] ?? null;
  if(!$id){
    header("Location: index.php");
    exit;
  }

  /* 2️ Fetch user data */
  $sql = "SELECT * FROM users WHERE id = :id";
  $stmt = $conn->prepare($sql);
  $stmt->execute([":id"=>$id]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if(!$user){
    header("Location: index.php");
    exit;
  }

  /* 3️ Update user */
   if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    $sql = "UPDATE users 
            SET name = :name, email = :email
            WHERE id = :id";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
      ":name" => $name,
      ":email" => $email,
      ":id" => $id
    ]);

    header("Location: index.php");
    exit;
  }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<h2>Edit User</h2>

<form method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>

    <button type="submit">Update</button>
</form>

<a href="index.php">⬅ Back</a>

</body>
</html>

