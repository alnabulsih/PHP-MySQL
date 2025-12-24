<?php
  class database
  {
     private $host;
    private $dbName;
    private $username;
    private $password;

    protected $conn;

    public function __construct($host, $dbName, $username, $password){
      this->host=$host;
      this->dbName=$dbName;
      this->username=$username;
      this->password=$password;
    }
    

    public function getConnection()
    {
      try{
      this->conn = new PDO(
        "mysql:host={$this->host};dbname={$this->dbName}"
        $this->username,
        $this->password
        echo "Connected successfully using PDO with constructor data!";
      );
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOExeception $e){
      die("Database connectio failed : " . $e->getMessage());
    }

        
    }
  }

  $db = new database(
    "localhost",
    "ecommerce_db",
    "root",
    "");
    
  

  $db->getConnection();
  

 
?>