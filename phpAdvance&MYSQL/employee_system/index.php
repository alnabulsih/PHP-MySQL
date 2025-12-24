<?php
require_once 'config.php';

// Fetch all employees
$stmt = $pdo->query("SELECT * FROM Employees ORDER BY id DESC");
$employees = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employees List</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: auto; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        a { text-decoration: none; margin: 0 5px; }
        .create-btn { margin: 20px auto; display: block; text-align: center; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Employees List</h2>

<div class="create-btn">
    <a href="create.php">➕ Add New Employee</a>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Address</th>
        <th>Salary</th>
        <th>Actions</th>
    </tr>
    <?php foreach($employees as $emp): ?>
        <tr>
            <td><?= $emp['id']; ?></td>
            <td><?= $emp['name']; ?></td>
            <td><?= $emp['address']; ?></td>
            <td><?= $emp['salary']; ?></td>
            <td>
                <a href="read.php?id=<?= $emp['id']; ?>">View</a> |
                <a href="update.php?id=<?= $emp['id']; ?>">Edit</a> |
                <a href="delete.php?id=<?= $emp['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
