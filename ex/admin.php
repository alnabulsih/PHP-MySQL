<?php
session_start();

// التحقق من الجلسة
if(isset($_SESSION["userRole"]) && $_SESSION["userRole"] === "admin") {
    echo "Welcome Admin";
} else {
    header("Location: login.php"); // منع الدخول بدون تسجيل
    exit();
}
?>

<form action="logout.php" method="post">
    <input type="submit" value="Logout">
</form>
