<?php
  require_once "database.php";

  $db = new Database();
  $conn = $db->conn;

  /* Get ID from URL */
  $id = $_GET['id'] ?? null;

  if($id){
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([":id"=>$id]);
  }

  header("Location: index.php");
  exit;