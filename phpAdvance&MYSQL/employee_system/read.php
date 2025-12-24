<?php
require_once 'config.php';

$id = $_GET['id'] ?? null;

if(!$id){
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM Employees WHERE id = ?");
$stmt->execute([$id]);
$employee = $stmt->fetch();

if(!$employee){
    echo "Employee not found!";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Details</title>
</head>
<body>
<h2 style="text-align:center;">Employee Details</h2>

<div style="width:300px; margin:auto;">
    <p><strong>ID:</strong> <?= $employee['id']; ?></p>
    <p><strong>Name:</strong> <?= $employee['name']; ?></p>
    <p><strong>Address:</strong> <?= $employee['address']; ?></p>
    <p><strong>Salary:</strong> <?= $employee['salary']; ?></p>
    <a href="index.php">⬅ Back</a>
</div>

</body>
</html>
