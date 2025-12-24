<?php
require_once 'config.php';

$id = $_GET['id'] ?? null;
if(!$id){
    header('Location: index.php');
    exit;
}

// Fetch current data
$stmt = $pdo->prepare("SELECT * FROM Employees WHERE id = ?");
$stmt->execute([$id]);
$employee = $stmt->fetch();

if(!$employee){
    echo "Employee not found!";
    exit;
}

// Update record
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];

    $stmt = $pdo->prepare("UPDATE Employees SET name=?, address=?, salary=? WHERE id=?");
    $stmt->execute([$name, $address, $salary, $id]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Employee</title>
</head>
<body>
<h2 style="text-align:center;">Update Employee</h2>

<form method="POST" style="width:300px; margin:auto;">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?= $employee['name']; ?>" required><br><br>

    <label>Address:</label><br>
    <input type="text" name="address" value="<?= $employee['address']; ?>" required><br><br>

    <label>Salary:</label><br>
    <input type="number" step="0.01" name="salary" value="<?= $employee['salary']; ?>" required><br><br>

    <input type="submit" value="Update Employee">
</form>

</body>
</html>
