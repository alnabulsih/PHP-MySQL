<?php
  require_once "config/Database.php";

  class User extends Database{

    public function register($data){
      $sql = "INSERT INTO users (full_name,email,mobile,password,dob) VALUES (?,?,?,?,?)";

      $stmt = $this->conn->prepare($sql);
      $hashed = hash("sha256",$data['password']);

      return $stmt->bind_param(
        "sssss",
        $data['full_name'],
        $data['email'],
        $data['mobile'],
        $hashed,
        $data['dob']
      )&& $stmt->execute();
    }

      public function login($email, $password){
    $hashed = hash("sha256", $password);

    $sql = "SELECT * FROM users WHERE email=? AND password=?";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ss",$email,$hashed);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc();
  }

  public function allUsers() {
        return $this->conn
            ->query("SELECT * FROM users")
            ->fetch_all(MYSQLI_ASSOC);
    }

  public function delete($id){
    $stmt = $this->conn->prepare("DELETE FROM users WHERE id=?");
    return $stmt->bind_param("i",$id) && $stmt->execute();
  }
  
  }

