<?php
class Database
{
     
    private $host = "localhost";
    private $db_name = "czsuprweb";
    private $username = "czsuprweb";
    private $password = "Lesnek95";
    public $conn;
     
    public function dbConnection()
	{
     
	    $this->conn = null;    
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
		catch(PDOException $exception)
		{
            echo "Chyba databáze: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
}