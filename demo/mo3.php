<!DOCTYPE html>
<html>
<head>
    <title>Employee Records</title>
</head>
<body>
    <form method="post">
        <table>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="name" value="<?= htmlspecialchars($name ?? '') ?>" required></td>
            </tr>
            <tr>
                <td>Emp No:</td>
                <td><input type="text" name="empno" value="<?= htmlspecialchars($empno ?? '') ?>" required></td>
            </tr>
            <tr>
                <td>Salary:</td>
                <td><input type="text" name="salary" value="<?= htmlspecialchars($salary ?? '') ?>" required></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><input type="text" name="address" value="<?= htmlspecialchars($address ?? '') ?>" required></td>
            </tr>
            <tr>
                <td>Dept No:</td>
                <td><input type="text" name="deptno" value="<?= htmlspecialchars($deptno ?? '') ?>" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" name="insert">Add Record</button>
                    <button type="submit" name="delete">Delete Records</button>
                    <button type="submit" name="update">Update Records</button>
                </td>
            </tr>
        </table>
    </form>

    
    
</body>
</html>



<?php
$conn = new mysqli('localhost', 'root', '', 'mycompany');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["insert"])) {
    $name = $_POST['name'];
    $add = $_POST['address'];
    $empno = $_POST['empno'];
    $deptno = $_POST['deptno'];
    $sal = $_POST['salary'];

    $queryins="insert into amp (Empno,Ename,Address,Salary, deptno)
               values ($empno ,'$name','$add' ,$sal,$deptno )";
    $insresult  = mysqli_query($conn,$queryins)
      or die("Query ins faild:".mysqli_error($conn));
    echo  mysqli_affected_rows($conn)." record inserted";
}
if (isset($_POST['delete'])) {
    $querydel="delete from amp where Salary > 100";
$delresult  = mysqli_query($conn,$querydel)
or die("Query del faild:".mysqli_error($conn));
    echo mysqli_affected_rows($conn)." record/s is/are deleted";
  
}


if (isset($_POST["update"])) {
    $stmt = $conn->prepare("UPDATE amp SET Salary = Salary + ?");
   $increment = 10;
   $stmt->bind_param("d", $increment);

    if ($stmt->execute()) {
        echo "Number of rows updated: " . $stmt->affected_rows;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>
