<?php
session_start();

if($_SERVER["REQUEST_METHOD"]==="POST") {
    if($_POST["userRole"]==="admin"){
        $_SESSION["userRole"] = "admin";
        header("Location: admin.php");
        exit();
    } elseif($_POST["userRole"]==="user"){
        $_SESSION["userRole"] = "user";
        header("Location: user.php");
        exit();
    } else {
        echo "invalid";
    }
}
?>
