<?php
session_start();
require_once "user.php";

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit;
}

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    $userClass = new User();
    $userClass->delete($id);
}

header("Location: admin_dashboard.php");
exit;
