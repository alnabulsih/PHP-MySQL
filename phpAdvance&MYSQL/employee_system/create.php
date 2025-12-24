<?php
require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];

    $stmt = $pdo->prepare("INSERT INTO Employees (name, address, salary) VALUES (?, ?, ?)");
    $stmt->execute([$name, $address, $salary]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
</head>
<body>
<h2 style="text-align:center;">Add New Employee</h2>

<form method="POST" style="width:300px; margin:auto;">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Address:</label><br>
    <input type="text" name="address" required><br><br>

    <label>Salary:</label><br>
    <input type="number" step="0.01" name="salary" required><br><br>

    <input type="submit" value="Add Employee">
</form>

</body>
</html>
