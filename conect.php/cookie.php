<?php
  session_start();

  if($_SERVER["REQUEST_METHOD"] === "POST"){
    if($_POST["user"] === "mohammad"){
      $_SESSION["username"] = "Alnabulseh";
      $_SESSION["id"] = 1005 ;
    }
  }

  echo '<pre>';
  print_r($_SESSION);
  echo '<pre>';
  
?>

<form action="" method="POST">
  <input type="text" name="user">
  <input type="submit" value="login">
</form>
