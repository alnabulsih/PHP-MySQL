<!-- <?php
$host = "localhost";
$user = "root";
$password = "";
$database = "ecommerce_db";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully (MySQLi Procedural)";
?> -->

<!-- <?php
$host = "localhost";
$user = "root";
$password = "";
$database = "ecommerce_db";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->mysqli_connect_error) {
    die("Connection failed: " . $conn->mysqli_connect_error);
}

echo "Connected successfully (MySQLi oop)";
?> -->


<?php
$host = "localhost";
$dbname = "ecommerce_db";
$user = "root";
$password = "";
$database = "ecommerce_db";

try{
  $conn= new PDO (
    "mysql:host=$host;dbname=$dbname",
    $user,
    $password

  );
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  echo "Connected successfully (PDO)";
}
catch (PDOException $e){
die("Connection failed: " . $e->getMessage());
}

?>