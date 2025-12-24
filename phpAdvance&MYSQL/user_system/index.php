<?php
  require_once "database.php";

  $db = new Database();
  $conn = $db->conn;

  $sql = "SELECT * FROM users ORDER BY id DESC";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>User System</title>
</head>
<body>

<h2>User List</h2>

<a href="create.php">➕ Create User</a>
<br><br>

<table border="1" cellpadding="10">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Actions</th>
  </tr>

  <?php foreach ($users as $user): ?>
  <tr>
    <td><?= $user['id']; ?></td>
    <td><?= htmlspecialchars($user['name']); ?></td>
    <td><?= htmlspecialchars($user['email']); ?></td>
    <td>
      <a href="edit.php?id=<?= $user['id']; ?>">✏ Edit</a> |
      <a href="delete.php?id=<?= $user['id']; ?>" 
         onclick="return confirm('Are you sure?')">🗑 Delete</a>
    </td>
  </tr>
  <?php endforeach; ?>

</table>

</body>
</html>